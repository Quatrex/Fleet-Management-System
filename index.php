<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ./Layout/login.php');
	exit;
}
else{
    if ($_SESSION['position']=='jo') {
        header('Location: ./Layout/jo.php');
    }
    elseif ($_SESSION['position']=='cao') {
        header('Location: ./Layout/cao.php');
    }
    elseif ($_SESSION['position']=='vpmo') {
        header('Location: ./Layout/vpmo.php');
    }
    else {
        header('Location: ./Layout/requester.php');
    }
    
    exit;
}
?>