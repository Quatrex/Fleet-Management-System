<?php

include_once '../includes/autoloader.inc.php';

session_start();

header("Content-type: application/json; charset=utf-8");
$method = $_POST['Method'];
$offset = $_POST['offset'];
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

switch ($method) {
	case 'Load_requestsByMe':
		$requests = $employee->getMyRequests(['pending','justified','approved'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_ongoingRequests':
		$requests = $employee->getMyRequests(['scheduled'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_pastRequests':
		$requests =  $employee->getMyRequests(['denied', 'cancelled', 'completed'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToJustify':
		$requests =  $employee->getPendingRequests($offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_justifiedRequests':
		$requests =  $employee->getMyJustifiedRequests(['approved', 'justified', 'denied', 'expired', 'cancelled', 'completed'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToApprove':
		$requests =  $employee->getJustifiedRequests();
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_approvedRequests':
		$requests =  $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_requestsToAssign':
		$requests =  $employee->getRequests('approved',$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	case 'Load_scheduledRequests':
		$requests =  $employee->getRequests('scheduled',$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;
	
	default:
		$object['error'] = true;
		$object['message'] = 'Invalid method';
}

echo json_encode($object);