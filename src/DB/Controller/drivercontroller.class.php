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

    // public function updateRecord($driverId,$fields){
    //     parent::updateRecord($driverId,$fields);
    // }

}
