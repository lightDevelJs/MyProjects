<!DOCTYPE html>
<html>
<head lang="en">
    <script src="jquery-2.1.3.js"></script>
    <script src="dist/js/bootstrap.js"></script>
    <script src="myscript.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Drag and Drop APP</title>
</head>
<style>
    .upload {
        width: auto;
        position: absolute;
        background-color: #D2D7D3;
        color: #000000;
        font-size: 200%;
        border: 2px dotted #000000;
        padding: 20px;
        top: 3%;

    }

    .container-fluid {
        background-color: #ffffff;
        width: 400px;
        height: 300px;
        border: 0.5px solid #000000;
    }

    .progress.progress-striped.active {
        margin-top: 23%;
    }

</style>
<body>
<div class="container-fluid">
    <div class="upload">
        <span>Put img right here</span>
    </div>
    <div class="progress progress-striped active">
        <div class="bar" style="width: 0%;" aria-valuemin="0" aria-valuemax="0"></div>
    </div>
    <div class="image">    </div>
</div>


`</body>
</html>