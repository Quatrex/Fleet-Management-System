<?php
namespace DB\Model;

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

    protected function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        $columnNames = array('CreatedDate','State','DateOfTrip','TimeOfTrip','DropLocation','PickLocation','RequesterID','Purpose');
        $columnVals = array($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
        parent::addRecord($columnNames,$columnVals);
    }

    protected function getRequestsOfAState($state) {
        $columnNames = array('State');
        $columnVals = array($state);
        $results=parent::getRecords($columnNames,$columnVals);
        return $results;
    }
}