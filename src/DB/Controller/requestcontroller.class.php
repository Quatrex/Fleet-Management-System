<?php
namespace DB\Controller;

use DB\Model\RequestModel;

class RequestController extends RequestModel{
    public function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        parent::saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
    }

    public function justifyRequest($requestID,$JOComment,$justifiedBy){
        parent::justifyRequest($requestID,$JOComment,$justifiedBy);
    }

    public function approveRequest($requestID,$JOComment,$approvedBy){
        parent::approveRequest($requestID,$JOComment,$approvedBy);
    }

    public function denyRequest($requestID,$Comment,$empID,$position){
        parent::denyRequest($requestID,$Comment,$empID,$position);
    }
}