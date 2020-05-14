<?php
session_start();
$servername = 'remotemysql.com';
$dBUsername = 'Kvs8AuC78e';
$dBPassword = 'bmMrp4oj2h';
$dBName = 'Kvs8AuC78e';

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}

if ($stmt = $conn->prepare('SELECT empid,firstname,lastname,position,email,password FROM employee WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($empid,$firstname,$lastname,$position,$email, $password);
        $stmt->fetch();
        if ($_POST['password'] === $password) {
            //TODO: password hashing
        //if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['empid'] = $empid;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['position'] = $position;
            $_SESSION['email'] = $email;
            header('Location: home.php');
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }

	$stmt->close();
}
?>