<?php
class Request
{
    private int $requestID; 
    private $createdDate; //how to handle 'date' in php? 
    private $date; //how to handle 'date' in php? 
    private $time; //how to handle 'time' in php? 
    private string $dropLocation;
    private string $pickLocation;
    private string $purpose; 
    private string $requesterID; //EmpID
    private string $JOcomment; 
    private string $CAOcomment;
    private int $state;
    private string $justifiedBy; //EmpID
    private string $approvedBy; //EmpID

    private $controller;

    function __construct($date,$time,$dropLocation,$pickLocation,$purpose,$requesterID) //include parameters
    {
        //initialize state
        $this->date=$date;
        $this->time=$time;
        $this->dropLocation=$dropLocation;
        $this->pickLocation=$pickLocation;
        $this->purpose=$purpose;
        $this->requesterID=$requesterID;

        $this->controller= new Controller();

        $this->saveToDatabase();
        $this->notifyJOs();
    }

    private function saveToDatabase(){
        $this->controller->addRecord($this->date,
                                    $this->time,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->purpose,
                                    $this->requesterID);
    }

    private function notifyJOs(){
        //send emails to all JOs using a SystemManager
    }

    public function setJustified($officerID,$comment){
        //update $justifiedBy
    }

    public function setApproved($officerID,$comment){
        //update $approvedBy
    }

}