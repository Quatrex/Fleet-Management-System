<?php

include_once '../includes/autoloader.inc.php';

session_start();

header("Content-type: application/json; charset=utf-8");
$method = $_POST['Method'];
$offset = $_POST['offset'];
$sort = [$_POST['sortColumn'] => $_POST['order']];
$search = [$_POST['keyword'] => [$_POST['searchColumn']]];
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

switch ($method) {
	case 'Load_requestsByMe':
		$requests = $employee->getMyRequests(['pending','justified','approved'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_ongoingRequests':
		$requests = $employee->getMyRequests(['scheduled'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_pastRequests':
		$requests = $employee->getMyRequests(['denied', 'cancelled', 'completed','expired'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToJustify':
		$requests = $employee->getPendingRequests($offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_justifiedRequests':
		$requests = $employee->getMyJustifiedRequests(['approved', 'justified', 'denied', 'expired', 'cancelled', 'completed'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToApprove':
		$requests = $employee->getJustifiedRequests($offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_approvedRequests':
		$requests = $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToAssign':
		$requests = $employee->getRequests('approved',$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_scheduledRequests':
		$requests = $employee->getRequests('scheduled',$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_scheduledHistoryRequests':
		$requests = $employee->getRequests(['scheduled','cancelled'],$offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_vehicles':
		$vehicles = $employee->getVehicles($offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $vehicles;
		break;

	case 'Load_drivers':
		$drivers = $employee->getDrivers($offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $drivers;
		break;

	case 'Load_employeess':
		$employees = $employee->getAllPriviledgedEmployees($offset,$sort,$search);
		$object['error'] = false;
		$object['object'] = $employees;
		break;
	
	default:
		$object['error'] = true;
		$object['message'] = 'Invalid method';
}

echo json_encode($object);