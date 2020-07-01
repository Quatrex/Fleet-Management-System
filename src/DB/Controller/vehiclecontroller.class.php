<?php
namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel{
    public function savePurchasedVehicleRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation) {
        parent::saveRecordToVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation);
    }

    public function saveLeasedVehicleRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation,$leasedCompany,$leasedPeriodFrom,$leasedPeriodTo,$monthlyPayment) {
        parent::saveRecordToVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation);
        parent::saveRecordToLeasedVehicle($registrationNo,$leasedCompany,$leasedPeriodFrom,$leasedPeriodTo,$monthlyPayment);
    }

    public function updateRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation){
        parent::updateRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation);
    } 
}

    