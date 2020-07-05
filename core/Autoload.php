<?php

function autoload($class_name) {

    $url = dirname(__DIR__) . "\\" . $class_name . '.php';
    require_once(str_replace("\\", '/', $url));
}

spl_autoload_register('autoload');

?>