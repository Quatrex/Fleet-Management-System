<?php
namespace DB\Viewer;

use DB\Model\RequestModel;

class RequestViewer extends RequestModel{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($empID){
        return parent::getRecordByID($empID);
    }
    
    public function getPendingRequestsByID($requesterID){
        return parent::getPendingRequestsByID($requesterID);
    }

    public function getPendingRequests(){
        return parent::getPendingRequests();
    }

    public function getJustifiedRequests(){
        return parent::getJustifiedRequests();
    }
}