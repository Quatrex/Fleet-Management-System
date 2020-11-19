<?php
session_start();
if (!isset($_SESSION['position'])) {
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
    elseif(($_SESSION['position']=='admin')){
        header('Location: ./Layout/administrator.php');
    }
    elseif(($_SESSION['position']=='requester')){
        header('Location: ./Layout/requester.php');
    }
    else {
        header('Location: ./Layout/404.php');
    }
    
    exit;
}
?>