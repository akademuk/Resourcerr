<?php
// original name '.env.php'
try {

    //init
    $path = dirname(__FILE__);
    $env_path = $path . '/../../../';
    $env_file = $env_path . '.env.php';

    if (!file_exists($env_file)) {
        throw new \Exception('Something error with system init');
    }


    $vendor_path = $path . '/../../../vendor/';
    $vendor_autoload = $vendor_path . 'autoload.php';
    if (!file_exists($vendor_autoload)) {
        throw new \Exception('Something error with system');
    }

    require_once $env_file;
    require_once $vendor_autoload;

    //job
    try {
        $gRecaptchaResponse = is_string($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
        $recaptcha = new \ReCaptcha\ReCaptcha(RE_CAPTCHA_SECRET_v3);
        $resp = $recaptcha->setExpectedHostname(APP_URL)
            ->verify($gRecaptchaResponse, getIPAddress());
        if ($resp->isSuccess()) {
            // Verified!
//            json_response($_POST); //todo: send email and message success
            json_response();
        } else {
            $errors = $resp->getErrorCodes();
            json_response_error(implode(', ', $errors));
        }
    } catch (\Exception $exception) {
        json_response_error();
    }
} catch (\Exception $exception) {
    json_response_error($exception->getMessage());
}

function json_response($data = null, $httpStatus = 200)
{
    header_remove();
    header("Content-Type: application/json");
    http_response_code($httpStatus);
    print json_encode(['result' => true, 'message' => 'success', 'data' => $data]);
    exit();
}

function json_response_error($message = 'something error', $httpStatus = 422)
{
    header_remove();
    header("Content-Type: application/json");
    http_response_code($httpStatus);
    print json_encode(['result' => false, 'message' => $message]);
    exit();
}

function getIPAddress()
{
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } //whether ip is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}