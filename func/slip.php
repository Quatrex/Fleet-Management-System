<?php

use Employee\Factory\Privileged\VPMO;

include_once '../includes/autoloader.inc.php';


session_start();

if (!isset($_SESSION['employee']))
    die('Please log in');

// if($_SESSION['employee'] !== VPMO::class)
//     die("Only VPMO is authorized to generate a handout slip.");

if(!isset($_GET['id']))
    die("Invalid Request ID");

$employee = $_SESSION['employee'];
$employee->generateVehicleHandoutSlip((int)$_GET['id']);