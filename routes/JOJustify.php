<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

if (Input::exists()) {
    if (Input::get('Method') == 'JOJustify') {
        $comment = '';
        if (Input::get('JOSelectedVehicle') != '') {
            $comment = Input::get('JOComment') . ' Suggested Vehicle: ' . Input::get('JOSelectedVehicle');
        } else $comment = Input::get('JOComment');
        $request = $employee->justifyRequest(Input::get('RequestId'), $comment);
        $object['error'] = false;
        $object['object'] = $request;
        $object['message'] = "Request " . Input::get('RequestId') . " successfully justified";
    }
}
echo json_encode($object);
header('Connection: close');
header('Content-Length: ' . ob_get_length());
ob_end_flush();
ob_flush();
flush();
$emailClient = EmailClient::getInstance();
$emailClient->sendEmails();
