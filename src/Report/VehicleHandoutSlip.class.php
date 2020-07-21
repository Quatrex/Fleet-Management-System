<?php

namespace Report;

use Request;
use Request\Factory\Base\RealRequest;

class VehicleHandoutSlip implements IVisitor{
    private string $requesterFirstName;
    private string $requesterLastName;
    private string $requesterDesignation;

    private string $justifierFirstName;
    private string $justifierLastName;
    private string $justifierDesignation;

    private string $approverFirstName;
    private string $approverLastName;
    private string $approverDesignation;

    private string $purpose;
    private string $dateOfTrip;
    private string $timeOfTrip;
    private string $dropLocation;
    private string $pickLocation;


    public function print():void{
        //print token
    }

    public function visit(IVisitable $visitable,string $visitableType)
    {
        if($visitableType=='request'){
            $values=$visitable->getInfo();

            $this->purpose=$values['purpose'];
            $this->dateOfTrip=$values['dateOfTrip'];
            $this->timeOfTrip=$values['timeOfTrip'];
            $this->dropLocation=$values['dropLocation'];
            $this->pickLocation=$values['pickLocation'];
        }
        elseif($visitableType=='requester'){
            $values=$visitable->getInfo();

            $this->requesterFirstName=$values['firstName'];
            $this->requesterLastName=$values['lastName'];
            $this->requesterDesignation=$values['designation'];
        }
        elseif($visitableType=='justifiedBy'){
            $values=$visitable->getInfo();

            $this->justifierFirstName=$values['firstName'];
            $this->justifierLastName=$values['lastName'];
            $this->justifierDesignation=$values['designation'];
        }
        elseif($visitableType=='approvedBy'){
            $values=$visitable->getInfo();

            $this->approverFirstName=$values['firstName'];
            $this->approverLastName=$values['lastName'];
            $this->approverDesignation=$values['designation'];
        }
    }

    public function getField($field)
    {
        if (property_exists($this, $field)) {
            return $this->$field;
        }
        return null;
    }
}