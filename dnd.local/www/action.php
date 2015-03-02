<?php
/**
 * Created by PhpStorm.
 * User: Саша
 * Date: 10.01.2015
 * Time: 1:27
 */
$str = file_get_contents('php://input');
$filename = sha1(time()) . '.jpg';
$path = 'upload/' . $filename;
file_put_contents($path, $str);
echo $path;