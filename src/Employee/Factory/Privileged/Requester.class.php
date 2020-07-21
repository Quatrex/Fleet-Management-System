<?php
namespace Employee\Factory\Privileged;

use Report\IVisitable;
use Report\IVisitor;
use Request\Factory\RequesterRequest\RequesterRequestFactory;

class Requester extends PrivilegedEmployee implements IVisitable
{
    public function placeRequest(array $values){
        $values ['RequesterID'] = $this->empID;
        return RequesterRequestFactory::makeNewRequest($values);
    }

    public function cancelRequest($requestID){
        $request = RequesterRequestFactory::makeRequest($requestID);
        $request->cancel();
    }

    public function getMyRequests(array $states) : array 
    {
        return RequesterRequestFactory::makeRequests($this->empID,$states);
    }

    public function accept(IVisitor $requestToken,string $visitableType)
    {
        $requestToken->visit($this,$visitableType);
    }

    public function getInfo(): array
    {
        $values = array();
        $values['firstName'] = $this->firstName;
        $values['lastName'] = $this->lastName;
        $values['designation'] = $this->designation;
        return $values;
    }
}