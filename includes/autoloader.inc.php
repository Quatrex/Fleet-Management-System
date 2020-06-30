<?php
//include this file to automatically load classes
spl_autoload_register('classAutoLoader');
function classAutoLoader($className){
    $path="../src/";
    $extension=".class.php";
    $fullpath=$path.$className.$extension;

    // echo $fullpath;
    include_once $fullpath;
}
