<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

include_once '../includes/autoloader.inc.php';
$method = $_POST['Method'];
switch ($method) {
	case 'JOJustify':
		$jo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$jo->justifyRequest($_POST['justify-requestID'], $_POST['justify-comment']);
		echo json_encode("success_Request " . $_POST['justify-requestID'] . " successfully justified");
		break;
	case 'JODeny':
		$jo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$jo->denyRequest($_POST['deny-requestID'], $_POST['decline-comment']);
		echo json_encode("success_Request " . $_POST['deny-requestID'] . " successfully denied");
		break;

	case 'CAOApprove':
		$cao = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$cao->approveRequest($_POST['approve-requestID'], $_POST['approve-comment']);
		echo json_encode("success_Request " . $_POST['approve-requestID'] . " successfully approved");
		break;

	case 'CAODeny':
		$cao = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$cao->denyRequest($_POST['CAOdeny-requestID'], $_POST['CAO-deny-comment']);
		echo json_encode("success_Request " . $_POST['CAOdeny-requestID'] . " successfully denied");
		break;

	case 'RequestAdd':
		$requester = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$requester->placeRequest([
			'DateOfTrip' => $_POST['date'],
			'TimeOfTrip' => $_POST['time'],
			'DropLocation' => $_POST['dropoff'],
			'PickLocation' => $_POST['pickup'],
			'Purpose' => $_POST['purpose']
		]);
		echo json_encode("success_Request successfully added");
		break;

	case 'AddVehicle':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		//echo $_POST['model'];
		if ($_POST['isLeased'] == "Yes") {
			$vpmo->addLeasedVehicle([
				'RegistrationNo' => $_POST['registrationNo'],
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
			$vpmo->addPurchasedVehicle([
				'RegistrationNo' => $_POST['registrationNo'],
				'Model' => $_POST['model'],
				'PurchasedYear' => $_POST['purchasedYear'],
				'Value' => $_POST['value'],
				'FuelType' => $_POST['fuelType'],
				'InsuranceValue' => $_POST['insuranceValue'],
				'InsuranceCompany' => $_POST['insuranceCompany']
			]);
		}

		echo json_encode("success_Vehicle " . $_POST['registrationNo'] . " successfully added");
		break;

	case 'UpdateVehicle':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		if ($_POST['leasedCompany'] !== "") {
			$vpmo->updateLeasedVehicleInfo([
				'RegistrationNo' => $_POST['registrationNo'],
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
			$vpmo->updatePurchasedVehicleInfo([
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
		$requester = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$requester->cancelRequest($_POST['requestID']);
		echo json_encode("success_Request " . $_POST['requestID'] . " successfully cancelled");
		break;

	case 'DeletePurchasedVehicle':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$vpmo->deletePurchasedVehicle($_POST['VehicleID']);
		echo json_encode("success_Vehicle " . $_POST['VehicleID'] . " successfully deleted");
		break;
	case 'DeleteLeasedVehicle':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$vpmo->deleteLeasedVehicle($_POST['VehicleID']);
		echo json_encode("success_Vehicle " . $_POST['VehicleID'] . " successfully deleted");
		break;
	case 'Schedule':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$vpmo->scheduleRequest($_POST['RequestId'], $_POST['DriverId'], $_POST['VehicleId']);
		echo json_encode("success_Request " . $_POST['RequestId'] . " successfully Assigned");
		break;
	case 'EndTrip':
		$vpmo = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$vpmo->closeRequest($_POST['RequestId']);
		echo json_encode("success_Trip " . $_POST['RequestId'] . " successfully ended");
		break;
	case 'AddEmployee':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$admin->createNewAccount(['EmpID' => $_POST['newEmployeeId'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Username' => "", 'Designation' => $_POST['designation'], 'Position' => $_POST['position'], 'Email' => $_POST['email'], 'Password' => $_POST['password'], 'ContactNo' => $_POST['contactNo']]);
		echo json_encode("success_Employee " . $_POST['newEmployeeId'] . " successfully added");
		break;
	case 'UpdateEmployee':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$admin->updateAccount(['NewEmpID' => $_POST['employeeID'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Username' => "", 'Designation' => $_POST['designation'],'Position' => $_POST['position'], 'Email' => $_POST['email'], 'ContactNo' => $_POST['contactNo']]);
		echo json_encode("success_Employee " . $_POST['employeeID'] . " successfully updated");
		break;
	case 'DeleteEmployee':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$admin->removeAccount($_POST['employeeID']);
		echo json_encode("success_Employee " . $_POST['employeeID'] . " successfully deleted");
		break;
	case 'AddDriver':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		$admin->createNewDriver(['DriverID' => $_POST['driverId'], 'FirstName' => $_POST['firstName'], 'LastName' => $_POST['lastName'], 'Email' => $_POST['email'], 'Address' => $_POST['address'], 'ContactNo' => $_POST['contactNo'], 'LicenseNumber' => $_POST['licenseNo'], 'LicenseType' => $_POST['licenseType'], 'LicenseExpirationDay' => $_POST['licenseExpireDate'], 'DateOfAdmission' => $_POST['employedDate'], 'AssignedVehicleID' => ""]);
		echo json_encode("success_Driver " . $_POST['driverId'] . " successfully added");
		break;
	case 'DeleteDriver':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		//code to delete
		echo json_encode("success_Driver " . $_POST['driverId'] . " successfully deleted");
		break;
	case 'UpdateDriver':
		$admin = PrivilegedEmployeeFactory::makeEmployee($_POST['empID']);
		//code to update
		echo json_encode("success_Driver " . $_POST['employeeID'] . " successfully updated");
		break;
	default:
		echo "Invalid method";
}
