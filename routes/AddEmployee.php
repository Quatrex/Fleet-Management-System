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
    if (Input::get('Method') == 'AddEmployee') {
        $emp = $employee->createNewAccount([
            'EmpID' => Input::get('EmpID'),
            'FirstName' => ucfirst(Input::get('FirstName')),
            'LastName' => ucfirst(Input::get('LastName')),
            'Username' => "",
            'Designation' => Input::get('Designation'),
            'Position' => Input::get('Position'),
            'Email' => Input::get('Email'),
            'Password' => Input::get('Password'),
            'ContactNo' => Input::get('ContactNo')
        ]);
        $object['error'] = false;
        $object['object'] = $emp;
        $object['message'] = "success_Employee " . Input::get('empID') . " successfully added";
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
