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
    
    public function getRequestsByIDNState(string $requesterID,array $states){
        return parent::getRequestsByIDNState($requesterID,$states);
    }

    public function getJustifiedRequestsByIDNState(string $justifiedBy,array $states){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$states);
    }

    public function getApprovedRequestsByIDNState(string $approvedBy,array $states){
        return parent::getApprovedRequestsByIDNState($approvedBy,$states);
    }

    public function getRequestsbyState(string $state) {
        return parent::getRequestsbyState($state);
    }
    //public function getScheduledRequestsByIDNState(String $scheduledBy,int $state)
}