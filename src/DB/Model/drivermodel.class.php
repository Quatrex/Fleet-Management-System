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
    
    // protected function getAllRecords(){
    //     $results = parent::getRecords(true,true);
    //     return $results;
    // }

    //updateRecord
    // protected function updateRecord($driverId,$fields){
    //     $columnNames = array_keys($fields);
    //     $columnNames= array_unshift($columnNames,'DriverID');
    //     $columnVals= array_unshift($driverId,array_values($fields));
    //     parent::updateRecord($columnNames,$columnVals);
        
    // }
    //should contain a state of the driver
    protected function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state) {
        $columnNames = array('DriverID', 'FirstName', 'LastName', 'LicenseNumber', 'LicenseType', 'LicenseExpirationDay', 'DateOfAdmission', 'AssignedVehicleID', 'Email', 'State');
        $columnVals = array($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state);
        parent::addRecord($columnNames,$columnVals);
    }
}