<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

include_once '../includes/autoloader.inc.php';

$employee = PrivilegedEmployeeFactory::makeEmployee(47);
$employee->generateVehicleHandoutSlip(184);