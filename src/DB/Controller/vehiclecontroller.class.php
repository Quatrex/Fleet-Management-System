<?php

namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel
{
    public function savePurchasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, 0);
    }

    public function saveLeasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, 1);
        parent::saveRecordToLeasedVehicle($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    public function updatePurchasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer)
    {
        parent::updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
    }

    public function updateLeasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
        parent::updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    public function deleteVehicle($registrationNo)
    {
        parent::deleteVehicle($registrationNo);
    }
}
