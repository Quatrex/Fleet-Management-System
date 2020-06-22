<?php
	use Employee\Requester;

	include_once '../includes/autoloader.inc.php';
	$timeOfTrip=$_POST['time'];
	$dateOfTrip=$_POST['date'];
	$dropLocation=$_POST['dropoff'];
	$pickLocation=$_POST['pickup'];
	$empID=$_POST['empID'];

	//$requester=new Requester($empid,$_POST['firstname'],$_POST['lastname'],$_POST['position'],$_POST['email'],$_POST['username'],'asf');
	$requester=Requester::getObject($empID);
	$requester->placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,"");	
?>