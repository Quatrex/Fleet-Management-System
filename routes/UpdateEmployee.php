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
    if (Input::get('Method') == 'UpdateEmployee') {
        $emp = $employee->updateAccount([
			'NewEmpID' => Input::get('NewEmpID'),
			'EmpID' => Input::get('empID'),
			'FirstName' => ucfirst(Input::get('FirstName')),
			'LastName' => ucfirst(Input::get('LastName')),
			'Username' => "",
			'Designation' => Input::get('Designation'),
			'Position' => Input::get('Position'),
			'Email' => Input::get('Email'),
			'ContactNo' => Input::get('ContactNo')
		]);
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "success_Employee " . Input::get('empID') . " successfully updated";
		if (Input::get('hasImage') == 'true') {
			$profileImageName = time() . '-' . $_FILES["Image"]["name"];

			$target_dir = "../images/profilePictures/";
			$target_file = $target_dir . basename($profileImageName);

			if ($_FILES['Image']['size'] > 200000) {
				$object['message'] = "Image size should not be greated than 200Kb";
			}

			if (file_exists($target_file)) {
				$object['message'] = "File already exists";
			} else {
				if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
					$emp = $employee->UpdateProfilePicture(['ProfilePicturePath' => $profileImageName]);
					$object['error'] = false;
					$object['object'] = [$emp];
					$object['message'] = "Employee " . " successfully updated profile picture";
				} else {
					$object['message'] = "There was an error uploading the file";
				}
			}
		}}
}
echo json_encode($object);
header('Connection: close');
header('Content-Length: ' . ob_get_length());
ob_end_flush();
ob_flush();
flush();
$emailClient = EmailClient::getInstance();
$emailClient->sendEmails();
