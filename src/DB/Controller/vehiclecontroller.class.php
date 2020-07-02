<?php
namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel{
    public function savePurchasedVehicleRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation) {
        $isLeasedVehicle=false; //$isLeasedVehicle is initialized here
        parent::saveRecordToVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation,$isLeasedVehicle);
    }

    public function saveLeasedVehicleRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation,$leasedCompany,$leasedPeriodFrom,$leasedPeriodTo,$monthlyPayment) {
        $isLeasedVehicle=true; //$isLeasedVehicle is initialized here
        parent::saveRecordToVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation, $isLeasedVehicle); //$isLeasedVehicle is initialized here
        parent::saveRecordToLeasedVehicle($registrationNo,$leasedCompany,$leasedPeriodFrom,$leasedPeriodTo,$monthlyPayment);
    }

    public function updatePurchasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany){
        parent::updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
    }

    public function updateLeasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment){
        parent::updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
        parent::updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    } 
}

    