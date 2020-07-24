<?php
namespace Employee\Factory\Privileged;

use Request\Factory\JORequest\JORequestFactory;

class JO extends Requester
{
    public function getMyJustifiedRequests(array $states) : array {
        return JORequestFactory::makeJustifiedRequests($this->empID,$states);
    }

    public function getPendingRequests(){
        return JORequestFactory::makePendingRequests();
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
}