<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => 'Failed to create an employee object'];

if (Input::exists()) {
    if (Input::get('Method') == 'AddEmployee') {
		$emp = null;
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "Employee " . Input::get('empID') . " successfully added";
		$profileImageName = '';
		if (Input::get('hasImage') == 'true') {
			$profileImageName = time() . '-' . $_FILES["Image"]["name"];

			$target_dir = "../images/profilePictures/";
			$target_file = $target_dir . basename($profileImageName);

			if (file_exists($target_file)) {
				$object['message'] = "File already exists";
			} else {
				if (!move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
					$object['message'] = "There was an error uploading the file";
				}
			}
		}
		$emp = null;
		try {
        $emp = $employee->createNewAccount([
			'EmpID' => Input::get('EmpID'),
			'FirstName' => ucfirst(Input::get('FirstName')),
			'LastName' => ucfirst(Input::get('LastName')),
			'Username' => "",
			'Designation' => Input::get('Designation'),
			'Position' => Input::get('Position'),
			'Email' => Input::get('Email'),
			'Password' => Input::get('Password'),
            'ContactNumber' => Input::get('ContactNo'),
            'ProfilePicturePath' => $profileImageName,
		]);
		} catch(PDOException $e) {
			$object['error'] = true;
			$object['message'] = 'Add account failed. Duplicate entry exists in database';
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
