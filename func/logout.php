<?php
session_start();
if (!isset($_SESSION['empid'])) { 
    header("location: ../index.php");
    exit();
} else {
    $_SESSION = array();
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    header("location: ../index.php");
}
