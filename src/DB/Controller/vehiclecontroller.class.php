<?php

namespace DB\Controller;

use DB\Model\VehicleModel;

class VehicleController extends VehicleModel
{
    /**
     * Add new purchcased vehicle
     *
     * @param $registrationNo
     * @param $model
     * @param $purchasedYear
     * @param $value
     * @param $fuelType
     * @param $insuranceValue
     * @param $insuranceCompany
     * @param $assignedOfficer
     * @param $state
     * @param $currentLocation
     * @param $numOfAllocations
     */
    public function savePurchasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, $vehiclePicturePath)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, 0, $vehiclePicturePath);
    }

    /**
     * Add new leased vehicle
     *
     * @param $registrationNo
     * @param $model
     * @param $purchasedYear
     * @param $value
     * @param $fuelType
     * @param $insuranceValue
     * @param $insuranceCompany
     * @param $assignedOfficer
     * @param $state
     * @param $currentLocation
     * @param $numOfAllocations
     * @param $leasedCompany
     * @param $leasedPeriodFrom
     * @param $leasedPeriodTo
     * @param $monthlyPayment
     */
    public function saveLeasedVehicleRecord($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment, $vehiclePicturePath)
    {
        parent::saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, 1, $vehiclePicturePath);
        parent::saveRecordToLeasedVehicle($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    /**
     * Change purchased vehicle information
     *
     * @param $registrationNo
     * @param $newRegistrationNo
     * @param $model
     * @param $purchasedYear
     * @param $value
     * @param $fuelType
     * @param $insuranceValue
     * @param $insuranceCompany
     * @param $assignedOfficer
     */
    public function updatePurchasedVehicleInfo($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer)
    {
        parent::updateVehicleRow($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
    }

    public function updateLeasedVehicleInfo($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::updateVehicleRow($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer);
        parent::updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    public function updateAssignedOfficer($registrationNo, $assignedOfficer)
    {
        parent::updateAssignedOfficer($registrationNo, $assignedOfficer);
    }

    public function updatePicture(string $registrationNo, string $imagePath)
    {
        parent::updateVehiclePicture($registrationNo,$imagePath);
    }

    public function updateNumOfAllocations(string $registrationNo, int $numOfAllocations, int $stateID)
    {
        parent::updateNumOfAllocations($registrationNo, $numOfAllocations, $stateID);
    }

    public function deleteVehicle($registrationNo)
    {
        parent::deleteVehicle($registrationNo);
    }
}
