<?php

//init
$path = dirname(__FILE__);

$init = $path . '/../../../backend/init.php';
if (is_readable($init)) {
    require_once $init;
}else{
    error_log('Something error : isnt readable init file '.$init);
    die('Something error v1');
}

//backend
$path = dirname(__FILE__);
$backend = $path . '/../../../backend/api.php';
if (is_readable($backend)) {
    require_once $backend;
}else{
    error_log('Something error : isnt readable backend file '.$backend);
    die('Something error v2');
}