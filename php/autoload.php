<?php
spl_autoload_register('appAutoLoader');

function appAutoLoader($className)
{
    $path = "classes/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;
    if (!file_exists($fullPath)) {
        echo $fullPath . " not found";
        return false;
    }
    include_once($fullPath);
}