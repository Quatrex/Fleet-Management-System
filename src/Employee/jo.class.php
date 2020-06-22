<?php
namespace Employee;

class JO extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
        //incluce required viewer and controller classes
    }

    public function getRequestsToJustify(){
        //return an array of all pending requests
    }

    public function getJustifiedRequests(){
        //return an array of all requests, justified by this JO
    }

    public function getDeniedRequests(){
        //return an array of all requests, denied by this JO
    }

    //IRequestable
    public function placeRequest(){
        //create new request
    }

    //IRequestable
    public function getPendingRequests(){
        //check database for pending requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getCancelledRequests(){
        //check database for cancelled requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getApprovedRequests(){
        //check database for approved(but trip isn't completed) requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getOldRequests(){
        //check database for all old requests(all requests other than approved and pending requests) placed by the requester and return an array of requests
    }
}