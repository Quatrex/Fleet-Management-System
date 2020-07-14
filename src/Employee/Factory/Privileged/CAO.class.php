<?php
namespace Employee\Factory\Privileged;


use DB\Viewer\EmployeeViewer;
use Request\Factory\CAORequest\CAORequestFactory;

class CAO extends Requester
{
    public function getMyApprovedRequests(array $states) : array {
        return CAORequestFactory::makeApprovedRequests($this->empID,$states);
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
