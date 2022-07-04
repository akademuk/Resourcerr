<?php
// original name '.env.php'
use Backend\Service\EmailService;
use Backend\Service\PdfService;
use Backend\Service\RecaptchaService;
use Backend\Service\ResponseService;


try {
    //job
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        throw new Exception('POST method required');
    }
    $reCaptchaService = new RecaptchaService;
    if ($reCaptchaService->isSuccess()) {
        $result = [];
        //send email
        if(!EmailService::send(PdfService::make($_POST), $result, $_POST)){
            throw new Exception($result['message']);
        }
        // success
        ResponseService::json_success();
    } else {
        $errors = $reCaptchaService->getErrorCodes();
        ResponseService::json_error(implode(', ', $errors));
    }
} catch (\Exception $exception) {
    error_log($exception->getMessage());
    ResponseService::json_error($exception->getMessage()); // todo remove message
}








