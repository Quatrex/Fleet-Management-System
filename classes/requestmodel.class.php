<?php
abstract class RequestModel extends Model{

    function __construct()
    {
        parent::__construct('request');
    }

    protected function getRecordByID($requestID){
        $columnNames= array('RequestID');
        $columnVals= array($requestID);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results[0];
    }

    protected function getPendingRequestsByID($requesterID){
        $state=1; //implement an enum to get the state value
        $columnNames= array('RequesterID','State');
        $columnVals= array($requesterID,$state);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results;
    }
}