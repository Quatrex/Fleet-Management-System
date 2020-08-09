<?php
namespace Employee\Factory\Privileged;


use DB\Viewer\EmployeeViewer;
use Request\Factory\CAORequest\CAORequestFactory;

class CAO extends Requester
{
    public function getMyApprovedRequests   (array $states,
                                            int $offset, 
                                            array $sort = ['CreatedDate' => 'DESC'], 
                                            array $search = ['' => ['All']]) : array {
        return CAORequestFactory::makeApprovedRequests($this->empID,$states,$offset,$sort,$search);
    }

    public function getJustifiedRequests(   int $offset, 
                                            array $sort = ['CreatedDate' => 'DESC'], 
                                            array $search = ['' => ['All']]){
        return CAORequestFactory::makeJustifiedRequests($offset,$sort,$search);
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
