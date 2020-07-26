<?php

use Employee\Factory\Privileged\VPMO;

session_start();

if (!isset($_SESSION['employee']))
    die('Please log in');

if($_SESSION['employee'] !== VPMO::class)
    die("Only VPMO is authorized to generate a handout slip.");

$employee = $_SESSION['employee'];
$employee->generateVehicleHandoutSlip($_POST['RequestId']);