<?php
//init
try {
    $path = dirname(__FILE__);
    $env_path = $path . '/../';
    $env_file = $env_path . '.env.php';

    if (is_readable($env_file)) {
        require_once $env_file;
    } else {
        throw new \Exception('Something error with system env');
    }

    $vendor_path = $path . '/../vendor/';
    $vendor_autoload = $vendor_path . 'autoload.php';
    if (is_readable($vendor_autoload)) {
        require_once $vendor_autoload;
    } else {
        throw new \Exception('Something error with system autoload');
    }
    require_once 'pdf.php';

} catch (\Exception $exception) {
    error_log('Something error code:0000 '.$exception->getMessage());
    die('Something error code:0000');
}