<?php

use DB\Controller\RequestController;
use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use Request\Factory\Base\RealRequest;

include_once '../includes/autoloader.inc.php';

// header("Content-type: application/json; charset=utf-8");

// $employee = PrivilegedEmployeeFactory::makeEmployee(47);
// $employee->generateVehicleHandoutSlip(184);

// $employee = PrivilegedEmployeeFactory::makeEmployee(1);
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

RealRequest::expireRequests();