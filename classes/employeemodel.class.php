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
        $values=array();
        $neededVals=array('EmpID','FirstName','LastName','Position','Email','Username','Password');
        while($row = mysqli_fetch_array($results)) {
            foreach ($neededVals as $colVal){
                array_push($values,$row[$colVal]);
            }
        }
        return $values;
    }
    protected function getRecordByUsername($username){
        $columnNames= array('Username');
        $columnVals= array($username);
        $columnDataTypes= 's';
        return parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
    }
}