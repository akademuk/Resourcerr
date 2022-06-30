<?php

namespace Backend\Service;

class ResponseService
{
    public static function json_success($data = null, $httpStatus = 200)
    {
        header_remove();
        header("Content-Type: application/json");
        http_response_code($httpStatus);
        print json_encode(['result' => true, 'message' => 'success', 'data' => $data]);
        exit();
    }

    public static function json_error($message = 'something error', $httpStatus = 422)
    {
        header_remove();
        header("Content-Type: application/json");
        http_response_code($httpStatus);
        print json_encode(['result' => false, 'message' => $message]);
        exit();
    }
}