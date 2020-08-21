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

    protected function getRequestsByIDNState(String $requesterID, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['RequesterID' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    protected function getJustifiedRequestsByIDNState(String $requesterID, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['JustifiedBy' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    protected function getApprovedRequestsByIDNState(String $requesterID, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['ApprovedBy' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    public function getRequestsbyState(array $states, int $offset, array $sort, array $search)
    {
        $joinConditions = [['request' => 'RequesterID', 'employee' => 'EmpID']];
        $stateConditions = ['State' => $states];
        $query = $this->queryBuilder->select($this->tableName)
                                    ->join($this->tableName,$joinConditions)
                                    ->where()
                                        ->conditions($stateConditions,"OR")
                                        ->like($this->tableName,key($search),$search[key($search)])
                                        ->getWhere()
                                    ->orderBy($sort)
                                    ->limit(5,$offset)
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);
        return $result ? $result : [];
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
        $values = ['State' => $state, 'CAOComment' => $CAOComment, 'ApprovedBy' => $empID];
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

    protected function expireRequests(int $state , array $conditionStates) 
    {
        $nowDate = date('Y-m-d');
        $nowTime = date('h:i:s');
        $query = $this->queryBuilder->update($this->tableName,['State'=>$state])
                                    ->where()
                                        ->open()
                                        ->conditions(['State' => $conditionStates],"OR")
                                        ->close()
                                        ->open()
                                        ->conditions(['DateOfTrip'=>$nowDate],"AND","<")
                                        ->close()
                                        ->open("OR")
                                        ->open("")
                                        ->conditions(['DateOfTrip'=>$nowDate])
                                        ->close()
                                        ->open()
                                        ->conditions(['TimeOfTrip'=>$nowTime],"AND","<")
                                        ->close()
                                        ->close()
                                        ->getWhere()
                                    ->getSQLQuery();
    
        $this->dbh->write($query);  
    }

    protected function getRequestsByVehicle(string $registrationNo, int $state)
    {
        $conditions = ['Vehicle' => $registrationNo, 'State' => $state];
        $requests = parent::getRecords($conditions);
        return $requests;
    }

    protected function getRequestsByDriver(string $driverID, int $state)
    {
        $conditions = ['Driver' => $driverID, 'State' => $state];
        $requests = parent::getRecords($conditions);
        return $requests;
    }
}
