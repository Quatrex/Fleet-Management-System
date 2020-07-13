<?php
namespace Employee\Factory\Privileged;

use Request\Factory\RequesterRequest\RequesterRequestFactory;
use JsonSerializable;

class Requester extends PrivilegedEmployee implements JsonSerializable
{
    public function jsonSerialize()
    {
        return ['empID'=>$this->empID,
                'FirstName'=> $this->firstName,
                'LastName'=> $this->lastName,
                'Position'=>$this->position];
    }    

    public function placeRequest(array $values){
        $values ['RequesterID'] = $this->empID;
        $request = RequesterRequestFactory::makeNewRequest($values);
    }

    public function cancelRequest($requestID){
        $request = RequesterRequestFactory::makeRequest($requestID);
        $request->cancel();
    }

    public function getMyRequestsByState(string $state) : array 
    {
        return RequesterRequestFactory::makeRequests($this->empID,$state);
    }
}