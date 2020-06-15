<?php
abstract class RequestModel extends Model{

    function __construct()
    {
        $this->tableName="request";
    }

    protected function getRecordByID($requestID){
        $columnNames= array('RequestID');
        $columnVals= array($requestID);
        $columnDataTypes= 'i';
        $results = parent::getRecords($this->tableName,$columnNames,$columnVals,$columnDataTypes);
        $values=array();
        $neededVals=array('RequestID','CreatedDate','State','DateOfTrip','TimeOfTrip','DropLocation','PickLocation','RequesterID','Purpose','JustifiedBy','ApprovedBy','JOComment','CAOComment');
        while($row = mysqli_fetch_array($results)) {
            foreach ($neededVals as $colVal){
                array_push($values,$row[$colVal]);
            }
        }
        return $values;
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