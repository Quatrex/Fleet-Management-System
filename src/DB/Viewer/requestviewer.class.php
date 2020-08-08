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
    
    public function getRequestsByIDNState(string $requesterID,array $states, int $offset){
        return parent::getRequestsByIDNState($requesterID,$states,$offset);
    }

    public function getJustifiedRequestsByIDNState(string $justifiedBy,array $states,int $offset){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$states,$offset);
    }

    public function getApprovedRequestsByIDNState(string $approvedBy,array $states,int $offset){
        return parent::getApprovedRequestsByIDNState($approvedBy,$states,$offset);
    }

    public function getRequestsbyState(array $states, int $offset) {
        return parent::getRequestsbyState($states, $offset);
    }

    public function getLastRequestID(string $empID) {
        return parent::getLastRequestID($empID);
    }
    //public function getScheduledRequestsByIDNState(String $scheduledBy,int $state)
}