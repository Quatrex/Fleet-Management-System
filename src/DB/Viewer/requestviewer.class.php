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
    
    public function getRequestsByIDNState(string $requesterID,int $state){
        return parent::getRequestsByIDNState($requesterID,$state);
    }

    public function getJustifiedRequestsByIDNState(string $justifiedBy,int $state){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$state);
    }

    public function getApprovedRequestsByIDNState(string $approvedBy,int $state){
        return parent::getApprovedRequestsByIDNState($approvedBy,$state);
    }

    public function getRequestsbyState(string $state) {
        return parent::getRequestsbyState($state);
    }

    //public function getScheduledRequestsByIDNState(String $scheduledBy,int $state)
}