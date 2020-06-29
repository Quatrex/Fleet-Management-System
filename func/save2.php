<?php

use Employee\Requester;
use Employee\VPMO;

include_once '../includes/autoloader.inc.php';
$method = $_POST['AddMethod'];
switch ($method) {
	case 'JustifyJO':
		//code here
		break;
	case 'DenyJO':
		//code here
		break;

	case 'AcceptCAO':
		//code here
		break;

	case 'DenyCAO':
		//code here
		break;

	case 'RequestAdd':
		$requester = Requester::getObject($_POST['empID']);
		$requester->placeRequest($_POST['date'], $_POST['time'], $_POST['dropoff'], $_POST['pickup'], $_POST['purpose']);
		echo json_encode("Added");
		break;

	case 'AddVehicle':
		$vpmo = VPMO::getObject($_POST['empID']);
		//echo $_POST['model'];
		$vpmo->addVehicle($_POST['registrationNo'], $_POST['model'], $_POST['purchasedYear'], $_POST['value'], $_POST['fuelType'], $_POST['insuranceValue'], $_POST['insuranceCompany'], 1, $_POST['currentLocation']);
		echo json_encode("Added Vehicle");
		break;

	case 'UpdateVehicle':
		$vpmo = VPMO::getObject($_POST['empID']);
		$vpmo->updateVehicle($POST['registrationNo'], $POST['model'], $POST['purchasedYear'], $POST['value'], $POST['fuelType'], $POST['insuranceValue'], $POST['insuranceCompany'], $POST['inRepair'], $POST['currentLocation']);
		echo json_encode("Updated Vehicle");
		break;

	default:
		echo "Invalid method";
}
