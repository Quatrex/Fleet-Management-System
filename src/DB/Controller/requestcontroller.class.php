<?php
namespace DB\Controller;

use DB\Model\RequestModel;

class RequestController extends RequestModel{
    public function saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose) {
        parent::saveRecord($createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose);
    }
}