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

    // protected function getPendingRequestsByID($requesterID){
    //     $state=1; //implement an enum to get the state value
    //     $columnNames= array('RequesterID','State');
    //     $columnVals= array($requesterID,$state);
    //     $results = parent::getRecords($columnNames,$columnVals);
    //     return $results;
    // }
    protected function getRequestsByIDNState(String $requesterID,int $state){
        $columnNames= array('RequesterID','State');
        $columnVals= array($requesterID,$state);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results;
    }

    protected function getRequestsByJOIDNState(String $justifiedBy,int $state){
        return "not implemented"; //TODO: implement
    }

    protected function getRequestsByCAOIDNState(String $approvedBy,int $state){
        return "not implemented"; //TODO: implement
    }

    protected function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        $columnNames = array('CreatedDate','State','DateOfTrip','TimeOfTrip','DropLocation','PickLocation','RequesterID','Purpose');
        $columnVals = array($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
        parent::addRecord($columnNames,$columnVals);
    }

    protected function getPendingRequests(){
        $state=1;
        $results= $this->getRequestsbyState($state);
        return $results;
    }

    protected function getJustifiedRequests(){
        $state=2;
        $results= $this->getRequestsbyState($state);
        return $results;
    }

    protected function justifyRequest($requestID,$JOComment,$empID){
        $state=2;
        $columnNames=array("State","JOComment","JustifiedBy");
        $columnVals=array($state,$JOComment,$empID);
        $conditionNames=array("RequestID");
        $conditionVals=array($requestID);
        parent::updateRecord($columnNames, $columnVals,$conditionNames,$conditionVals);
    }

    protected function approveRequest($requestID,$CAOComment,$empID){
        $state=3;
        $columnNames=array("State","CAOComment","ApprovedBy");
        $columnVals=array($state,$CAOComment,$empID);
        $conditionNames=array("RequestID");
        $conditionVals=array($requestID);
        parent::updateRecord($columnNames, $columnVals,$conditionNames,$conditionVals);
    }

    protected function denyRequest($requestID,$Comment,$empID,$position){
        $state=4;
        switch ($position) {
            case "JO"://TODO: must be the same name as in employee table
                $columnNames=array("State","JOComment","JustifiedBy");;
                break;
            case "CAO"://TODO: must be the same name as in employee table
                $columnNames=array("State","CAOComment","ApprovedBy");;
                break;
        }

        $columnVals=array($state,$Comment,$empID);
        $conditionNames=array("RequestID");
        $conditionVals=array($requestID);
        parent::updateRecord($columnNames, $columnVals,$conditionNames,$conditionVals);
    }

    private function getRequestsbyState($state) {
        $columnNames = array('State');
        $columnVals = array($state);
        $results=parent::getRecords($columnNames,$columnVals);
        return $results;
    }
}