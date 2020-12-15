<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => 'Failed to create a vehicle object'];

if (Input::exists()) {
    if (Input::get('Method') == 'AddVehicle') {
        $vehicle = null;
		if (Input::get('IsLeased') == "Yes") {
		try {
			$vehicle = $employee->addLeasedVehicle([
				'RegistrationNo' => Input::get('RegistrationNo'),
				'Model' => Input::get('Model'),
				'PurchasedYear' => Input::get('PurchasedYear'),
				'Value' => Input::get('Value'),
				'FuelType' => Input::get('FuelType'),
				'InsuranceValue' => Input::get('InsuranceValue'),
				'InsuranceCompany' => Input::get('InsuranceCompany'),
				'LeasedCompany' => Input::get('LeasedCompany'),
				'LeasedPeriodFrom' => Input::get('LeasedPeriodFrom'),
				'LeasedPeriodTo' => Input::get('LeasedPeriodTo'),
				'MonthlyPayment' => Input::get('MonthlyPayment'),
				'VehiclePicturePath' => Input::get('Image')==null?'':Input::get('Image'),
			]);
		} catch(PDOException $e)
		{
			$object['message'] = 'Update failed. Duplicate entry exists in database';
		}
		} else {
			try {
				$vehicle = $employee->addPurchasedVehicle([
					'RegistrationNo' => Input::get('RegistrationNo'),
					'Model' => Input::get('Model'),
					'PurchasedYear' => Input::get('PurchasedYear'),
					'Value' => Input::get('Value'),
					'FuelType' => Input::get('FuelType'),
					'InsuranceValue' => Input::get('InsuranceValue'),
					'InsuranceCompany' => Input::get('InsuranceCompany'),
					'VehiclePicturePath' => Input::get('Image')==null?'':Input::get('Image'),
				]);
			} catch(PDOException $e) {
				$object['message'] = 'Update failed. Duplicate entry exists in database';
			}
		}
		if ($vehicle !== null) {
			$object['error'] = false;
			$object['object'] = $vehicle;
			$object['message'] = "Vehicle " . Input::get('registration') . " successfully added";
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
