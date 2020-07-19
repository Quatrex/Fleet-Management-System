<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

include_once '../includes/autoloader.inc.php';
header("Content-type: application/json; charset=utf-8");

$requester = PrivilegedEmployeeFactory::makeEmployee(1);
$values = ['DateOfTrip' => '2020-10-21',
        'TimeOfTrip' => '10:21:00',
        'DropLocation' => 'Gampaha',
        'PickLocation' => 'Colombo',
        'Purpose' => 'Meeting'];
$request = $requester->placeRequest($values);
echo json_encode($request);