<?php
abstract class RequestModel extends Model{

    function __construct()
    {
        parent::__construct('request');
    }

    protected function getRecordByID($requestID){
        $columnNames= array('RequestID');
        $columnVals= array($requestID);
        $columnDataTypes= 'i';
        $results = parent::getRecords($columnNames,$columnVals);
        /*
        $values=array();
        $neededVals=array('RequestID','CreatedDate','State','DateOfTrip','TimeOfTrip','DropLocation','PickLocation','RequesterID','Purpose','JustifiedBy','ApprovedBy','JOComment','CAOComment');
        while($row = mysqli_fetch_array($results)) {
            foreach ($neededVals as $colVal){
                array_push($values,$row[$colVal]);
            }
        }
        return $values;
        */
        return $results[0];
    }

    protected function getPendingRequestsByID($requesterID){
        $state=1; //implement an enum to get the state value

        $columnNames= array('RequesterID','State');
        $columnVals= array($requesterID,$state);
        $columnDataTypes= 'ii';
        $results = parent::getRecords($columnNames,$columnVals);
        /*
        $values=array();
        $neededVals=array('RequestID');
        while($row = mysqli_fetch_array($results)) {
            foreach ($neededVals as $colVal){
                array_push($values,$row[$colVal]);
            }
        }
        return $values;
        */
        return $results;
    }
}