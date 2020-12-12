<?php

namespace DB\Model;

abstract class EmployeeModel extends Model
{

    function __construct()
    {
        parent::__construct('employee');
    }

    protected function getAllEmployees(int $offset, array $sort, array $search)
    {
        $conditions = ['IsDeleted' => 0];
        return $this->getAllRecords($conditions,$offset,$sort,$search);
        
    }

    protected function getEmployeesByPosition(string $position, int $offset, array $sort, array $search)
    {
        $conditions = ['Position' => $position, 'IsDeleted' => 0];
        return $this->getAllRecords($conditions,$offset,$sort,$search);
    }

    protected function getRecordByID($empID)
    {
        $conditions = ['EmpID' => $empID, 'IsDeleted' => 0];
        $wantedFields = ['EmpID', 'FirstName', 'LastName', 'Position', 'Designation', 'Email',  'ProfilePicturePath'];
        $results = parent::getRecords($conditions, $wantedFields); 
        return $results[0];
    }

    protected function getRecordByEmail($email)
    {
        $conditions = ['Email' => $email, 'IsDeleted' => 0];
        $wantedFields = array('EmpID', 'FirstName', 'LastName', 'Position', 'Designation', 'Email', 'ProfilePicturePath');
        return parent::getRecords($conditions, $wantedFields);
    }

    protected function saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $password)
    {
        $values = [
            'EmpID' => $empID,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Position' => $position,
            'Designation' => $designation,
            'Email' => $email,
            'Password' => $password,
            'ProfilePicturePath' => null
        ];
        parent::addRecord($values);
    }

    protected function checkPasswordByID($empID,$password)
    {
        $conditions = ['EmpID' => $empID, 'IsDeleted' => 0];
        $wantedFields = ['Password'];
        return password_verify($password,parent::getRecords($conditions, $wantedFields)[0]['Password']);
    }

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

    protected function updateEmployeeInfo($newEmpID, $empID, $firstName, $lastName, $position, $designation, $email)
    {
        $values = [
            'EmpID' => $newEmpID,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Position' => $position,
            'Designation' => $designation,
            'Email' => $email
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    protected function updateEmployeePassword($empID, $newPassword)
    {
        $values = [
            'Password' => $newPassword
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    protected function updateEmployeeProfilePicture($empID, string $imagePath)
    {
        $values = [
            'ProfilePicturePath' => $imagePath
        ];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

    protected function deleteEmployee($empID)
    {
        $values = ['IsDeleted' => 1];
        $conditions = ['EmpID' => $empID];
        parent::updateRecord($values, $conditions);
    }

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
