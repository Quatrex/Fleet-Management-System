<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ./func/login.php');
	exit;
}
else{
    if ($_SESSION['position']=='jo') {
        header('Location: ./Layout/jo.php');
    }
    else {
        header('Location: ./Layout/requester.php');
    }
    
    exit;
}
?>