<?php
header('Content-type: application/json');
try {
    json_response($_POST);
} catch (\Exception $exception) {
    json_response_error();
}


function json_response($data = null, $httpStatus = 200)
{
    header_remove();
    header("Content-Type: application/json");
    http_response_code($httpStatus);
    print json_encode(['result' => true, 'message' => 'success', 'data' => $data]);
    exit();
}

function json_response_error($httpStatus = 422)
{
    header_remove();
    header("Content-Type: application/json");
    http_response_code($httpStatus);
    print json_encode(['result' => false, 'message' => 'something error']);
    exit();
}