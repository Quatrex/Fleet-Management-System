<?php
namespace Employee;

class Administrator extends Employee
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
        //incluce required viewer and controller classes
    }

    public function getAllEmployees(){
        //return an array of all employees (implement sperately for drivers)
    }

    public function createNewAccount(){
        //create a new employee account
    }

    public function updateAccount(){
        //update an existing employee account's details
    }

    public function removeAccount(){
        //delete an employee account
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
