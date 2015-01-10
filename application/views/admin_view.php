<!doctype html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-page.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <meta charset="utf-8">
<body>

<div class="container-fluid">
    <div class="row-fluid">
        <?php $this->load->view('menu')?>
        <div class="span8" id="admin-sector-body"></div>
    </div>
</div>
</body>
</html>