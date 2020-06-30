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
    
    public function getRequestsByIDNState(String $requesterID,int $state){
        return parent::getRequestsByIDNState($requesterID,$state);
    }

    public function getJustifiedRequestsByIDNState(String $justifiedBy,int $state){
        return parent::getJustifiedRequestsByIDNState($justifiedBy,$state);
    }

    public function getApprovedRequestsByIDNState(String $approvedBy,int $state){
        return parent::getApprovedRequestsByIDNState($approvedBy,$state);
    }

    //public function getScheduledRequestsByIDNState(String $scheduledBy,int $state)

    public function getPendingRequests(){
        return parent::getPendingRequests();
    }

    public function getJustifiedRequests(){
        return parent::getJustifiedRequests();
    }

    public function getApprovedRequests(){
        return parent::getApprovedRequests();
    }
}