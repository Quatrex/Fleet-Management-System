<?php

namespace DB\Controller;

use DB\Model\RequestModel;

class RequestController extends RequestModel
{
    /**
     * @inheritDoc
     */
    public function saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose)
    {
        parent::saveRecord($createdDate, $state, $dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $requesterID, $purpose);
    }

    /**
     * @inheritDoc
     */
    public function updateState($requestID, $state)
    {
        parent::updateState($requestID, $state);
    }

    /**
     * @inheritDoc
     */
    public function justifyRequest($requestID, $JOComment, $justifiedBy, $state)
    {
        parent::justifyRequest($requestID, $JOComment, $justifiedBy, $state);
    }

    /**
     * @inheritDoc
     */
    public function approveRequest($requestID, $JOComment, $approvedBy, $state)
    {
        parent::approveRequest($requestID, $JOComment, $approvedBy, $state);
    }

    /**
     * @inheritDoc
     */
    public function scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $stateID)
    {
        parent::scheduleRequest($requestID, $scehduledBy, $driver, $vehicle, $stateID);
    }

    /**
     * @inheritDoc
     */
    public function closeRequest($requestID, $stateID)
    {
        parent::closeRequest($requestID, $stateID);
    }

    /**
     * @inheritDoc
     */
    public function expireRequests(int $state , array $conditionStates)
    {
        parent::expireRequests($state , $conditionStates);
    }
}
