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
    if (Input::get('Method') == 'AddDriver') {
        $driver = $employee->createNewDriver([
            'DriverID' => Input::get('DriverID'),
            'FirstName' => ucfirst(Input::get('FirstName')),
            'LastName' => ucfirst(Input::get('LastName')),
            'Email' => Input::get('Email'),
            'Address' => Input::get('Address'),
            'ContactNo' => Input::get('ContactNo'),
            'LicenseNumber' => Input::get('LicenseNumber'),
            'LicenseType' => Input::get('LicenseType'),
            'LicenseExpirationDay' => Input::get('LicenseExpirationDay'),
            'DateOfAdmission' => Input::get('DateOfAdmission'),
            'AssignedVehicle' => null,
            'ProfilePicturePath' => null
        ]);
        $object['error'] = false;
        $object['request'] = $driver;
        $object['message'] = "success_Driver " . Input::get('driverId') . " successfully added";
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
