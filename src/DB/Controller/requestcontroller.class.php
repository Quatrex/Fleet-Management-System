<?php

namespace DB\Controller;

use DB\Model\RequestModel;

class RequestController extends RequestModel
{
    public function saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose)
    {
        parent::saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose);
    }

    public function updateState($requestID, $state)
    {
        parent::updateState($requestID, $state);
    }

    public function justifyRequest($requestID, $JOComment, $justifiedBy, $state)
    {
        parent::justifyRequest($requestID, $JOComment, $justifiedBy, $state);
    }

    public function approveRequest($requestID, $JOComment, $approvedBy, $state)
    {
        parent::approveRequest($requestID, $JOComment, $approvedBy, $state);
    }

    public function scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $stateID)
    {
        parent::scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $stateID);
    }

    public function closeRequest($requestID, $stateID)
    {
        parent::closeRequest($requestID, $stateID);
    }
}
