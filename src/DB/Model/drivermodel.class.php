<?php
namespace DB\Model;

abstract class DriverModel extends Model{
    function __construct()
    {
        parent::__construct('driver');
    }

    protected function getRecordByID($driverId){
        $columnNames= array('DriverID');
        $columnVals= array($driverId);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results[0];
    }
    
    protected function getAllRecords(){
        $results = parent::getRecords(true,true);
        return $results;
    }

    //updateRecord
    protected function updateRecord($driverId,$fields){
        $columnNames = array_keys($fields);
        $columnNames= array_unshift($columnNames,'DriverID');
        $columnVals= array_unshift($driverId,array_values($fields));
        parent::updateRecord($columnNames,$columnVals);
        
    }
    //should contain a state of the vehicle
    protected function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email) {
        $columnNames = array('DriverID', 'FirstName', 'LastName', 'LicenseNumber', 'LicenseExpirationDay', 'DateOfAdmission', 'AssignedVehicleID', 'Email');
        $columnVals = array($driverId, $firstName, $lastName, $licenseNumber, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email);
        parent::addRecord($columnNames,$columnVals);
    }
}