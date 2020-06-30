<?php

use Employee\CAO;
use Employee\Requester;
use Employee\JO;
use Employee\VPMO;

include_once '../includes/autoloader.inc.php';
$method = $_POST['Method'];
switch ($method) {
	case 'JOJustify':
		$jo = JO::getObject($_POST['empID']);
		$jo->justifyRequest($_POST['justify-requestID'], $_POST['justify-comment']);
		echo json_encode("Justified");
		break;
	case 'JODeny':
		$jo = JO::getObject($_POST['empID']);
		$jo->denyRequest($_POST['deny-requestID'], $_POST['decline-comment']);
		echo json_encode("Denied By JO");
		break;

	case 'CAOApprove':
		$cao = CAO::getObject($_POST['empID']);
		$cao->approveRequest($_POST['approve-requestID'], $_POST['approve-comment']);
		echo json_encode("Approved");
		break;

	case 'CAODeny':
		$cao = CAO::getObject($_POST['empID']);
		$cao->denyRequest($_POST['CAOdeny-requestID'], $_POST['CAO-deny-comment']);
		echo json_encode("Denied By CAO");
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
	case 'CancelRequest':
		$requester = Requester::getObject($_POST['empID']);
		$requester->cancelRequest($_POST['requestID']);
		echo json_encode("Cancelled");
		break;

	default:
		echo "Invalid method";
}
