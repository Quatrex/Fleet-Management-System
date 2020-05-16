<?php
	include_once './includes/autoloader.inc.php';
	$servername = 'remotemysql.com';
    $username = 'Kvs8AuC78e';
    $password = 'bmMrp4oj2h';
    $db = 'Kvs8AuC78e';

	$conn = mysqli_connect($servername, $username, $password,$db);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$time=$_POST['time'];
	$date=$_POST['date'];
	$dropoff=$_POST['dropoff'];
	$pickup=$_POST['pickup'];
	$empid=$_POST['empID'];
	$purpose="text";

		$sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID) VALUES(?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
			die('Could not connect: ' . mysqli_error($conn));
        } else {
            if (!mysqli_stmt_bind_param($stmt, "ssssi", $date, $time, $dropoff, $pickup, $empid)) {
				die('Could not bind data: ' . mysqli_error($conn));
			}
			if (!mysqli_stmt_execute($stmt)) {
				die('Could not enter data: ' . mysqli_error($conn));
			}
		}
		$request=new Request("","","","","","");
		$request->notifyJOs();
        mysqli_close($conn);
?>