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
    if (Input::get('Method') == 'ChangeDriverPicture') {
        $driverImageName = time() . '-' . $_FILES["Image"]["name"];

        $target_dir = "../images/driverPictures/";
        $target_file = $target_dir . basename($driverImageName);

        if (file_exists($target_file)) {
            $object['message'] = "File already exists";
        }

        if ($object['message'] == '') {
            if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                $driver = $employee->UpdateDriverPicture([
                    'DriverId' => Input::get('DriverID'),
                    'DriverPicturePath' => $driverImageName
                ]);
                if ($driver !== null) {
                    $object['error'] = false;
                    $object['object'] = $driver;
                    $object['message'] = "success_Driver " . Input::get('DriverID') . " successfully updated";
                } else {
                    $object['error'] = true;
                    $object['message'] = 'Failed to create a driver object';
                }
            } else {
                $object['error'] = true;
                $object['message'] = "There was an error uploading the file";
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
