<?php
	include_once './includes/autoloader.inc.php';
	include 'database.php';
	$time=$_POST['time'];
	$date=$_POST['date'];
	$dropoff=$_POST['dropoff'];
	$pickup=$_POST['pickup'];
	// $firstName=$_POST['firstName'];
	// $lastName=$_POST['lastName'];
	$empId=$_POST['empID'];
	// $position=$_POST['position'];
	// $username=$_POST['username'];
	// $email=$_POST['email'];
	// $purpose = "a";
	//$sql = "INSERT INTO school( name, email, phone, city) 
	//VALUES ($time,$date,$dropoff,$pickup)";
	$sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID,Purpose) VALUES($date, $time, $dropoff, $pickup,$empId ,'a')";
	$sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID,Purpose) VALUES(?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo json_encode(array("statusCode"=>201));
    }else {
        mysqli_stmt_bind_param($stmt, "ssssis", $date, $time, $dropoff, $pickup, $requesterID,$purpose);
		mysqli_stmt_execute($stmt);
		echo json_encode(array("statusCode"=>200));
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

	
	//$requester = new Requester(2,'poorna','gunathilaka','ca','p','poorna18','q');
    //$requester->placeRequest($date,$time,$pickup,$dropoff,"a");
	// if (mysqli_query($conn, $sql)) {
	//  	echo json_encode(array("statusCode"=>200));
	// } 
	// else {
	// 	echo json_encode(array("statusCode"=>201));
	// }
	// mysqli_close($conn);
?>