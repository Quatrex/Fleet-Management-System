<?php
namespace DB\Controller;

use DB\Model\RequestModel;

class RequestController extends RequestModel{
    public function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        parent::saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
    }

    public function justifyRequest($requestID,$JOComment,$empID){
        parent::justifyRequest($requestID,$JOComment,$empID);
    }

    public function approveRequest($requestID,$JOComment,$empID){
        parent::approveRequest($requestID,$JOComment,$empID);
    }

    public function denyRequest($requestID,$Comment,$empID,$position){
        parent::denyRequest($requestID,$Comment,$empID,$position);
    }
}