<?php

namespace DB\Controller;

use DB\Model\DriverModel;

class DriverController extends DriverModel
{
    public function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state)
    {
        parent::saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state);
    }

    // public function updateRecord($driverId,$fields){
    //     parent::updateRecord($driverId,$fields);
    // }

}
