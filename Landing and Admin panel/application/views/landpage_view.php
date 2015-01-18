<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fullPage.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/landing.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.fullPage.js'); ?>"></script>
    <meta charset="UTF-8">
    <title>Decision.UA</title>
</head>
<body>
<div id="fullpage" class="container-fluid" >
    <div id="header" class="section"></div>
    <div id="reclame" class="section"></div>
    <div id="portfolio" class="section">

        <div class="slide"  data-anchor="slide1" ><img  src="<? echo base_url('images/portfolio/ci_logo-e1390144260935.png'); ?>" class="img-polaroid"></div>
        <div class="slide" data-anchor="slide2"></div>
        <div class="slide" data-anchor="slide3"></div>
        <div class="slide" data-anchor="slide4"></div>

    </div>
    <div id="footer" class="section"></div>
</div>
<script language="JavaScript">
    $(document).ready(function () {
        $('#fullpage').fullpage();
    });

</script>
</body>
</html>