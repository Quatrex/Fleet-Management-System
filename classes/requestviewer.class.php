<?php
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
}