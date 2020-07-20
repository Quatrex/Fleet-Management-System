<?php

use EmailClient\EmailClient;
use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

include_once '../includes/autoloader.inc.php';


// ignore_user_abort(true);
// set_time_limit(0);

ob_start();
header("Content-type: application/json; charset=utf-8");

$requester = PrivilegedEmployeeFactory::makeEmployee(1);
$values = ['DateOfTrip' => '2020-10-21',
        'TimeOfTrip' => '10:21:00',
        'DropLocation' => 'Gampaha',
        'PickLocation' => 'Colombo',
        'Purpose' => 'Meeting'];
$request = $requester->placeRequest($values);
echo json_encode($request);
// do initial processing here
header('Connection: close');
header('Content-Length: '.ob_get_length());
ob_end_flush();
ob_flush();
flush();
$emailClient = EmailClient::getInstance();
$emailClient->sendEmails();