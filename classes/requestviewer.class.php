<?php
class RequestViewer extends RequestModel{
    public function getPendingRequestsByID($requesterID){
        return parent::getPendingRequestsByID($requesterID);
    }
}