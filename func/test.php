<?php

use DB\Viewer\RequestViewer;
use EmailClient\EmailClient;
use EmailClient\INotifiableRequest;
use Request\Factory\VPMORequest\VPMORequestFactory;
use Request\Factory\VPMORequest\VPMORequestProxy;

include_once '../includes/autoloader.inc.php';

$request=VPMORequestFactory::makeRequest(184);
//print_r($request);
$token=$request->generateVehicleHandoutSlip();


print_r($token);

    

