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

    /**
     * Get vehicle record
     *
     * @param $registrationNo
     * @param $isLeased
     * @return mixed
     */
    protected function getRecordByID($registrationNo, $isLeased)
    {
        $joinConditions = [['vehicle' => 'RegistrationNo', 'leased_vehicle' => 'RegistrationNo']];
        $conditions = ['vehicle.RegistrationNo' => $registrationNo, 'IsDeleted' => 0];
        $results = $isLeased ? parent::getRecordsFromTwo($joinConditions, $conditions)
            : parent::getRecords($conditions);
        return $results[0];
    }

    /**
     * Get all vehicle records
     *
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @param array $states
     * @return array
     * @throws SQLQueryBuilder\SQLException
     */
    protected function getAllRecords(int $offset, array $sort, array $search, array $states)
    {
        $joinConditions = [['vehicle' => 'RegistrationNo', 'leased_vehicle' => 'RegistrationNo']];
        $conditions =  empty($states) ? ['IsDeleted' => 0] : ['IsDeleted' => 0, 'State' => $states];
        $wantedFields = [
            'vehicle.RegistrationNo', 'Model', 'PurchasedYear', 'Value', 'FuelType',
            'InsuranceValue', 'InsuranceCompany', 'AssignedOfficer', 'State',
            'CurrentLocation', 'NumOfAllocations', 'IsLeased', 'LeasedCompany', 'LeasedPeriodFrom',
            'LeasedPeriodTo', 'MonthlyPayment', 'VehiclePicturePath'
        ];
        if($search[key($search)][0]=='RegistrationNo')
            $search[key($search)] = ['vehicle.RegistrationNo'];

        $query = $this->queryBuilder->select($this->tableName, $wantedFields)
            ->join($this->tableName, $joinConditions, "LEFT")
            ->where()
            ->conditions($conditions)
            ->like($this->tableName, key($search), $search[key($search)])
            ->getWhere()
            ->orderBy($sort)
            ->limit(5, $offset)
            ->getSQLQuery();

        $result = $this->dbh->read($query);
        return $result ? $result : [];
    }

    /**
     * Add new vehicle record
     *
     * @param $registrationNo
     * @param $model
     * @param $purchasedYear
     * @param $value
     * @param $fuelType
     * @param $insuranceValue
     * @param $insuranceCompany
     * @param $assignedOfficer
     * @param $state
     * @param $currentLocation
     * @param $numOfAllocations
     * @param $isLeased
     */
    protected function saveRecordToVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $assignedOfficer, $state, $currentLocation, $numOfAllocations, $isLeased, $vehiclePicturePath)
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
            'IsLeased' => $isLeased,
            'VehiclePicturePath' => $vehiclePicturePath
        ];
        parent::addRecord($values);
    }

    /**
     * Add leased vehicle specific information of a new vehicle
     *
     * @param $registrationNo
     * @param $leasedCompany
     * @param $leasedPeriodFrom
     * @param $leasedPeriodTo
     * @param $monthlyPayment
     */
    protected function saveRecordToLeasedVehicle($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::setTableName('leased_vehicle');
        $values = [
            'RegistrationNo' => $registrationNo,
            'LeasedCompany' => $leasedCompany,
            'LeasedPeriodFrom' => $leasedPeriodFrom,
            'LeasedPeriodTo' => $leasedPeriodTo,
            'MonthlyPayment' => $monthlyPayment
        ];
        parent::addRecord($values);
        parent::setTableName('vehicle');
    }

    /**
     * Change vehicle information
     *
     * @param $registrationNo
     * @param $newRegistrationNo
     * @param $model
     * @param $purchasedYear
     * @param $value
     * @param $fuelType
     * @param $insuranceValue
     * @param $insuranceCompany
     * @param $assignedOfficer
     */
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

    /**
     * Assign a vehicle to an officer
     *
     * @param $registrationNo
     * @param $assignedOfficer
     */
    protected function updateAssignedOfficer($registrationNo, $assignedOfficer)
    {
        $values = [
            'AssignedOfficer' => $assignedOfficer
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change vehicle's picture
     *
     * @param string $registrationNo
     * @param string $imagePath
     */
    protected function updateVehiclePicture(string $registrationNo, string $imagePath)
    {
        $values = [
            'VehiclePicturePath' => $imagePath
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change leased vehicle specific information of a vehicle
     *
     * @param $registrationNo
     * @param $leasedCompany
     * @param $leasedPeriodFrom
     * @param $leasedPeriodTo
     * @param $monthlyPayment
     */
    protected function updateLeasedVehicleRow($registrationNo, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::setTableName('leased_vehicle');
        $values = [
            'LeasedCompany' => $leasedCompany,
            'LeasedPeriodFrom' => $leasedPeriodFrom,
            'LeasedPeriodTo' => $leasedPeriodTo,
            'MonthlyPayment' => $monthlyPayment
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
        parent::setTableName('vehicle');
    }

    /**
     * Update NumOfAllocations,State of vehicle
     *
     * @param string $registrationNo
     * @param int $numOfAllocations
     * @param int $stateID
     */
    protected function updateNumOfAllocations(string $registrationNo, int $numOfAllocations, int $stateID)
    {
        $values = [
            'NumOfAllocations' => $numOfAllocations,
            'State' => $stateID
        ];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Delete vehicle record
     *
     * @param $registrationNo
     */
    protected function deleteVehicle($registrationNo)
    {
        $values = ['IsDeleted' => 1];
        $conditions = ['RegistrationNo' => $registrationNo];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Check whether a vehicle is a leased vehicle or not
     *
     * @param $registrationNo
     * @return bool
     */
    protected function isLeasedVehicle($registrationNo): bool
    {
        $conditions = ['RegistrationNo' => $registrationNo, 'IsDeleted' => 0];
        $wantedFields = ['IsLeased'];
        $record  = parent::getRecords($conditions, $wantedFields);
        return ($record[0]['IsLeased']) ? true : false;
    }
}
