<?php

namespace DB\Model;

abstract class EmployeeModel extends Model
{

    function __construct()
    {
        parent::__construct('employee');
    }

    /**
     * Get all employee records
     *
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getAllEmployees(int $offset, array $sort, array $search)
    {
        $conditions = ['IsDeleted' => 0];
        return $this->getAllRecords($conditions,$offset,$sort,$search);
        
    }

    /**
     * Get employees
     *
     * @param string $position
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getEmployeesByPosition(string $position, int $offset, array $sort, array $search)
    {
        $conditions = ['Position' => $position, 'IsDeleted' => 0];
        return $this->getAllRecords($conditions,$offset,$sort,$search);
    }

    /**
     * Get employee record
     *
     * @param $empID
     * @return mixed
     */
    protected function getRecordByID($empID)
    {
        $conditions = ['EmpID' => $empID, 'IsDeleted' => 0];
        $wantedFields = ['EmpID', 'FirstName', 'LastName', 'Position', 'Designation', 'Email',  'ProfilePicturePath'];
        $results = parent::getRecords($conditions, $wantedFields); 
        return $results[0];
    }

    /**
     * Get employee record
     *
     * @param $email
     * @return array
     */
    protected function getRecordByEmail($email)
    {
        $conditions = ['Email' => $email, 'IsDeleted' => 0];
        $wantedFields = array('EmpID', 'FirstName', 'LastName', 'Position', 'Designation', 'Email', 'ProfilePicturePath');
        return parent::getRecords($conditions, $wantedFields);
    }

    /**
     * Add new employee record
     *
     * @param $empID
     * @param $firstName
     * @param $lastName
     * @param $position
     * @param $designation
     * @param $email
     * @param $password
     */
    protected function saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $password, $profilePicturePath, $contactNumber)
    {
        $values = [
            'EmpID' => $empID,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Position' => $position,
            'Designation' => $designation,
            'Email' => $email,
            'Password' => $password,
            'ProfilePicturePath' => $profilePicturePath,
            'ContactNumber' => $contactNumber
        ];
        parent::addRecord($values);
    }

    /**
     * Verify password of an employee
     *
     * @param $empID
     * @param $password
     * @return bool
     */
    protected function checkPasswordByID($empID,$password)
    {
        $conditions = ['EmpID' => $empID, 'IsDeleted' => 0];
        $wantedFields = ['Password'];
        return password_verify($password,parent::getRecords($conditions, $wantedFields)[0]['Password']);
    }

    /**
     * Get emails
     *
     * @param string $position
     * @return array
     */
    protected function getEmails(string $position)
    {
        $conditions = ['Position' => $position, 'IsDeleted' => 0];
        $wantedFields = ['Email'];
        $emailRecords = parent::getRecords($conditions, $wantedFields);

        $emails = [];
        foreach ($emailRecords as $email)
            array_push($emails, $email['Email']);
        return $emails;
    }

    /**
     * Update employee record
     *
     * @param $newEmpID
     * @param $empID
     * @param $firstName
     * @param $lastName
     * @param $position
     * @param $designation
     * @param $email
     */
    protected function updateEmployeeInfo($newEmpID, $empID, $firstName, $lastName, $position, $designation, $email, $contactNumber)
    {
        $values = [
            'EmpID' => $newEmpID,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Position' => $position,
            'Designation' => $designation,
            'Email' => $email,
            'ContactNumber' => $contactNumber
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change employee password
     *
     * @param $empID
     * @param $newPassword
     */
    protected function updateEmployeePassword($empID, $newPassword)
    {
        $values = [
            'Password' => $newPassword
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change employee profile picture
     *
     * @param $empID
     * @param string $imagePath
     */
    protected function updateEmployeeProfilePicture($empID, string $imagePath)
    {
        $values = [
            'ProfilePicturePath' => $imagePath
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Delete employee record
     *
     * @param $empID
     */
    protected function deleteEmployee($empID)
    {
        $values = ['IsDeleted' => 1];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * get employees
     *
     * @param array $conditions
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     * @throws SQLQueryBuilder\SQLException
     */
    private function getAllRecords(array $conditions, int $offset, array $sort, array $search)
    {
        $query = $this->queryBuilder->select($this->tableName)
                                    ->where()
                                        ->conditions($conditions)
                                        ->like($this->tableName,key($search),$search[key($search)])
                                        ->getWhere()
                                    ->orderBy($sort)
                                    ->limit(5,$offset)
                                    ->getSQLQuery();
        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }
}
