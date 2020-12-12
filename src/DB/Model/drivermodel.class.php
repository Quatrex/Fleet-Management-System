<?php

namespace DB\Model;

abstract class DriverModel extends Model
{
    function __construct()
    {
        parent::__construct('driver');
    }

    /**
     * Get driver record
     *
     * @param $driverId
     * @return mixed
     */
    protected function getRecordByID($driverId)
    {
        $conditions = ['DriverID' => $driverId, 'IsDeleted' => 0];
        $results = parent::getRecords($conditions);
        return $results[0];
    }

    /**
     * get all driver records
     *
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     * @throws SQLQueryBuilder\SQLException
     */
    protected function getAllRecords(int $offset, array $sort, array $search)
    {
        $conditions = ['IsDeleted' => 0];
        $query = $this->queryBuilder->select($this->tableName)
            ->where()
            ->conditions($conditions)
            ->like($this->tableName, key($search), $search[key($search)])
            ->getWhere()
            ->limit(5, $offset)
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
    /**
     * Update NumOfAllocations,State of driver
     *
     * @param string $driverId
     * @param int $numOfAllocations
     * @param int $stateID
     */
    protected function updateNumOfAllocations(string $driverId, int $numOfAllocations, int $stateID)
    {
        $values = [
            'NumOfAllocations' => $numOfAllocations,
            'State' => $stateID
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Update driver information
     *
     * @param $driverId
     * @param $newDriverId
     * @param $firstName
     * @param $lastName
     * @param $licenseNumber
     * @param $licenseType
     * @param $licenseExpirationDay
     * @param $dateOfAdmission
     * @param $email
     */
    protected function updateDriverInfo($driverId, $newDriverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $email)
    {
        $values = [
            'DriverID' => $newDriverId,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'LicenseNumber' => $licenseNumber,
            'LicenseType' => $licenseType,
            'LicenseExpirationDay' => $licenseExpirationDay,
            'DateOfAdmission' => $dateOfAdmission,
            'Email' => $email
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Update driver's profile picture
     *
     * @param $driverId
     * @param $imagePath
     */
    protected function updateDriverPicture($driverId, $imagePath)
    {
        $values = [
            'ProfilePicturePath' => $imagePath
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Assign driver to a vehicle
     *
     * @param $driverId
     * @param $assignedVehicle
     */
    protected function updateAssignedVehicle($driverId, $assignedVehicle)
    {
        $values = [
            'AssignedVehicle' => $assignedVehicle
        ];
        $conditions = ['DriverID' => $driverId];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Add new driver record
     *
     * @param $driverId
     * @param $firstName
     * @param $lastName
     * @param $licenseNumber
     * @param $licenseType
     * @param $licenseExpirationDay
     * @param $dateOfAdmission
     * @param $assignedVehicle
     * @param $email
     * @param $state
     * @param $numOfAllocations
     */
    protected function saveRecord($driverId, $firstName, $lastName, $licenseNumber, $licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicle, $email, $state, $numOfAllocations, $profilePicturePath)
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
            'NumOfAllocations' => $numOfAllocations,
            'ProfilePicturePath' => $profilePicturePath
        ];
        parent::addRecord($values);
    }

    /**
     * Delete driver record
     * @param $driverID
     */
    protected function deleteDriver($driverID)
    {
        $values = ['IsDeleted' => 1];
        $conditions = ['DriverID' => $driverID];
        parent::updateRecord($values, $conditions);
    }
}
