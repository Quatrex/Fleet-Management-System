<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => null, 'message' => 'Failed to create a driver object'];

if (Input::exists()) {
    if (Input::get('Method') == 'UpdateDriver') {
        $driver = null;
        $object['error'] = false;
        $object['object'] = $driver;
        try {
            $driver = $employee->updateDriverInfo(
                Input::get('DriverID'),
                [
                    'DriverID' => Input::get('DriverID'),
                    'NewDriverID' => Input::get('NewDriverID'),
                    'FirstName' => ucfirst(Input::get('FirstName')),
                    'LastName' => ucfirst(Input::get('LastName')),
                    'Email' => Input::get('Email'),
                    'Address' => Input::get('Address'),
                    'ContactNumber' => Input::get('ContactNo'),
                    'LicenseNumber' => Input::get('LicenseNumber'),
                    'LicenseType' => Input::get('LicenseType'),
                    'LicenseExpirationDay' => Input::get('LicenseExpirationDay'),
                    'DateOfAdmission' => Input::get('DateOfAdmission')
                ]
            );
            $object['object'] = $driver;
            $object['message'] = "Driver " . Input::get('DriverID') . " successfully updated";
        } catch (PDOException $e) {
            echo $e;
            $object['error'] = true;
            $object['message'] = 'Update failed. Duplicate entry exists in database';
        }
        if (Input::get('hasImage') == 'true') {
            $driverImageName = time() . '-' . $_FILES["Image"]["name"];

            $target_dir = "../images/profilePictures/";
            $target_file = $target_dir . basename($driverImageName);

            if (file_exists($target_file)) {
                $object['message'] = "File already exists";
            } else {
                if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                    $driver = $employee->UpdateDriverPicture([
                        'DriverId' => Input::get('DriverID'),
                        'DriverPicturePath' => $driverImageName
                    ]);
                    if ($driver !== null) {
                        $object['error'] = false;
                        $object['object'] = [$driver];
                        $object['message'] = "success_Driver " . Input::get('DriverID') . " successfully updated";
                    }
                } else {
                    $object['error'] = true;
                    $object['message'] = "There was an error uploading the file";
                }
            }
        }
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
