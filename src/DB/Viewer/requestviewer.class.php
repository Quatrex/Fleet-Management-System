<?php
namespace DB\Viewer;

use DB\Model\RequestModel;


class RequestViewer extends RequestModel{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($requestID){
        return parent::getRecordByID($requestID);
    }
    
    public function getRequestsByIDNState(string $requesterID,array $states, int $offset, array $sort, array $search){
        return parent::getRequestsByIDNState($requesterID,$states,$offset,$sort,$search);
    }

    public function getJustifiedRequestsByIDNState(string $justifiedBy,array $states,int $offset, array $sort, array $search){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$states,$offset,$sort,$search);
    }

    public function getApprovedRequestsByIDNState(string $approvedBy,array $states,int $offset, array $sort, array $search){
        return parent::getApprovedRequestsByIDNState($approvedBy,$states,$offset,$sort,$search);
    }

    public function getRequestsbyState(array $states, int $offset, array $sort, array $search) {
        return parent::getRequestsbyState($states, $offset, $sort, $search);
    }

    public function getLastRequestID(string $empID) {
        return parent::getLastRequestID($empID);
    }
    //public function getScheduledRequestsByIDNState(String $scheduledBy,int $state)
}