<?php

include_once '../includes/autoloader.inc.php';

session_start();

header("Content-type: application/json; charset=utf-8");
$method = $_POST['Method'];
$offset = $_POST['Offset'];
$employee = $_SESSION['employee'];
$object = ['error' => true, 'object' => '', 'message' => ''];

switch ($method) {
	case 'Load_requestsByMe':
		$requests = $employee->getMyRequests(['pending','justified','approved'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_ongoingRequests':
		$request = $requests = $employee->getMyRequests(['scheduled'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	case 'Load_pastRequests':
		$request =  $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed'],$offset);
		$object['error'] = false;
		$object['object'] = $requests;
		break;

	default:
		$object['error'] = true;
		$object['message'] = 'Invalid method';
}

echo json_encode($object);