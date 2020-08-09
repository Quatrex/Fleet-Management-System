<?php
namespace Employee\Factory\Privileged;

use Request\Factory\JORequest\JORequestFactory;
use Vehicle\Factory\Base\VehicleFactory;

class JO extends Requester
{
    public function getMyJustifiedRequests(array $states, int $offset = 0) : array {
        return JORequestFactory::makeJustifiedRequests($this->empID,$states,$offset);
    }

    public function getPendingRequests(int $offset = 0){
        return JORequestFactory::makePendingRequests($offset);
    }

    public function justifyRequest($requestID,$JOComment){
        $request = JORequestFactory::makeRequest($requestID);
        $request->setJustify(true,$this->empID,$JOComment,$this->position);
        return $request;
    }

    public function denyRequest($requestID,$JOComment){
        $request = JORequestFactory::makeRequest($requestID);
        $request->setJustify(false,$this->empID,$JOComment,$this->position);
        return $request;
    }

    /**
     *
     * Returns all the vehicles
     *
     * @return array(Vehicle)
     *
     */
    public function getVehicles(int $offset = 0)
    {
        return VehicleFactory::getVehicles($offset);
    }
}