<?php

namespace DB\Model;

use Request\State\State;

abstract class RequestModel extends Model
{

    function __construct()
    {
        parent::__construct('request');
    }

    protected function getRecordByID($requestID)
    {
        $columnNames = array('RequestID');
        $columnVals = array($requestID);
        $results = parent::getRecords($columnNames, $columnVals);
        return $results[0];
    }

    protected function getRequestsByIDNState(String $requesterID, int $state)
    {
        $columnNames = array('RequesterID', 'State');
        $columnVals = array($requesterID, $state);
        $results = parent::getRecords($columnNames, $columnVals);
        return $results;
    }

    protected function getJustifiedRequestsByIDNState(String $justifiedBy, int $state)
    {
        $columnNames = array('JustifiedBy', 'State');
        $columnVals = array($justifiedBy, $state);
        $results = parent::getRecords($columnNames, $columnVals);
        return $results;
    }

    protected function getApprovedRequestsByIDNState(String $approvedBy, int $state)
    {
        $columnNames = array('ApprovedBy', 'State');
        $columnVals = array($approvedBy, $state);
        $results = parent::getRecords($columnNames, $columnVals);
        return $results;
    }

    //protected function getScheduledRequestsByIDNState(String $scheduledBy,int $state) //TODO: create columns in database

    public function getRequestsbyState(string $state)
    {
        $secondTable = 'employee';
        $conditionCols = [['RequesterID', 'EmpID']];
        $whereColumnNamesAndValues = ['State' => $state];
        $results = parent::getRecordsFromTwo($secondTable, $conditionCols, $whereColumnNamesAndValues);
        return $results;
    }

    protected function saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose)
    {
        $columnNames = array('CreatedDate', 'State', 'DateOfTrip', 'TimeOfTrip', 'DropLocation', 'PickLocation', 'RequesterID', 'Purpose');
        $columnVals = array($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose);
        parent::addRecord($columnNames, $columnVals);
    }

    protected function updateState($requestID, $state)
    {
        $columnNames = array("State");
        $columnVals = array($state);
        $conditionNames = array("RequestID");
        $conditionVals = array($requestID);
        parent::updateRecord($columnNames, $columnVals, $conditionNames, $conditionVals);
    }

    protected function justifyRequest($requestID, $JOComment, $empID, $state)
    {
        $columnNames = array("State", "JOComment", "JustifiedBy");
        $columnVals = array($state, $JOComment, $empID);
        $conditionNames = array("RequestID");
        $conditionVals = array($requestID);
        parent::updateRecord($columnNames, $columnVals, $conditionNames, $conditionVals);
    }

    protected function approveRequest($requestID, $CAOComment, $empID, $state)
    {
        $columnNames = array("State", "CAOComment", "ApprovedBy");
        $columnVals = array($state, $CAOComment, $empID);
        $conditionNames = array("RequestID");
        $conditionVals = array($requestID);
        parent::updateRecord($columnNames, $columnVals, $conditionNames, $conditionVals);
    }

    public function getEmail(int $requestID, string $position)
    {
        $wantedCols = array('Email');
        $whereCols = ['RequestID' => $requestID];
        switch ($position) {
            case 'requester':
                $conditionCols = [['RequesterID', 'EmpID']];
                break;

            case 'jo':
                $conditionCols = [['JustifiedBy', 'EmpID']];
                break;

            case 'cao':
                $conditionCols = [['ApprovedBy', 'EmpID']];
                break;

            case 'vpmo':
                $conditionCols = [['ScheduledBy', 'EmpID']];
                break;
        }
        $emailRecord = parent::getRecordsFromTwo('employee', $conditionCols, $whereCols, $wantedCols);
        return $emailRecord[0]['Email'];
    }
}
