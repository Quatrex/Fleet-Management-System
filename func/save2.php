<?php

use EmailClient\EmailClient;
use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$method = Input::get('Method');
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

switch ($method) {
	case 'JOJustify':
		$comment = '';
		if (Input::get('JOSelectedVehicle') != '') {
			$comment = Input::get('JOComment') . ' Suggested Vehicle: ' . Input::get('JOSelectedVehicle');
		} else $comment = Input::get('JOComment');
		$request = $employee->justifyRequest(Input::get('RequestId'), $comment);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully justified";
		break;

	case 'JODeny':
		$request = $employee->denyRequest(Input::get('RequestId'), Input::get('JOComment'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully denied";
		break;

	case 'CAOApprove':
		$request = $employee->approveRequest(Input::get('RequestId'), Input::get('CAOComment'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully approved";
		break;

	case 'CAODeny':
		$request = $employee->denyRequest(Input::get('RequestId'), Input::get('CAOComment'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully denied";
		break;

	case 'RequestAdd':
		$request = $employee->placeRequest([
			'DateOfTrip' => Input::get('date'),
			'TimeOfTrip' => Input::get('time'),
			'DropLocation' => Input::get('dropoff'),
			'PickLocation' => Input::get('pickup'),
			'Purpose' => Input::get('purpose')
		]);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request successfully added";
		break;

	case 'AddVehicle':
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

		break;

	case 'UpdateVehicle':
		$vehicle = null;
		if (Input::get('LeasedCompany') !== "") {
			$vehicle = $employee->updateLeasedVehicleInfo([

				'RegistrationNo' => Input::get('RegistrationNo'),
				'NewRegistrationNo' => Input::get('RegistrationNo'),
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
		} else {
			$vehicle = $employee->updatePurchasedVehicleInfo([
				'RegistrationNo' => Input::get('RegistrationNo'),
				'NewRegistrationNo' => Input::get('RegistrationNo'),
				'Model' => Input::get('Model'),
				'PurchasedYear' => Input::get('PurchasedYear'),
				'CurrentLocation' => Input::get('CurrentLocation'),
				'Value' => Input::get('Value'),
				'FuelType' => Input::get('FuelType'),
				'InsuranceValue' => Input::get('InsuranceValue'),
				'InsuranceCompany' => Input::get('InsuranceCompany')
			]);
		}
		if ($vehicle !== null) {
			$object['error'] = false;
			$object['object'] = [$vehicle];
			$object['message'] = "success_Vehicle " . Input::get('RegistrationNo') . " successfully updated";
		} else {
			$object['error'] = true;
			$object['message'] = 'Failed to create a vehicle object';
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
						$object['object'] = [$vehicle];
						$object['message'] = "success_Vehicle " . Input::get('RegistrationNo') . " successfully updated";
					} else {
						$object['error'] = true;
						$object['message'] = 'Failed to update a vehicle object';
					}
				} else {
					$object['message'] = "There was an error uploading the file";
				}
			}
		}
		break;


	case 'CancelRequest':
		$request = $employee->cancelRequest(Input::get('RequestId'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully cancelled";
		break;

	case 'CancelScheduledRequest':
		$request = $employee->cancelScheduledRequest(Input::get('RequestId'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully cancelled";
		break;

	case 'DeletePurchasedVehicle':
		$vehicle = $employee->deletePurchasedVehicle(Input::get('registration'));
		$object['error'] = false;
		$object['object'] = $vehicle;
		$object['message'] = "success_Vehicle " . Input::get('registration') . " successfully deleted";
		break;

	case 'DeleteLeasedVehicle':
		$vehicle = $employee->deleteLeasedVehicle(Input::get('registration'));
		$object['error'] = false;
		$object['object'] = $vehicle;
		$object['message'] = "success_Vehicle " . Input::get('registration') . " successfully deleted";
		break;

	case 'Schedule':
		$request = $employee->scheduleRequest(Input::get('RequestId'), Input::get('Driver'), Input::get('Vehicle'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully Assigned";
		break;

	case 'EndTrip':
		$request = $employee->closeRequest(Input::get('RequestId'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Trip " . Input::get('RequestId') . " successfully ended";
		break;

	case 'AddEmployee':
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
		break;

	case 'UpdateEmployee':
		$emp = $employee->updateAccount([
			'NewEmpID' => Input::get('NewEmpID'),
			'EmpID' => Input::get('EmpID'),
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
					$object['message'] = "success_Employee " . " successfully updated profile picture";
				} else {
					$object['message'] = "There was an error uploading the file";
				}
			}
		}
		break;

	case 'ChangeProfilePicture':

		$profileImageName = time() . '-' . $_FILES["Image"]["name"];

		$target_dir = "../images/userProfilePictures/";
		$target_file = $target_dir . basename($profileImageName);

		if (file_exists($target_file)) {
			$object['message'] = "File already exists";
		}

		if ($object['message'] == '') {
			if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
				$emp = $employee->UpdateProfilePicture(['ProfilePicturePath' => $profileImageName]);
				$object['error'] = false;
				$object['object'] = $target_file;
				$object['message'] = "success_Employee " . " successfully updated profile picture";
			} else {
				$object['message'] = "There was an error uploading the file";
			}
		}

		break;

	case 'DeleteEmployee':
		$emp = $employee->removeAccount(Input::get('empID'));
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "success_Employee " . Input::get('empID') . " successfully deleted";
		break;

	case 'AddDriver':
		$driver = $employee->createNewDriver([
			'DriverID' => Input::get('DriverID'),
			'FirstName' => ucfirst(Input::get('FirstName')),
			'LastName' => ucfirst(Input::get('LastName')),
			'Email' => Input::get('Email'),
			'Address' => Input::get('Address'),
			'ContactNo' => Input::get('ContactNo'),
			'LicenseNumber' => Input::get('LicenseNumber'),
			'LicenseType' => Input::get('LicenseType'),
			'LicenseExpirationDay' => Input::get('LicenseExpirationDay'),
			'DateOfAdmission' => Input::get('DateOfAdmission'),
			'AssignedVehicle' => ""
		]);
		$object['error'] = false;
		$object['request'] = $driver;
		$object['message'] = "success_Driver " . Input::get('driverId') . " successfully added";
		break;

	case 'DeleteDriver':
		$driver = $employee->deleteDriver(Input::get('driverId'));
		$object['error'] = false;
		$object['object'] = $driver;
		$object['message'] = "success_Driver " . Input::get('driverId') . " successfully deleted";
		break;

	case 'UpdateDriver':
		$driver = $employee->updateDriverInfo(
			Input::get('DriverID'),
			[
				'DriverID' => Input::get('DriverID'),
				'NewDriverID' => Input::get('DriverID'),
				'FirstName' => ucfirst(Input::get('FirstName')),
				'LastName' => ucfirst(Input::get('LastName')),
				'Email' => Input::get('Email'),
				'Address' => Input::get('Address'),
				'ContactNo' => Input::get('ContactNo'),
				'LicenseNumber' => Input::get('LicenseNumber'),
				'LicenseType' => Input::get('LicenseType'),
				'LicenseExpirationDay' => Input::get('LicenseExpirationDay'),
				'DateOfAdmission' => Input::get('DateOfAdmission'),
				'AssignedVehicle' => ""
			]
		);
		$object['error'] = false;
		$object['object'] = [$driver];
		$object['message'] = "success_Driver " . Input::get('employeeID') . " successfully updated";
		if (Input::get('hasImage') == 'true') {
			$driverImageName = time() . '-' . $_FILES["Image"]["name"];

			$target_dir = "../images/profilePictures/";
			$target_file = $target_dir . basename($driverImageName);

			if (file_exists($target_file)) {
				$object['message'] = "File already exists";
			}

			else {
				if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
					$driver = $employee->UpdateDriverPicture([
						'DriverId' => Input::get('DriverID'),
						'DriverPicturePath' => $driverImageName
					]);
					if ($driver !== null) {
						$object['error'] = false;
						$object['object'] = [$driver];
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
		break;

	case 'ChangeDriverPicture':
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
		break;

	case 'AssignVehicleToDriver':
		$driver = $employee->assignVehicleToDriver(Input::get('DriverID'), Input::get('AssignedVehicle'));
		$object['error'] = false;
		$object['request'] = $driver;
		$object['message'] = "success_Driver " . Input::get('DriverID') . " successfully assigned " . Input::get('AssignedVehicle');
		break;

	case 'CancelTrip':
		$request = $employee->cancelRequest(Input::get('RequestId'));
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . Input::get('RequestId') . " successfully cancelled";
		break;

	default:
		$object['error'] = true;
		$object['message'] = 'Invalid method';
}

echo json_encode($object);
header('Connection: close');
header('Content-Length: ' . ob_get_length());
ob_end_flush();
ob_flush();
flush();
$emailClient = EmailClient::getInstance();
$emailClient->sendEmails();