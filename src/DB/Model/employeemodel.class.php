<?php
namespace DB\Model;

abstract class EmployeeModel extends Model{
    
    function __construct()
    {
        parent::__construct('employee');
    }

    protected function getRecordByID($empID){
        $columnNames= array('EmpID');
        $columnVals= array($empID);
        $results = parent::getRecords($columnNames,$columnVals); //change getRecords() to not get password from database
        return $results[0];
    }

    protected function getRecordByUsername($username){
        $columnNames= array('Username');
        $columnVals= array($username);
        return parent::getRecords($columnNames,$columnVals);
    }

    protected function saveRecord($empID, $firstName, $lastName, $position, $email, $username, $password) {
        $columnNames = array('EmpID','FirstName','LastName','Position','Email','Username','Password');
        $columnVals = array($empID, $firstName, $lastName, $position, $email, $username, $password);
        parent::addRecord($columnNames,$columnVals);
    }
}