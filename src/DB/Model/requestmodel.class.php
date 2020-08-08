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
        $conditions = ['RequestID' => $requestID];
        $results = parent::getRecords($conditions);
        return $results[0];
    }

    protected function getRequestsByIDNState(String $requesterID, array $states, int $offset)
    {
        $conditions = ['RequesterID' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset);
    }

    protected function getJustifiedRequestsByIDNState(String $requesterID, array $states, int $offset)
    {
        $conditions = ['JustifiedBy' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset);
    }

    protected function getApprovedRequestsByIDNState(String $requesterID, array $states, int $offset)
    {
        $conditions = ['ApprovedBy' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset);
    }

    public function getRequestsbyState(string $state)
    {
        $joinConditions = [['request' => 'RequesterID', 'employee' => 'EmpID']];
        $conditions = ['State' => $state];
        $results = parent::getRecordsFromTwo($joinConditions, $conditions);
        return $results;
    }

    protected function saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose)
    {
        $values = ['CreatedDate' => $createdDate,
                'State' => $state,
                'DateOfTrip' => $dateOfTrip,
                'TimeOfTrip' => $timeOfTrip,
                'DropLocation' => $dropLocation,
                'PickLocation' => $pickLocation,
                'RequesterID' => $requesterID,
                'Purpose' => $purpose];
        parent::addRecord($values);
    }

    protected function updateState($requestID, $state)
    {
        $values = ['State' => $state];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    protected function justifyRequest($requestID, $JOComment, $empID, $state)
    {
        $values = ['State' => $state, 'JOComment' => $JOComment, 'JustifiedBy' => $empID];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    protected function approveRequest($requestID, $CAOComment, $empID, $state)
    {
        $values = ['State' => $state, 'JOComment' => $CAOComment, 'JustifiedBy' => $empID];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    protected function scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $state)
    {
        $values = ['State' => $state, 'ScheduledBy' => $scehduledBy, 'Driver' => $driver, 'Vehicle' => $vehicle];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    protected function closeRequest($requestID, $state)
    {
        $values = ['State' => $state];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    protected function getLastRequestID(string $empID)
    {
        $query = $this->queryBuilder->select($this->tableName, ['RequestID'])
                                    ->where()
                                        ->conditions(['RequesterID' => $empID])
                                        ->getWhere()
                                    ->orderBy(['RequestID' => 'DESC'])
                                    ->limit(1)
                                    ->getSQLQuery();
        $result = $this->dbh->read($query);
        return $result[0]['RequestID'];
    }
}
