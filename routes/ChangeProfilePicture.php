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
    if (Input::get('Method') == 'ChangeProfilePicture') {
        $profileImageName = time() . '-' . $_FILES["Image"]["name"];

        $target_dir = "../images/profilePictures/";
        $target_file = $target_dir . basename($profileImageName);

        if (file_exists($target_file)) {
            $object['message'] = "File already exists";
        }

        if ($object['message'] == '') {
            if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                $emp = $employee->UpdateProfilePicture(['ProfilePicturePath' => $profileImageName]);
                $object['error'] = false;
                $object['object'] = ['ProfilePicturePath' => $target_file];
                $object['message'] = "Employee " . " successfully updated profile picture";
            } else {
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
