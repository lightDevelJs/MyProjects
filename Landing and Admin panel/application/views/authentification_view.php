<!doctype html>
<html lang="en">
<style>

</style>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-page.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

    <meta charset="utf-8">
    <meta charset="UTF-8">
    <title>Authentification</title>
</head>
<body>
<div class="row-fluid">
    <div class="span6 error">
        <?php echo @$error; ?>
    </div>
    <div class="span8">

        <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/admin/login') ?>">
            <div class="control-group">

                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input class="span2" id="inputLogin" name="login" type="text" placeholder="Login">
                    </div>
                </div>
            </div>
            <div class="control-group">

                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input class="span2" id="inputPassword" name="password" type="text" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" id='Submit_AU_button'class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>