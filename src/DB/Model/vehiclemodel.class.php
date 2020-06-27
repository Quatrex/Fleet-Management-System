<?php
namespace DB\Model;

abstract class VehicleModel extends Model{
    //+ saveRecord(VehicleInfo)
    //+updateRecord(VehicleInfo)
    function __construct()
    {
        parent::__construct('vehicle');
    }

    protected function getRecordByID($registrationNo){
        $columnNames= array('RegistrationNo');
        $columnVals= array($registrationNo);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results[0];
    }
    
    protected function getAllRecords(){
        $results = parent::getRecords([],[]);
        return $results;
    }

    //updateRecord
    protected function updateRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation){
        $columnNames = array('RegistrationNo','Model','PurchasedYear','Value','FuelType','InsuranceValue','InsuranceCompany','InRepair','CurrentLocation');
        $columnVals = array($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation);
        $conditionNames= array('RegistrationNo');
        $conditionVals= array($registrationNo);
        parent::updateRecord($columnNames,$columnVals,$conditionNames,$conditionVals);
        
    }
    //should contain a state of the vehicle
    protected function saveRecord($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation) {
        $columnNames = array('RegistrationNo','Model','PurchasedYear', 'Value','FuelType','InsuranceValue','InsuranceCompany','InRepair','CurrentLocation');
        $columnVals = array($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation);
        parent::addRecord($columnNames,$columnVals);
    }
}