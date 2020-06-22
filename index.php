<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ./func/login.php');
	exit;
}
else{
    if ($_SESSION['position']=='requester') {
        header('Location: ./Layout/requester.php');
    }
    elseif ($_SESSION['position']=='jo') {
        header('Location: ./Layout/jo.php');
    }
    exit;
}
?>