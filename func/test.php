<?php

use DB\Controller\RequestController;
use DB\Viewer\VehicleViewer;
use Employee\Factory\Driver\DriverFactory;
use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use Request\Factory\Base\RealRequest;
use Vehicle\Factory\Base\VehicleFactory;

include_once '../includes/autoloader.inc.php';

header("Content-type: application/json; charset=utf-8");

// $employee = PrivilegedEmployeeFactory::makeEmployee(47);
// $employee->generateVehicleHandoutSlip(184);

$employee = PrivilegedEmployeeFactory::makeEmployee(1);
// $request = $employee->placeRequest([
//     'DateOfTrip' => '2012-12-12',
//     'TimeOfTrip' => '12:12:00',
//     'DropLocation' => 'A',
//     'PickLocation' => 'B',
//     'Purpose' => 'C']);
// $requests =  $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed'],0);
// foreach($requests as $request)
//     echo $request->getField('requestID') . "<br>";
// echo "===========================================<br>";

// $requests =  $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed'],1);
// foreach($requests as $request)
//     echo $request->getField('requestID') . "<br>";
// echo "===========================================<br>";

// $object['error'] = false;
// $object['object'] = $requests;
// $object['message'] = "success_Request successfully added";

// echo json_encode($object);

// $requests = $employee->getMyRequests(['scheduled', 'justified'], 0, ['CreatedDate' => 'DESC'], ['Ampara' => ['PickLocation']]);
// //print_r($requests);
// $vehicle=DriverFactory::makeDriver('1');
// print_r($vehicle->getField('assignedRequests'));

$vv = new VehicleViewer();
$vehicles = $vv->getAllRecords(0,['RegistrationNo' => 'ASC'],['' => ['All']],[]);
print_r($vehicles);