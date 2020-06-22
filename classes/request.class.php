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
    //private EmailClient $emailClient;

    private $controller;

    function __construct($date,$time,$dropLocation,$pickLocation,$purpose,$requester) //include parameters
    {
        //initialize state
        $this->date=$date;
        $this->time=$time;
        $this->dropLocation=$dropLocation;
        $this->pickLocation=$pickLocation;
        $this->purpose=$purpose;
        $this->requesterID=$requester;

        $this->controller= new Controller();

    }

    public function saveToDatabase(){
        $this->controller->addRecord($this->date,
                                    $this->time,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->purpose,
                                    $this->requesterID);
    }

    public function notifyJOs(){
        $emailClient = new EmailClient();
        $emailClient ->notifyRequestSubmission($this);
    }

    public function setJustified($officerID,$comment){
        //update $justifiedBy
    }

    public function setApproved($officerID,$comment){
        //update $approvedBy
    }

    public function getRequesterFullName() {
        return 'A requester';//return $this ->requester ->getFullName();
    }

    public function getJOFullName() {
        return 'Justifying Officer';//return $this ->justifiedBy ->getFullName();
    }

    public function getCAOFullName() {
        return 'Chief Administrative Officer';//return $this ->approvedBy ->getFullName();
    }

    public function getRequesterEmail() {
        return 'nagitha98@gmail.com';//return $this ->requester ->getEmail();
    }

    public function getJOEmail() {
        return 'Justifying Officer';//return $this ->justifiedBy ->getEmail();
    }
}