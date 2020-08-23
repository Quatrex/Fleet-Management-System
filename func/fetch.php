<?php

use Input\Input;

include_once '../includes/autoloader.inc.php';

session_start();

header("Content-type: application/json; charset=utf-8");
if (Input::exists()) {
	$method = Input::get('Method');
	$offset = Input::get('offset');
	$sort = [Input::get('sortColumn') => Input::get('order')];
	$search = [Input::get('keyword') => [Input::get('searchColumn')]];
	$employee = $_SESSION['employee'];
	$object = ['error' => true, 'object' => '', 'message' => ''];

	switch ($method) {
		case 'Load_requestsByMe':
			$requests = $employee->getMyRequests(['pending', 'justified', 'approved'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_ongoingRequests':
			$requests = $employee->getMyRequests(['scheduled'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_pastRequests':
			$requests = $employee->getMyRequests(['denied', 'cancelled', 'completed', 'expired'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_requestsToJustify':
			$requests = $employee->getPendingRequests($offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_justifiedRequests':
			$requests = $employee->getMyJustifiedRequests(['approved', 'justified', 'denied', 'expired', 'cancelled', 'completed'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_requestsToApprove':
			$requests = $employee->getJustifiedRequests($offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_approvedRequests':
			$requests = $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_requestsToAssign':
			$requests = $employee->getRequests('approved', $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_scheduledRequests':
			$requests = $employee->getRequests('scheduled', $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_scheduledHistoryRequests':
			$requests = $employee->getRequests(['scheduled', 'cancelled'], $offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $requests;
			break;

		case 'Load_vehicles':
			$vehicles = $employee->getVehicles($offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $vehicles;
			break;

		case 'Load_vehicles_assignedRequests':
			$vehicle = Input::get('object');
			$updatedVehicle = $employee->loadAssignedRequests($vehicle, 'vehicle');
			$object['error'] = false;
			$object['object'] = $updatedVehicle;
			break;


		case 'Load_availableVehicles':
			$vehicles = $employee->getVehicles($offset, $sort, $search, true);
			$object['error'] = false;
			$object['object'] = $vehicles;
			break;

		case 'Load_drivers':
			$drivers = $employee->getDrivers($offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $drivers;
			break;
		case 'Load_drivers_assignedRequests':
			$driver = Input::get('object');
			$updatedDriver = $employee->loadAssignedRequests($driver, 'driver');
			$object['error'] = false;
			$object['object'] = $updatedDriver;
			// print_r($updatedDriver);
			break;

		case 'Load_employeess':
			$employees = $employee->getAllPriviledgedEmployees($offset, $sort, $search);
			$object['error'] = false;
			$object['object'] = $employees;
			break;

		default:
			$object['error'] = true;
			$object['message'] = 'Invalid method';
	}

	echo json_encode($object);
}
