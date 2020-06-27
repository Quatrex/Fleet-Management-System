<?php

use Employee\JO;
use Employee\Requester;

include_once '../includes/autoloader.inc.php';
$method = $_POST['action'];
if ($method == 'JustifyJO') {
    $jo=JO::getObject($_POST['emp_ID']);
    $jo->justifyRequest($_POST['request_ID'],$_POST['comment']);
    echo true;
} elseif ($method == 'DenyJO') {
	//code
} elseif ($method == 'AcceptCAO') {
	//code
} elseif ($method == 'DenyCAO') {
	//code
} elseif ($method == 'RequestAdd') {
	$requester = Requester::getObject($_POST['empID']);
	$requester->placeRequest($_POST['date'], $_POST['time'], $_POST['dropoff'], $_POST['pickup'], "");
	echo json_encode("Added");
} elseif ($method == 'AddVehicle') {
} elseif ($method == 'UpdateVehicle') {
} elseif ($method == '') {
}
