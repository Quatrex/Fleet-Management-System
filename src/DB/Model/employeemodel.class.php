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
        $results = parent::getRecords($columnNames,$columnVals);
        return $results[0];
    }

    protected function getRecordByUsername($username){
        $columnNames= array('Username');
        $columnVals= array($username);
        return parent::getRecords($columnNames,$columnVals);
    }
}