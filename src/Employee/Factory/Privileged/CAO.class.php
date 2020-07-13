<?php
namespace Employee\Factory\Privileged;


use DB\Viewer\EmployeeViewer;
use Request\Factory\CAORequest\CAORequestFactory;

class CAO extends Requester
{
    public function getMyApprovedRequestsByState(string $state) : array {
        return CAORequestFactory::makeApprovedRequests($this->empID,$state);
    }

    public function getJustifiedRequests(){
        return CAORequestFactory::makeJustifiedRequests();
    }

    public function approveRequest($requestID,$CAOComment){
        $request = CAORequestFactory::makeRequest($requestID);
        $request->setApprove(true,$this->empID,$CAOComment);
    }

    public function denyRequest($requestID,$CAOComment){
        $request = CAORequestFactory::makeRequest($requestID);
        $request->setApprove(false,$this->empID,$CAOComment);
    }

}
