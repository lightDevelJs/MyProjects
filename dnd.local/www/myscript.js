$(function () {
    var xhr = new XMLHttpRequest();
    var currentObj = $('.upload');
    currentObj.on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '2px solid green');
    });
    currentObj.on('dragleave', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '2px dotted  grey');
    });
    currentObj.on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '2px dotted  grey');
        var files = e.originalEvent.dataTransfer.files;
        var file = files[0];

        upload(file);

    });
    function upload(file) {

        xhr.open('post', 'action.php', true);

        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.setRequestHeader('X-File-Type', file.type);
        xhr.upload.addEventListener('progress', function (event) {
            var progress = (event.loaded / event.total) * 100;
            $('.bar').css('width', progress + "%");
        }, false);

        xhr.send(file);

        xhr.onreadystatechange = function (event) {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    $(".image").html("<img src='" + xhr.responseText + "' width='100%'/>");
                    console.log(xhr)

                }
            }
        }

    }
});