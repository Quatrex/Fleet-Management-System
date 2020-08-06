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
		$request = $employee->justifyRequest($_POST['RequestId'], $_POST['JOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully justified";
		break;

	case 'Load_ongoingRequests':
		$request = $employee->denyRequest($_POST['RequestId'], $_POST['JOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully denied";
		break;

	case 'Load_pastRequests':
		$request = $employee->approveRequest($_POST['RequestId'], $_POST['CAOComment']);
		$object['error'] = false;
		$object['object'] = $request;
		$object['message'] = "success_Request " . $_POST['RequestId'] . " successfully approved";
		break;

	default:
		$object['error'] = true;
		$object['message'] = 'Invalid method';
}

echo json_encode($object);