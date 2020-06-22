<?php
class VPMO extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
        //incluce required viewer and controller classes
    }

    public function getNewTripRequests(){
        //return an array of approved requests
    }

    public function getOngoingTrips(){
        //return an array of ongoing trips
    }

    public function getAvailableVehicleList(){
        //return an array of all non removed vehicles
    }

    public function getAvailableDriverList(){
        //return an array of all non removed drivers
    }

    public function addNewVehicle(){
        //create a new employee account
    }

    public function updateVehicleDetails(){
        //update an existing employee account's details
    }

    public function removeVehicle(){
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