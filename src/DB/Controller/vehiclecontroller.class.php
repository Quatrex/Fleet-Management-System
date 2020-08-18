<?php

namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel
{
    public function savePurchasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, 0);
    }

    public function saveLeasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, 1);
        parent::saveRecordToLeasedVehicle($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    public function updatePurchasedVehicleInfo($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer)
    {
        parent::updateVehicleRow($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
    }

    public function updateLeasedVehicleInfo($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::updateVehicleRow($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
        parent::updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    public function updatePicture(string $registrationNo, string $imagePath)
    {
        parent::updateVehiclePicture($registrationNo,$imagePath);
    }

    public function updateNumOfAllocations(string $registrationNo, int $numOfAllocations)
    {
        parent::updateNumOfAllocations($registrationNo, $numOfAllocations);
    }

    public function deleteVehicle($registrationNo)
    {
        parent::deleteVehicle($registrationNo);
    }
}
