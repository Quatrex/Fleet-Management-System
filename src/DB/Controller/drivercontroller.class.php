<?php

namespace DB\Controller;

use DB\Model\DriverModel;

class DriverController extends DriverModel
{
    /**
     * @inheritDoc
     */
    public function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state, $numOfAllocations, $profilePicturePath)
    {
        parent::saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state, $numOfAllocations, $profilePicturePath);
    }

    /**
     * @inheritDoc
     */
    public function updateNumOfAllocations(string $driverId, int $numOfAllocations, int $stateID){
        parent::updateNumOfAllocations($driverId, $numOfAllocations, $stateID);
    }

    /**
     * @inheritDoc
     */
    public function updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $email){
        parent::updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $email);
    }

    /**
     * @inheritDoc
     */
    public function updateDriverPicture($driverId,$imagePath)
    {
        parent::updateDriverPicture($driverId,$imagePath);
    }

    /**
     * @inheritDoc
     */
    public function updateAssignedVehicle($driverId,$assignedVehicle){
        parent::updateAssignedVehicle($driverId,$assignedVehicle);
    }

    /**
     * @inheritDoc
     */
    public function deleteDriver($driverID){
        parent::deleteDriver($driverID);
    }

    // public function updateRecord($driverId,$fields){
    //     parent::updateRecord($driverId,$fields);
    // }

}
