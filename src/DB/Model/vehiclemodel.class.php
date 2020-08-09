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
        $conditions = ['vehicle.RegistrationNo' => $registrationNo, 'IsDeleted' => 0];
        $results = $isLeased ? parent::getRecordsFromTwo($joinConditions, $conditions)
            : parent::getRecords($conditions);
        return $results[0];
    }

    protected function getAllRecords(int $offset)
    {
        $joinConditions = [['vehicle' => 'RegistrationNo', 'leased_vehicle' => 'RegistrationNo']];
        $conditions = ['IsDeleted' => 0];
        $wantedFields = ['vehicle.RegistrationNo', 'Model', 'PurchasedYear', 'Value', 'FuelType', 
                    'InsuranceValue','InsuranceCompany','AssignedOfficer','State','CurrentLocation',
                    'NumOfAllocations', 'IsLeased', 'leasedCompany', 'leasedPeriodFrom', 'leasedPeriodTo', 'monthlyPayment'];
        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->join($this->tableName,$joinConditions,"LEFT")
                                    ->where()
                                        ->conditions($conditions)
                                        ->getWhere()
                                    ->limit(10,$offset)
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);
        return $result ? $result : [];
    }

    protected function saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, $isLeased)
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
            'CurrentLocation' => $currentLocation,
            'NumOfAllocations' => $numOfAllocations,
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

    protected function updateVehicleRow($registrationNo, $newRegistrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer)
    {
        $values = [
            'RegistrationNo' => $newRegistrationNo,
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

    protected function updateNumOfAllocations(string $registrationNo, int $numOfAllocations)
    {
        $values = [
            'NumOfAllocations' => $numOfAllocations
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
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
