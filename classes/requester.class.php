<?php
class Requester extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);

        //incluce required viewer and controller classes
    }

    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose){
        //continue
    }
}