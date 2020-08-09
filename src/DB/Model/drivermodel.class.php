<?php

namespace DB\Model;

abstract class DriverModel extends Model
{
    function __construct()
    {
        parent::__construct('driver');
    }

    protected function getRecordByID($driverId)
    {
        $conditions = ['DriverID' => $driverId, 'IsDeleted' => 0];
        $results = parent::getRecords($conditions);
        return $results[0];
    }

    protected function getAllRecords(int $offset, array $sort, array $search)
    {
        $conditions = ['IsDeleted' => 0];
        $query = $this->queryBuilder->select($this->tableName)
                                    ->where()
                                        ->conditions($conditions)
                                        ->like($this->tableName,key($search),$search[key($search)])
                                        ->getWhere()
                                    ->limit(10,$offset)
                                    ->getSQLQuery();
        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }

    //updateRecord
    // protected function updateRecord($driverId,$fields){
    //     $columnNames = array_keys($fields);
    //     $columnNames= array_unshift($columnNames,'DriverID');
    //     $columnVals= array_unshift($driverId,array_values($fields));
    //     parent::updateRecord($columnNames,$columnVals);

    // }
    //should contain a state of the driver
    protected function updateNumOfAllocations(string $driverId, int $numOfAllocations)
    {
        $values = [
            'NumOfAllocations' => $numOfAllocations
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    protected function updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicle, $email)
    {
        $values = [
            'DriverID' => $newDriverId,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'LicenseNumber' => $licenseNumber,
            'LicenseType' => $licenseType,
            'LicenseExpirationDay' => $licenseExpirationDay,
            'DateOfAdmission' => $dateOfAdmission,
            'AssignedVehicle' => $assignedVehicle,
            'Email' => $email
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    protected function updateAssignedVehicle($driverId,$assignedVehicle)
    {
        $values = [
            'AssignedVehicle' => $assignedVehicle
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    protected function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicle, $email, $state, $numOfAllocations)
    {
        $values = [
            'DriverID' => $driverId,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'LicenseNumber' => $licenseNumber,
            'LicenseType' => $licenseType,
            'LicenseExpirationDay' => $licenseExpirationDay,
            'DateOfAdmission' => $dateOfAdmission,
            'AssignedVehicle' => $assignedVehicle,
            'Email' => $email,
            'State' => $state,
            'NumOfAllocations' => $numOfAllocations
        ];
        parent::addRecord($values);
    }

    protected function deleteDriver($driverID){
        $values = ['IsDeleted' => 1];
        $conditions = ['DriverID' => $driverID];
        parent::updateRecord($values,$conditions);  
    }
}
