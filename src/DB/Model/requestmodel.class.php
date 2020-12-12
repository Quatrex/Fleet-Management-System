<?php

namespace DB\Model;

use Request\State\State;

abstract class RequestModel extends Model
{

    function __construct()
    {
        parent::__construct('request');
    }

    /**
     * Get request record
     *
     * @param $requestID
     * @return mixed
     */
    protected function getRecordByID($requestID)
    {
        $conditions = ['RequestID' => $requestID];
        $results = parent::getRecords($conditions);
        return $results[0];
    }

    /**
     * Get Request record
     *
     * @param String $requesterID
     * @param array $states
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getRequestsByIDNState(String $requesterID, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['RequesterID' => $requesterID];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    /**
     * Get justified Request records
     *
     * @param String $justifiedBy
     * @param array $states
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getJustifiedRequestsByIDNState(String $justifiedBy, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['JustifiedBy' => $justifiedBy];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    /**
     * Get approved request records
     *
     * @param String $approvedBy
     * @param array $states
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getApprovedRequestsByIDNState(String $approvedBy, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['ApprovedBy' => $approvedBy];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    /**
     * Get scheduled request records
     *
     * @param String $scheduledBy
     * @param array $states
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     */
    protected function getScheduledRequestsByIDNState(String $scheduledBy, array $states, int $offset, array $sort, array $search)
    {
        $conditions = ['ScheduledBy' => $scheduledBy];
        $stateConditions = ['State' => $states];
        return parent::getRecordsFromMultipleStates($conditions,$stateConditions,$offset,$sort,key($search),$search[key($search)]);
    }

    /**
     * Get request records
     *
     * @param array $states
     * @param int $offset
     * @param array $sort
     * @param array $search
     * @return array
     * @throws SQLQueryBuilder\SQLException
     */
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

    /**
     * Add new request record
     *
     * @param $createdDate
     * @param $state
     * @param $dateOfTrip
     * @param $timeOfTrip
     * @param $dropLocation
     * @param $pickLocation
     * @param $requesterID
     * @param $purpose
     */
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

    /**
     * Change request's state
     *
     * @param $requestID
     * @param $state
     */
    protected function updateState($requestID, $state)
    {
        $values = ['State' => $state];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change request's state to justified
     *
     * @param $requestID
     * @param $JOComment
     * @param $empID
     * @param $state
     */
    protected function justifyRequest($requestID, $JOComment, $empID, $state)
    {
        $values = ['State' => $state, 'JOComment' => $JOComment, 'JustifiedBy' => $empID];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change request's state to approved
     *
     * @param $requestID
     * @param $CAOComment
     * @param $empID
     * @param $state
     */
    protected function approveRequest($requestID, $CAOComment, $empID, $state)
    {
        $values = ['State' => $state, 'CAOComment' => $CAOComment, 'ApprovedBy' => $empID];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change request's state to scheduled
     *
     * @param $requestID
     * @param $scehduledBy
     * @param $driver
     * @param $vehicle
     * @param $state
     */
    protected function scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $state)
    {
        $values = ['State' => $state, 'ScheduledBy' => $scehduledBy, 'Driver' => $driver, 'Vehicle' => $vehicle];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Change request's state to completed
     *
     * @param $requestID
     * @param $state
     */
    protected function closeRequest($requestID, $state)
    {
        $values = ['State' => $state];
        $conditions = ['RequestID' => $requestID];
        parent::updateRecord($values, $conditions);
    }

    /**
     * Get last created request's ID
     *
     * @param string $empID
     * @return mixed
     * @throws SQLQueryBuilder\SQLException
     */
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

    /**
     * Change request's state to expired
     *
     * @param int $state
     * @param array $conditionStates
     * @throws SQLQueryBuilder\SQLException
     */
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

    /**
     * Get request records
     *
     * @param string $registrationNo
     * @param int $state
     * @return array
     */
    protected function getRequestsByVehicle(string $registrationNo, int $state)
    {
        $conditions = ['Vehicle' => $registrationNo, 'State' => $state];
        $requests = parent::getRecords($conditions);
        return $requests;
    }

    /**
     * Get request records
     *
     * @param string $driverID
     * @param int $state
     * @return array
     */
    protected function getRequestsByDriver(string $driverID, int $state)
    {
        $conditions = ['Driver' => $driverID, 'State' => $state];
        $requests = parent::getRecords($conditions);
        return $requests;
    }
}
