function ajaxRequest() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function updateData(element, method,  value) {
    if(typeof(value) == "undefined") {
        value = element.innerHTML;
    }

    if(typeof(method) == "undefined") {
        method = "updateValue";
    }

    result = "";
    var newRequest = ajaxRequest();
    newRequest.onreadystatechange = function () {
        if (newRequest.readyState == 4) {
            if (newRequest.status == 200) {
                result = newRequest.responseText;
                return result;
            }
            else {
                alert("An error has occured making the request")
            }
        }
    };

    var _id = element.id.match(/\.*_(\d+)/);
    var fd = new FormData();
    fd.append("entity_id", _id[1]);

    if(element.childNodes[0].type == "file") {
        var file = element.childNodes[0].files;
        fd.append("userfile", file[0], file[0].name);
    } else {
        fd.append(element.className, value);
    }

    newRequest.open("POST", method, false);
    newRequest.send(fd);
    return result;
}
