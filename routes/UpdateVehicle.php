<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => null, 'message' => 'Failed to create a vehicle object'];

if (Input::exists()) {
    if (Input::get('Method') == 'UpdateVehicle') {
        $vehicle = null;
        if (Input::get('LeasedCompany') !== "") {
            try {
                $vehicle = $employee->updateLeasedVehicleInfo([

                    'RegistrationNo' => Input::get('RegistrationNo'),
                    'NewRegistrationNo' => Input::get('NewRegistrationNo'),
                    'Model' => Input::get('Model'),
                    'PurchasedYear' => Input::get('PurchasedYear'),
                    'Value' => Input::get('Value'),
                    'FuelType' => Input::get('FuelType'),
                    'CurrentLocation' => Input::get('CurrentLocation'),
                    'InsuranceValue' => Input::get('InsuranceValue'),
                    'InsuranceCompany' => Input::get('InsuranceCompany'),
                    'LeasedCompany' => Input::get('LeasedCompany'),
                    'LeasedPeriodFrom' => Input::get('LeasedPeriodFrom'),
                    'LeasedPeriodTo' => Input::get('LeasedPeriodTo'),
                    'MonthlyPayment' => Input::get('MonthlyPayment')
                ]);
            } catch (PDOException $e)
            {
                $object['message'] = 'Update failed. Duplicate entry exists in database';
            }
        } else {
            try {
            $vehicle = $employee->updatePurchasedVehicleInfo([
                'RegistrationNo' => Input::get('RegistrationNo'),
                'NewRegistrationNo' => Input::get('NewRegistrationNo'),
                'Model' => Input::get('Model'),
                'PurchasedYear' => Input::get('PurchasedYear'),
                'CurrentLocation' => Input::get('CurrentLocation'),
                'Value' => Input::get('Value'),
                'FuelType' => Input::get('FuelType'),
                'InsuranceValue' => Input::get('InsuranceValue'),
                'InsuranceCompany' => Input::get('InsuranceCompany')
            ]);
            } catch(PDOException $e)
            {
                $object['message'] = 'Update failed. Duplicate entry exists in database';
            }
        }
        if ($vehicle !== null) {
            $object['error'] = false;
            $object['object'] = $vehicle;
            $object['message'] = "Vehicle " . Input::get('RegistrationNo') . " successfully updated";
        } 
        if (Input::get('hasImage') == 'true') {
            $vehicleImageName = time() . '-' . $_FILES["Image"]["name"];
            $target_dir = "../images/vehiclePictures/";
            $target_file = $target_dir . basename($vehicleImageName);

            if (file_exists($target_file)) {
                $object['message'] = "File already exists";
            } else {
                if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
                    $vehicle = $employee->UpdateVehiclePicture([
                        'VehiclePicturePath' => $vehicleImageName,
                        'RegistrationNo' => Input::get('RegistrationNo'),
                        'IsLeased' => (Input::get('LeasedCompany') !== "")
                    ]);
                    if ($vehicle !== null) {
                        $object['error'] = false;
                        $object['object'] = $vehicle;
                        $object['message'] = "Vehicle " . Input::get('RegistrationNo') . " successfully updated";
                    } else {
                        $object['error'] = true;
                        $object['message'] = 'Failed to update a vehicle object';
                    }
                } else {
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
