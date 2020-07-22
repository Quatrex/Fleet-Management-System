<?php

namespace DB\Controller;

use DB\Model\DriverModel;

class DriverController extends DriverModel
{
    public function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state, $numOfAllocations)
    {
        parent::saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state, $numOfAllocations);
    }

    public function updateNumOfAllocations(string $driverId, int $numOfAllocations){
        parent::updateNumOfAllocations($driverId, $numOfAllocations);
    }

    public function updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicle, $email){
        parent::updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicle, $email);
    }

    public function updateAssignedVehicle($driverId,$assignedVehicle){
        parent::updateAssignedVehicle($driverId,$assignedVehicle);
    }

    // public function updateRecord($driverId,$fields){
    //     parent::updateRecord($driverId,$fields);
    // }

}
