<?php
class Requester extends Employee implements IRequestable
{
    private $controller;
private $viewer;

    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);

        //incluce required viewer and controller classes
        $this->controller= new Controller();
        $this->viewer= new Viewer();

    }

    //IRequestable
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose){
        //create request object
        $request=new Request($date,$time,$dropLocation,$pickLocation,$purpose,$this->empID);//include parameters
    }

    //IRequestable
    public function getPendingRequests($requesterID, $status){
        return $this->viewer->getRecords($requesterID, $status);
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