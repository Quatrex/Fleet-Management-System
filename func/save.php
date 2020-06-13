<?php
	include_once '../includes/autoloader.inc.php';
	
	$time=$_POST['time'];
	$date=$_POST['date'];
	$dropoff=$_POST['dropoff'];
	$pickup=$_POST['pickup'];
	$empid=$_POST['empID'];
	$purpose="text";
	//$requester=new Requester($empid,$_POST['firstname'],$_POST['lastname'],$_POST['position'],$_POST['email'],$_POST['username'],'asf');
	$requester=Requester::getObject('1');
	$requester->placeRequest($date,$time,$dropoff,$pickup,$purpose);
	
?>