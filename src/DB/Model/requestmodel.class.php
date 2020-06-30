<?php
namespace DB\Model;
use Request\State\State;

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

    protected function getRequestsByIDNState(String $requesterID,int $state){
        $columnNames= array('RequesterID','State');
        $columnVals= array($requesterID,$state);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results;
    }

    protected function getJustifiedRequestsByIDNState(String $justifiedBy,int $state){
        $columnNames= array('JustifiedBy','State');
        $columnVals= array($justifiedBy,$state);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results;
    }

    protected function getApprovedRequestsByIDNState(String $approvedBy,int $state){
        $columnNames= array('ApprovedBy','State');
        $columnVals= array($approvedBy,$state);
        $results = parent::getRecords($columnNames,$columnVals);
        return $results;
    }

    //protected function getScheduledRequestsByIDNState(String $scheduledBy,int $state) //TODO: create columns in database

    protected function getPendingRequests(){
        $state=State::getStateID("pending");
        $results= $this->getRequestsbyState($state);
        return $results;
    }

    protected function getJustifiedRequests(){
        $state=State::getStateID("justified");
        $results= $this->getRequestsbyState($state);
        return $results;
    }

    protected function getApprovedRequests(){
        $state=State::getStateID("approved");
        $results= $this->getRequestsbyState($state);
        return $results;
    }

    private function getRequestsbyState($state) {
        $columnNames = array('State');
        $columnVals = array($state);
        $results=parent::getRecords($columnNames,$columnVals);
        return $results;
    }

    protected function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        $columnNames = array('CreatedDate','State','DateOfTrip','TimeOfTrip','DropLocation','PickLocation','RequesterID','Purpose');
        $columnVals = array($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
        parent::addRecord($columnNames,$columnVals);
    }

    protected function justifyRequest($requestID,$JOComment,$empID){
        $state=State::getState("justified");
        $columnNames=array("State","JOComment","JustifiedBy");
        $columnVals=array($state,$JOComment,$empID);
        $conditionNames=array("RequestID");
        $conditionVals=array($requestID);
        parent::updateRecord($columnNames, $columnVals,$conditionNames,$conditionVals);
    }

    protected function approveRequest($requestID,$CAOComment,$empID){
        $state=State::getState("approved");
        $columnNames=array("State","CAOComment","ApprovedBy");
        $columnVals=array($state,$CAOComment,$empID);
        $conditionNames=array("RequestID");
        $conditionVals=array($requestID);
        parent::updateRecord($columnNames, $columnVals,$conditionNames,$conditionVals);
    }

    protected function denyRequest($requestID,$Comment,$empID,$position){
        $state=State::getState("denied");
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

    
}