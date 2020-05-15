<?php
class Request
{
    public int $requestID; 
    public $createdDate; //how to handle 'date' in php? 
    public $date; //how to handle 'date' in php? 
    public $time; //how to handle 'time' in php? 
    public string $dropLocation;
    public string $pickLocation;
    public string $purpose; 
    public string $requesterID; //EmpID
    public string $JOcomment; 
    public string $CAOcomment;
    public int $state;
    public string $justifiedBy; //EmpID
    public string $approvedBy; //EmpID

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