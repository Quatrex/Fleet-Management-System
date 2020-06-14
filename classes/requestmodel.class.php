<?php
abstract class RequestModel extends Model{

    function __construct()
    {
        $this->tableName="request";
    }

    protected function getPendingRequestsByID($requesterID){
        $state=1; //implement an enum to get the state value

        $columnNames= array('RequesterID','State');
        $columnVals= array($requesterID,$state);
        $columnDataTypes= 'ii';
        $results = parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
        $values=array();
        $neededVals=array('RequestID');
        while($row = mysqli_fetch_array($results)) {
            foreach ($neededVals as $colVal){
                array_push($values,$row[$colVal]);
            }
        }
        return $values;
    }
}