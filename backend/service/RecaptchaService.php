<?php

namespace Backend\Service;

use ReCaptcha\ReCaptcha;

class RecaptchaService
{

    private $resp;

    public function __construct()
    {
        $this->verify();
    }

    public function isSuccess()
    {
        return $this->resp->isSuccess();
    }

    public function getErrorCodes()
    {
        return $this->resp->getErrorCodes();
    }

    private function verify()
    {
        $gRecaptchaResponse = is_string($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
        $recaptcha = new ReCaptcha(RE_CAPTCHA_SECRET_v3);
        $this->resp = $recaptcha->setExpectedHostname(APP_URL)
            ->verify($gRecaptchaResponse, $this->getIPAddress());
        return $this;
    }

    private function getIPAddress()
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


}