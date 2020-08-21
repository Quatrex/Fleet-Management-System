<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use EmailClient\EmailClient;

include_once '../includes/autoloader.inc.php';

session_start();
ob_start();
header("Content-type: application/json; charset=utf-8");
$method = $_POST['Method'];
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

switch ($method) {
	case 'JOJustify':
		$comment = '';
		if ($_POST['JOSelectedVehicle'] != '') {
			$comment = $_POST['JOComment'] . ' Suggested Vehicle: ' . $_POST['JOSelectedVehicle'];
		}
		$request = $employee->justifyRequest($_POST['RequestId'], $comment);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully justified";
		break;

	case 'JODeny':
		$request = $employee->denyRequest($_POST['RequestId'], $_POST['JOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully denied";
		break;

	case 'CAOApprove':
		$request = $employee->approveRequest($_POST['RequestId'], $_POST['CAOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully approved";
		break;

	case 'CAODeny':
		$request = $employee->denyRequest($_POST['RequestId'], $_POST['CAOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully denied";
		break;

	case 'RequestAdd':
		$request = $employee->placeRequest([
			'DateOfTrip' => $_POST['date'],
			'TimeOfTrip' => $_POST['time'],
			'DropLocation' => $_POST['dropoff'],
			'PickLocation' => $_POST['pickup'],
			'Purpose' => $_POST['purpose']
		]);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request successfully added";
		break;

	case 'AddVehicle':
		$vehicle = null;
		if ($_POST['IsLeased'] == "Yes") {
			$vehicle = $employee->addLeasedVehicle([
				'RegistrationNo' => $_POST['RegistrationNo'],
				'Model' => $_POST['Model'],
				'PurchasedYear' => $_POST['PurchasedYear'],
				'Value' => $_POST['Value'],
				'FuelType' => $_POST['FuelType'],
				'InsuranceValue' => $_POST['InsuranceValue'],
				'InsuranceCompany' => $_POST['InsuranceCompany'],
				'LeasedCompany' => $_POST['LeasedCompany'],
				'LeasedPeriodFrom' => $_POST['LeasedPeriodFrom'],
				'LeasedPeriodTo' => $_POST['LeasedPeriodTo'],
				'MonthlyPayment' => $_POST['MonthlyPayment']
			]);
		} else {
			$vehicle = $employee->addPurchasedVehicle([
				'RegistrationNo' => $_POST['RegistrationNo'],
				'Model' => $_POST['Model'],
				'PurchasedYear' => $_POST['PurchasedYear'],
				'Value' => $_POST['Value'],
				'FuelType' => $_POST['FuelType'],
				'InsuranceValue' => $_POST['InsuranceValue'],
				'InsuranceCompany' => $_POST['InsuranceCompany']
			]);
		}
		if ($vehicle !== null) {
			$object['error'] = false;
			$object['object'] = $vehicle;
			$object['message'] = "success_Vehicle " . $_POST['registration'] . " successfully added";
		} else {
			$object['error'] = true;
			$object['message'] = 'Failed to create a vehicle object';
		}

		break;

	case 'UpdateVehicle':
		$vehicle = null;

		if ($_POST['leasedCompany'] !== "") {
			$vehicle = $employee->updateLeasedVehicleInfo([
				
				'RegistrationNo' => $_POST['registration'],
				'Model' => $_POST['model'],
				'PurchasedYear' => $_POST['purchasedYear'],
				'Value' => $_POST['value'],
				'FuelType' => $_POST['fuelType'],
				'InsuranceValue' => $_POST['insuranceValue'],
				'InsuranceCompany' => $_POST['insuranceCompany'],
				'LeasedCompany' => $_POST['leasedCompany'],
				'LeasedPeriodFrom' => $_POST['leasedPeriodFrom'],
				'LeasedPeriodTo' => $_POST['leasedPeriodTo'],
				'MonthlyPayment' => $_POST['monthlyPayment']
			]);
		} else {
			$vehicle = $employee->updatePurchasedVehicleInfo([
				'RegistrationNo' => $_POST['registration'],
				'Model' => $_POST['model'],
				'PurchasedYear' => $_POST['purchasedYear'],
				'Value' => $_POST['value'],
				'FuelType' => $_POST['fuelType'],
				'InsuranceValue' => $_POST['insuranceValue'],
				'InsuranceCompany' => $_POST['insuranceCompany']
			]);
		}
		if ($vehicle !== null) {
			$object['error'] = false;
			$object['object'] = $vehicle;
			$object['message'] = "success_Vehicle " . $_POST['registration'] . " successfully updated";
		} else {
			$object['error'] = true;
			$object['message'] = 'Failed to create a vehicle object';
		}
		break;

	case 'ChangeVehiclePicture':
		print_r($_POST);
		$vehicleImageName = time() . '-' . $_FILES["Image"]["name"];

		$target_dir = "../images/vehiclePictures/";
		$target_file = $target_dir . basename($vehicleImageName);

		if (file_exists($target_file)) {
			$object['message'] = "File already exists";
		}
		if ($object['message'] == '') {
			if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
				$vehicle = $employee->UpdateVehiclePicture([
					'VehiclePicturePath' => $vehicleImageName,
					'RegistrationNo' => $_POST['registration'],
					'IsLeased' => ($_POST['leasedCompany'] !== "")
				]);
				if ($vehicle !== null) {
					$object['error'] = false;
					$object['object'] = $vehicle;
					$object['message'] = "success_Vehicle " . $_POST['registration'] . " successfully updated";
				} else {
					$object['error'] = true;
					$object['message'] = 'Failed to update a vehicle object';
				}
			} else {
				$object['message'] = "There was an error uploading the file";
			}
		}
		break;

	case 'CancelRequest':
		$request = $employee->cancelRequest($_POST['RequestId']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully cancelled";
		break;

	case 'DeletePurchasedVehicle':
		$vehicle = $employee->deletePurchasedVehicle($_POST['registration']);
		$object['error'] = false;
		$object['object'] = $vehicle;
		$object['message'] = "success_Vehicle " . $_POST['registration'] . " successfully deleted";
		break;

	case 'DeleteLeasedVehicle':
		$vehicle = $employee->deleteLeasedVehicle($_POST['registration']);
		$object['error'] = false;
		$object['object'] = $vehicle;
		$object['message'] = "success_Vehicle " . $_POST['registration'] . " successfully deleted";
		break;

	case 'Schedule':
		$request = $employee->scheduleRequest($_POST['RequestId'], $_POST['Driver'], $_POST['Vehicle']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully Assigned";
		break;

	case 'EndTrip':
		$request = $employee->closeRequest($_POST['RequestId']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Trip " . $_POST['RequestId'] . " successfully ended";
		break;

	case 'AddEmployee':
		$emp = $employee->createNewAccount([
			'EmpID' => $_POST['EmpID'],
			'FirstName' => $_POST['FirstName'],
			'LastName' => $_POST['LastName'],
			'Username' => "",
			'Designation' => $_POST['Designation'],
			'Position' => $_POST['Position'],
			'Email' => $_POST['Email'],
			'Password' => $_POST['Password'],
			'ContactNo' => $_POST['ContactNo']
		]);
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "success_Employee " . $_POST['empID'] . " successfully added";
		break;

	case 'UpdateEmployee':
		$emp = $employee->updateAccount([
			'NewEmpID' => $_POST['NewEmpID'],
			'EmpID' => $_POST['EmpID'],
			'FirstName' => $_POST['FirstName'],
			'LastName' => $_POST['LastName'],
			'Username' => "",
			'Designation' => $_POST['Designation'],
			'Position' => $_POST['Position'],
			'Email' => $_POST['Email'],
			'ContactNo' => $_POST['ContactNo']
		]);
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "success_Employee " . $_POST['empID'] . " successfully updated";
		break;

	case 'ChangeProfilePicture':

		$profileImageName = time() . '-' . $_FILES["Image"]["name"];

		$target_dir = "../images/userProfilePictures/";
		$target_file = $target_dir . basename($profileImageName);

		if ($_FILES['Image']['size'] > 200000) {
			$object['message'] = "Image size should not be greated than 200Kb";
		}

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
		$emp = $employee->removeAccount($_POST['empID']);
		$object['error'] = false;
		$object['object'] = $emp;
		$object['message'] = "success_Employee " . $_POST['empID'] . " successfully deleted";
		break;

	case 'AddDriver':
		$driver = $employee->createNewDriver([
			'DriverID' => $_POST['DriverID'],
			'FirstName' => $_POST['FirstName'],
			'LastName' => $_POST['LastName'],
			'Email' => $_POST['Email'],
			'Address' => $_POST['Address'],
			'ContactNo' => $_POST['ContactNo'],
			'LicenseNumber' => $_POST['LicenseNumber'],
			'LicenseType' => $_POST['LicenseType'],
			'LicenseExpirationDay' => $_POST['LicenseExpirationDay'],
			'DateOfAdmission' => $_POST['DateOfAdmission'],
			'AssignedVehicle' => ""
		]);
		$object['error'] = false;
		$object['request'] = $driver;
		$object['message'] = "success_Driver " . $_POST['driverId'] . " successfully added";
		break;

	case 'DeleteDriver':
		$driver = $employee->deleteDriver($_POST['driverId']);
		$object['error'] = false;
		$object['object'] = $driver;
		$object['message'] = "success_Driver " . $_POST['driverId'] . " successfully deleted";
		break;

	case 'UpdateDriver':
		$driver = $employee->updateDriverInfo(
			$_POST['driverID'],
			[
				'DriverID' => $_POST['DriverID'],
				'FirstName' => $_POST['FirstName'],
				'LastName' => $_POST['LastName'],
				'Email' => $_POST['Email'],
				'Address' => $_POST['Address'],
				'ContactNo' => $_POST['ContactNo'],
				'LicenseNumber' => $_POST['LicenseNumber'],
				'LicenseType' => $_POST['licenseType'],
				'LicenseExpirationDay' => $_POST['LicenseExpirationDay'],
				'DateOfAdmission' => $_POST['DateOfAdmission'],
				'AssignedVehicle' => ""
			]
		);
		$object['error'] = false;
		$object['object'] = $driver;
		$object['message'] = "success_Driver " . $_POST['employeeID'] . " successfully updated";
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
					'DriverId' => $_POST['driverId'],
					'DriverPicturePath' => $driverImageName
				]);
				if ($driver !== null) {
					$object['error'] = false;
					$object['object'] = $driver;
					$object['message'] = "success_Driver " . $_POST['driverId'] . " successfully updated";
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
		$driver = $employee->assignVehicleToDriver($_POST['driverId'], $_POST['assignedVehicleID']);
		$object['error'] = false;
		$object['request'] = $driver;
		$object['message'] = "success_Driver " . $_POST['driverId'] . " successfully assigned " . $_POST['assignedVehicleID'];
		break;

	case 'PrintSlip':
		$employee->generateVehicleHandoutSlip($_POST['RequestId']);
		$object['message'] = "success_Printed Slip For" . $_POST['RequestId'];
		break;

	case 'CancelTrip':
		$request = $employee->cancelRequest($_POST['RequestId']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully cancelled";
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
