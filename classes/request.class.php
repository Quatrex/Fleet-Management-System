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
    private Requester $requester;
    private string $JOcomment; 
    private string $CAOcomment;
    private int $state;
    private JO $justifiedBy; 
    private CAO $approvedBy;
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
        $this ->emailClient ->notifyRequestSubmission($this);
    }

    public function setJustified($officerID,$comment){
        //update $justifiedBy
    }

    public function setApproved($officerID,$comment){
        //update $approvedBy
    }

    public function getRequesterFullName() {
        return $this ->requester ->getFullName();
    }

    public function getJOFullName() {
        return $this ->justifiedBy ->getFullName();
    }

    public function getCAOFullName() {
        return $this ->approvedBy ->getFullName();
    }

    public function getRequesterEmail() {
        return $this ->requester ->getEmail();
    }

    public function getJOEmail() {
        return $this ->justifiedBy ->getEmail();
    }
}