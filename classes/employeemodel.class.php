<?php
abstract class EmployeeModel extends Model{
    
    function __construct()
    {
        $this->tableName="employee";
    }

    protected function getRecordByID($empID){
        $columnNames= array('empID');
        $columnVals= array($empID);
        $columnDataTypes= 'i';
        return parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
    }
}