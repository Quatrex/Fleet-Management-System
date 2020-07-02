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

    protected function saveRecordToVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation,$isLeasedVehicle){
        $columnNames = array('RegistrationNo','Model','PurchasedYear', 'Value','FuelType','InsuranceValue','InsuranceCompany','State','CurrentLocation','IsLeasedVehicle');
        $columnVals = array($registrationNo,$model, $purchasedYear, $value,$fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation, $isLeasedVehicle);
        parent::setTableName('vehicle');
        parent::addRecord($columnNames,$columnVals);
    }

    protected function saveRecordToLeasedVehicle($registrationNo,$leasedCompany,$leasedPeriodFrom,$leasedPeriodTo,$monthlyPayment){
        $columnNames = array('RegistrationNo','LeasedCompany','LeasedPeriodFrom', 'LeasedPeriodTo','MonthlyPayment');
        $columnVals = array($registrationNo,$leasedCompany,$leasedPeriodFrom, $leasedPeriodTo,$monthlyPayment);
        parent::setTableName('leased_vehicle');
        parent::addRecord($columnNames,$columnVals);
    }

    protected function updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany){
        $columnNames = array('Model','PurchasedYear','Value','FuelType','InsuranceValue','InsuranceCompany');
        $columnVals = array($model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
        $conditionNames= array('RegistrationNo');
        $conditionVals= array($registrationNo);
        parent::setTableName('vehicle');
        parent::updateRecord($columnNames,$columnVals,$conditionNames,$conditionVals);  
    }

    protected function updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment){
        $columnNames = array('leasedCompany','leasedPeriodFrom','leasedPeriodTo','monthlyPayment');
        $columnVals = array($leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
        $conditionNames= array('RegistrationNo');
        $conditionVals= array($registrationNo);
        parent::setTableName('leased_vehicle');
        parent::updateRecord($columnNames,$columnVals,$conditionNames,$conditionVals);  
    }
}