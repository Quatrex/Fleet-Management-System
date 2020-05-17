<?php
//include this file to automatically load classes
spl_autoload_register('classAutoLoader');
function classAutoLoader($className){
    $path="../classes/";
    $extension=".class.php";
    $fullpath=$path.$className.$extension;

    include_once $fullpath;
}
