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
    if (Input::get('Method') == 'AddVehicle') {
        $vehicle = null;
		if (Input::get('IsLeased') == "Yes") {
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
				'MonthlyPayment' => Input::get('MonthlyPayment')
			]);
		} else {
			$vehicle = $employee->addPurchasedVehicle([
				'RegistrationNo' => Input::get('RegistrationNo'),
				'Model' => Input::get('Model'),
				'PurchasedYear' => Input::get('PurchasedYear'),
				'Value' => Input::get('Value'),
				'FuelType' => Input::get('FuelType'),
				'InsuranceValue' => Input::get('InsuranceValue'),
				'InsuranceCompany' => Input::get('InsuranceCompany')
			]);
		}
		if ($vehicle !== null) {
			$object['error'] = false;
			$object['object'] = $vehicle;
			$object['message'] = "success_Vehicle " . Input::get('registration') . " successfully added";
		} else {
			$object['error'] = true;
			$object['message'] = 'Failed to create a vehicle object';
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
