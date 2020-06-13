<?php
abstract class EmployeeModel extends Model{
    
    function __construct()
    {
        $this->tableName="employee";
    }

    protected function getRecordByID($empID){
        $columnNames= array('EmpID');
        $columnVals= array($empID);
        $columnDataTypes= 's';
        $results = parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
        //echo gettype($results);
        $values=array('1','1','1','1','1','1','1'); // convert the record into an array of values (test)
        return $values;
    }
    protected function getRecordByUsername($username){
        $columnNames= array('Username');
        $columnVals= array($username);
        $columnDataTypes= 's';
        return parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
    }
}