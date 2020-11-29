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
    if (Input::get('Method') == 'DeletePurchasedVehicle') {
        $vehicle = $employee->deletePurchasedVehicle(Input::get('registration'));
        $object['error'] = false;
        $object['object'] = $vehicle;
        $object['message'] = "success_Vehicle " . Input::get('registration') . " successfully deleted";
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
