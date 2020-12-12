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
    if (Input::get('Method') == 'ChangePassword') {
        if ($employee->verifyPassword(Input::get('CurrentPassword'))) {
            if (Input::get('NewPassword') === Input::get('RetypeNewPassword')) {
                $emp = $employee->updatePassword([
                    'OldPassword' => Input::get('CurrentPassword'),
                    'NewPassword' => password_hash(Input::get('NewPassword'), PASSWORD_BCRYPT)
                ]);
                $object['error'] = false;
                $object['object'] = $emp;
                $object['message'] = "Employee successfully password updated";
            } else {
                $object['message'] = "This field should be match to the previous field";
            }
        } else {
            $object['message'] = "Password Incorrect";
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
