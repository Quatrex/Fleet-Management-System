<?php

namespace DB\Model;

abstract class VehicleModel extends Model
{
    //+ saveRecord(VehicleInfo)
    //+updateRecord(VehicleInfo)
    function __construct()
    {
        parent::__construct('vehicle');
    }

    protected function getRecordByID($registrationNo, $isLeased)
    {;
        $joinConditions = [['vehicle' => 'RegistrationNo', 'leased_vehicle' => 'RegistrationNo']];
        $conditions = ['RegistrationNo' => $registrationNo, 'IsDeleted' => 0];
        $results = $isLeased ? parent::getRecordsFromTwo($joinConditions, $conditions)
            : parent::getRecords($conditions);
        return $results[0];
    }

    protected function getAllRecords(string $vehicleType)
    {
        switch ($vehicleType) {
            case 'leased':
                $joinConditions = [['vehicle' => 'RegistrationNo', 'leased_vehicle' => 'RegistrationNo']];
                $conditions = ['IsDeleted' => 0];
                $results = parent::getRecordsFromTwo($joinConditions, $conditions);
                break;
            case 'purchased':
                $conditions = ['IsLeased' => 0, 'IsDeleted' => 0];
                $results = parent::getRecords($conditions);
                break;
        }
        return $results;
    }

    protected function saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $isLeased)
    {
        $values = [
            'RegistrationNo' => $registrationNo,
            'Model' => $model,
            'PurchasedYear' => $purchasedYear,
            'Value' => $value,
            'FuelType' => $fuelType,
            'InsuranceValue' => $insuranceValue,
            'InsuranceCompany' => $insuranceCompany,
            'AssignedOfficer' => $assignedOfficer,
            'State' => $state,
            'IsLeased' => $isLeased
        ];
        parent::addRecord($values);
    }

    protected function saveRecordToLeasedVehicle($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::setTableName('leased_vehicle');
        $values = [
            'RegistrationNo' => $registrationNo,
            'leasedCompany' => $leasedCompany,
            'leasedPeriodFrom' => $leasedPeriodFrom,
            'leasedPeriodTo' => $leasedPeriodTo,
            'monthlyPayment' => $monthlyPayment
        ];
        parent::addRecord($values);
        parent::setTableName('vehicle');
    }

    protected function updateVehicleRow($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer)
    {
        $values = [
            'Model' => $model,
            'PurchasedYear' => $purchasedYear,
            'Value' => $value,
            'FuelType' => $fuelType,
            'InsuranceValue' => $insuranceValue,
            'InsuranceCompany' => $insuranceCompany,
            'AssignedOfficer' => $assignedOfficer
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    protected function updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::setTableName('leased_vehicle');
        $values = [
            'leasedCompany' => $leasedCompany,
            'leasedPeriodFrom' => $leasedPeriodFrom,
            'leasedPeriodTo' => $leasedPeriodTo,
            'monthlyPayment' => $monthlyPayment
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
        parent::setTableName('vehicle');
    }

    protected function deleteVehicle($registrationNo)
    {
        $values = ['IsDeleted' => 1];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    protected function isLeasedVehicle($registrationNo): bool
    {
        $conditions = ['RegistrationNo' => $registrationNo, 'IsDeleted' => 0];
        $wantedFields = ['IsLeased'];
        $record  = parent::getRecords($conditions, $wantedFields);
        return ($record[0]['IsLeased']) ? true : false;
    }
}
