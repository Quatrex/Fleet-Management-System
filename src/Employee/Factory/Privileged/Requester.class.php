<?php
namespace Employee\Factory\Privileged;

use Request\Factory\RequesterRequest\RequesterRequestFactory;

class Requester extends PrivilegedEmployee 
{
    public function placeRequest(array $values){
        $values ['RequesterID'] = $this->empID;
        $request = RequesterRequestFactory::makeNewRequest($values);
    }

    public function cancelRequest($requestID){
        $request = RequesterRequestFactory::makeRequest($requestID);
        $request->cancel();
    }

    public function getMyRequests(array $states) : array 
    {
        return RequesterRequestFactory::makeRequests($this->empID,$states);
    }
}