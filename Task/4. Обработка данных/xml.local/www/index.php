<? header('Content-Type: text/html; charset=utf-8'); ?>
<? include_once('Curency.php') ?>
<?php
$currency = new Currency(array('USD', 'GBP', 'AUD', 'CAD'));
$result = $currency->getCurrency();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>XML Parser</title>
</head>
<body>
<div class="wrapper">
    <table style="border: 1px solid black ">
        <thead>
        <th>Currency</th>
        <th>Rate</th>
        </thead>
        <tbody>
        <? foreach ($result as $key => $value): ?>
            <tr>
                <td><? echo $key ?></td>
                <td><? echo $value ?></td>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>