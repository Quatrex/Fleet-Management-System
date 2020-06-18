<?php
class RequestController extends RequestModel{
    public function saveRecord($date,$time,$dropLocation,$pickLocation,$purpose,$requesterID) {
        parent::saveRecord($date,$time,$dropLocation,$pickLocation,$purpose,$requesterID);
    }
}