<?php
namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel{
    public function saveRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation) {
        parent::saveRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation);
    }

    public function updateRecord($registrationNo,$fields){
        parent::updateRecord($registrationNo,$fields);
    }
    
}

    