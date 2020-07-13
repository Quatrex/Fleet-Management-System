<?php
namespace DB\Model;

abstract class EmployeeModel extends Model{
    
    function __construct()
    {
        parent::__construct('employee');
    }

    protected function getRecordByID($empID){
        $conditions = ['EmpID' => $empID, 'IsDeleted' => 0];
        $wantedFields = ['EmpID','FirstName','LastName','Position','Designation','Email','Username'];
        $results = parent::getRecords($conditions, $wantedFields); //change getRecords() to not get password from database
        return $results[0];
    }

    protected function getRecordByUsername($username){
        $conditions = ['Username' => $username, 'IsDeleted' => 0];
        $wantedFields = array('EmpID','FirstName','LastName','Position','Designation','Email','Username');
        return parent::getRecords($conditions,$wantedFields);
    }

    protected function saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $username, $password) {
        $values = ['EmpID' => $empID,
                'FirstName' => $firstName,
                'LastName' => $lastName,
                'Position' => $position,
                'Designation' => $designation,
                'Email' => $email,
                'Username' => $username,
                'Password' => $password];
        parent::addRecord($values);
    }

    protected function checkPassword($username,$password){
        $conditions = ['Username' => $username, 'IsDeleted' => 0];
        $wantedFields = ['Username','Password'];
        return (parent::getRecords($conditions,$wantedFields)[0]['Password']==$password)? true:false;
    }

    public function getAllRecords()
    {
        return parent::getRecords();
    }

    public function getEmployeesByPosition(string $position)
    {
        $conditions = ['Position' => $position];
        return parent::getRecords($conditions);
    }

    protected function getEmails(string $position)
    {
        $conditions = ['Position' => $position, 'IsDeleted' => 0];
        $wantedFields = ['Email'];
        $emailRecords = parent::getRecords($conditions,$wantedFields);

        $emails = [];
        foreach ($emailRecords as $email)
             array_push($emails,$email['Email']);
        return $emails;
    }
}