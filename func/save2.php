<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
session_start();
include_once '../includes/autoloader.inc.php';
$method = $_POST['Method'];
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
print_r($_SESSION['empid']);
switch ($method) {
	case 'JOJustify':
		$employee->justifyRequest($_POST['RequestId'], $_POST['JOComment']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully justified");
		break;
	case 'JODeny':
		$employee->denyRequest($_POST['RequestId'], $_POST['JOComment']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully denied");
		break;

	case 'CAOApprove':
		$employee->approveRequest($_POST['RequestId'], $_POST['CAOComment']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully approved");
		break;

	case 'CAODeny':
		$employee->denyRequest($_POST['RequestId'], $_POST['CAOComment']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully denied");
		break;

	case 'RequestAdd':
		$employee->placeRequest([
			'DateOfTrip' => $_POST['date'],
			'TimeOfTrip' => $_POST['time'],
			'DropLocation' => $_POST['dropoff'],
			'PickLocation' => $_POST['pickup'],
			'Purpose' => $_POST['purpose']
		]);
		echo json_encode("success_Request successfully added");
		break;

	case 'AddVehicle':
		//echo $_POST['model'];
		if ($_POST['isLeased'] == "Yes") {
			$employee->addLeasedVehicle([
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
			$employee->addPurchasedVehicle([
				'RegistrationNo' => $_POST['registration'],
				'Model' => $_POST['model'],
				'PurchasedYear' => $_POST['purchasedYear'],
				'Value' => $_POST['value'],
				'FuelType' => $_POST['fuelType'],
				'InsuranceValue' => $_POST['insuranceValue'],
				'InsuranceCompany' => $_POST['insuranceCompany']
			]);
		}

		echo json_encode("success_Vehicle " . $_POST['registration'] . " successfully added");
		break;

	case 'UpdateVehicle':
		if ($_POST['leasedCompany'] !== "") {
			$employee->updateLeasedVehicleInfo([
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
			$employee->updatePurchasedVehicleInfo([
				'RegistrationNo' => $_POST['registrationNo'],
				'Model' => $_POST['model'],
				'PurchasedYear' => $_POST['purchasedYear'],
				'Value' => $_POST['value'],
				'FuelType' => $_POST['fuelType'],
				'InsuranceValue' => $_POST['insuranceValue'],
				'InsuranceCompany' => $_POST['insuranceCompany']
			]);
		}
		echo json_encode("success_Vehicle " . $_POST['registrationNo'] . " successfully updated");
		break;
	case 'CancelRequest':
		$employee->cancelRequest($_POST['RequestId']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully cancelled");
		break;

	case 'DeletePurchasedVehicle':
		$employee->deletePurchasedVehicle($_POST['VehicleID']);
		echo json_encode("success_Vehicle " . $_POST['VehicleID'] . " successfully deleted");
		break;
	case 'DeleteLeasedVehicle':
		$employee->deleteLeasedVehicle($_POST['VehicleID']);
		echo json_encode("success_Vehicle " . $_POST['VehicleID'] . " successfully deleted");
		break;
	case 'Schedule':
		$employee->scheduleRequest($_POST['RequestId'], $_POST['Driver'], $_POST['Vehicle']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully Assigned");
		break;
	case 'EndTrip':
		$employee->closeRequest($_POST['RequestId']);
		echo json_encode("success_Trip " . $_POST['RequestId'] . " successfully ended");
		break;
	case 'AddEmployee':
		$employee->createNewAccount(['EmpID' => $_POST['newEmployeeId'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Username' => "", 'Designation' => $_POST['designation'], 'Position' => $_POST['position'], 'Email' => $_POST['email'], 'Password' => $_POST['password'], 'ContactNo' => $_POST['contactNo']]);
		echo json_encode("success_Employee " . $_POST['newEmployeeId'] . " successfully added");
		break;
	case 'UpdateEmployee':
		$employee->updateAccount(['NewEmpID' => $_POST['employeeID'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Username' => "", 'Designation' => $_POST['designation'],'Position' => $_POST['position'], 'Email' => $_POST['email'], 'ContactNo' => $_POST['contactNo']]);
		echo json_encode("success_Employee " . $_POST['employeeID'] . " successfully updated");
		break;
	case 'DeleteEmployee':
		$employee->removeAccount($_POST['employeeID']);
		echo json_encode("success_Employee " . $_POST['employeeID'] . " successfully deleted");
		break;
	case 'AddDriver':
		$employee->createNewDriver(['DriverID' => $_POST['driverId'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Email' => $_POST['email'], 'Address' => $_POST['address'], 'ContactNo' => $_POST['contactNo'], 'LicenseNumber' => $_POST['licenseNo'], 'LicenseType' => $_POST['licenseType'], 'LicenseExpirationDay' => $_POST['licenseExpireDate'], 'DateOfAdmission' => $_POST['employedDate'], 'AssignedVehicleID' => ""]);
		echo json_encode("success_Driver " . $_POST['driverId'] . " successfully added");
		break;
	case 'DeleteDriver':
		//code to delete
		echo json_encode("success_Driver " . $_POST['driverId'] . " successfully deleted");
		break;
	case 'UpdateDriver':
		//code to update
		echo json_encode("success_Driver " . $_POST['employeeID'] . " successfully updated");
		break;
	default:
		echo "Invalid method";
}
