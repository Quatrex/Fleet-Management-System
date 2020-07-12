<?php
namespace DB\Viewer;

use DB\Model\VehicleModel;

class VehicleViewer extends VehicleModel{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($registrationNo, $isLeased = false){
        return parent::getRecordByID($registrationNo, $isLeased);
    }

    public function getAllRecords(string $vehicleType){
        return parent::getAllRecords($vehicleType);
    }

    public function isLeasedVehicle($registrationNo) : bool 
    {
        return parent::isLeasedVehicle($registrationNo);
    }

}