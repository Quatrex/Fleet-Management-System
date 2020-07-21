<?php

use Request\Factory\VPMORequest\VPMORequestFactory;

include_once '../includes/autoloader.inc.php';

$request=VPMORequestFactory::makeRequest(184);
$token=$request->generateVehicleHandoutSlip();
$token->print();