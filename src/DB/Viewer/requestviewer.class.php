<?php
namespace DB\Viewer;

use DB\Model\RequestModel;


class RequestViewer extends RequestModel{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function getRecordByID($requestID){
        return parent::getRecordByID($requestID);
    }

    /**
     * @inheritDoc
     */
    public function getRequestsByIDNState(string $requesterID,array $states, int $offset, array $sort, array $search){
        return parent::getRequestsByIDNState($requesterID,$states,$offset,$sort,$search);
    }

    /**
     * @inheritDoc
     */
    public function getJustifiedRequestsByIDNState(string $justifiedBy,array $states,int $offset, array $sort, array $search){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$states,$offset,$sort,$search);
    }

    /**
     * @inheritDoc
     */
    public function getApprovedRequestsByIDNState(string $approvedBy,array $states,int $offset, array $sort, array $search){
        return parent::getApprovedRequestsByIDNState($approvedBy,$states,$offset,$sort,$search);
    }

    /**
     * @inheritDoc
     */
    public function getScheduledRequestsByIDNState(string $scheduledBy,array $states,int $offset, array $sort, array $search){
        return parent::getScheduledRequestsByIDNState($scheduledBy,$states,$offset,$sort,$search);
    }

    /**
     * @inheritDoc
     */
    public function getRequestsbyState(array $states, int $offset, array $sort, array $search) {
        return parent::getRequestsbyState($states, $offset, $sort, $search);
    }

    /**
     * @inheritDoc
     */
    public function getLastRequestID(string $empID) {
        return parent::getLastRequestID($empID);
    }

    /**
     * @inheritDoc
     */
    public function getRequestsByVehicle(string $registrationNo, int $state) {
        return parent::getRequestsByVehicle($registrationNo,$state);
    }

    /**
     * @inheritDoc
     */
    public function getRequestsByDriver(string $driverID, int $state) {
        return parent::getRequestsByDriver($driverID,$state);
    }
}