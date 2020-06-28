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

    public function getRequestsByJOIDNState(String $justifiedBy,int $state){
        return parent::getRequestsByJOIDNState($justifiedBy,$state);
    }

    public function getRequestsByCAOIDNState(String $approvedBy,int $state){
        return parent::getRequestsByCAOIDNState($approvedBy,$state);
    }

    // public function getPendingRequestsByID($requesterID){
    //     return parent::getPendingRequestsByID($requesterID);
    // }

    public function getPendingRequests(){
        return parent::getPendingRequests();
    }

    public function getJustifiedRequests(){
        return parent::getJustifiedRequests();
    }
}