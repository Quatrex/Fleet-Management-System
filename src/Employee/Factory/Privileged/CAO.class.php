<?php
namespace Employee\Factory\Privileged;


use DB\Viewer\EmployeeViewer;
use Request\Factory\CAORequest\CAORequestFactory;

class CAO extends Requester
{
    public function getMyApprovedRequests(array $states, int $offset) : array {
        return CAORequestFactory::makeApprovedRequests($this->empID,$states,$offset);
    }

    public function getJustifiedRequests(int $offset){
        return CAORequestFactory::makeJustifiedRequests($offset);
    }

    public function approveRequest($requestID,$CAOComment){
        $request = CAORequestFactory::makeRequest($requestID);
        $request->setApprove(true,$this->empID,$CAOComment);
        return $request;
    }

    public function denyRequest($requestID,$CAOComment){
        $request = CAORequestFactory::makeRequest($requestID);
        $request->setApprove(false,$this->empID,$CAOComment);
        return $request;
    }

}
