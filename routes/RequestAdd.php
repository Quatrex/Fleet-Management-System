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
    if (Input::get('Method') == 'RequestAdd') {
        $request = $employee->placeRequest([
            'DateOfTrip' => Input::get('date'),
            'TimeOfTrip' => Input::get('time'),
            'DropLocation' => Input::get('dropoff'),
            'PickLocation' => Input::get('pickup'),
            'Purpose' => Input::get('purpose')
        ]);
        $object['error'] = false;
        $object['object'] = $request;
        $object['message'] = "Request successfully added";
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
