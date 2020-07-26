<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

include_once '../includes/autoloader.inc.php';

header("Content-type: application/json; charset=utf-8");

// $employee = PrivilegedEmployeeFactory::makeEmployee(47);
// $employee->generateVehicleHandoutSlip(184);

$employee = PrivilegedEmployeeFactory::makeEmployee(1);
$request = $employee->placeRequest([
    'DateOfTrip' => '2012-12-12',
    'TimeOfTrip' => '12:12:00',
    'DropLocation' => 'A',
    'PickLocation' => 'B',
    'Purpose' => 'C']);
$object['error'] = false;
$object['object'] = $request;
$object['message'] = "success_Request successfully added";

echo json_encode($object);