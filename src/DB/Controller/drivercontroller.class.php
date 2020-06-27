<?php
namespace DB\Controller;

use DB\Model\DriverModel;

class DriverController extends DriverModel{
    public function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email) {
        parent::saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email);
    }

    public function updateRecord($driverId,$fields){
        parent::updateRecord($driverId,$fields);
    }
    
}

    