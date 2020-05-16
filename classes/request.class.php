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
    private EmailClient $emailClient;

    private $controller;

    function __construct($date,$time,$dropLocation,$pickLocation,$purpose,$requester) //include parameters
    {
        //initialize state
        $this->date=$date;
        $this->time=$time;
        $this->dropLocation=$dropLocation;
        $this->pickLocation=$pickLocation;
        $this->purpose=$purpose;
        $this->requester=$requester;

        $this->controller= new Controller();
        $this ->emailClient = new EmailClient();

        $this->notifyJOs(); //awul awul awul
    }

    public function saveToDatabase(){
        $this->controller->addRecord($this->date,
                                    $this->time,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->purpose,
                                    $this->requesterID);
    }

    private function notifyJOs(){
        $this ->emailClient ->notifyRequestSubmission($this);
    }

    public function setJustified($officerID,$comment){
        //update $justifiedBy
    }

    public function setApproved($officerID,$comment){
        //update $approvedBy
    }

    public function getRequesterFullName() {
        return 'scooby doo5';//return $this ->requester ->getFullName();
    }

    public function getJOFullName() {
        return 'scooby doo1';//return $this ->justifiedBy ->getFullName();
    }

    public function getCAOFullName() {
        return 'scooby doo2';//return $this ->approvedBy ->getFullName();
    }

    public function getRequesterEmail() {
        return 'nagitha98@gmail.com';//return $this ->requester ->getEmail();
    }

    public function getJOEmail() {
        return 'scooby doo4';//return $this ->justifiedBy ->getEmail();
    }
}