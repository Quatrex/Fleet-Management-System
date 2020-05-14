<?php
class Requester extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);

        //incluce required viewer and controller classes
    }

    //IRequestable
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose){
        //create request object
        $request=new Request();//include parameters
    }

    //IRequestable
    public function getRequests(){ //IRequestable
        //check database for requests placed by the requester and return an array oof requests
        
    }
}