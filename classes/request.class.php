<?php
class Request implements IObjectHandle
{
    public int $requestID; 
    public string $createdDate; //how to handle 'date' in php? 
    public int $state;
    public string $dateOfTrip; //how to handle 'date' in php? 
    public string $timeOfTrip; //how to handle 'time' in php? 
    public string $dropLocation;
    public string $pickLocation;
    public string $requesterID; //EmpID
    public string $purpose; 
    public string $justifiedBy; //EmpID
    public string $approvedBy; //EmpID
    public string $JOcomment; 
    public string $CAOcomment;
    //private EmailClient $emailClient;

    //private $requestController;
    //private $requestViewer;

    private function __construct($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOcomment,$CAOcomment)
    {
        //initialize state
        $this->requestID=$requestID;
        $this->createdDate=$createdDate;
        $this->state=$state;
        $this->dateOfTrip=$dateOfTrip;
        $this->timeOfTrip=$timeOfTrip;
        $this->dropLocation=$dropLocation;
        $this->pickLocation=$pickLocation;
        $this->requesterID=$requesterID;
        $this->purpose=$purpose;
        $this->justifiedBy=$justifiedBy;
        $this->approvedBy=$approvedBy;
        $this->JOcomment=$JOcomment;
        $this->CAOcomment=$CAOcomment;


        //$this->requestController= new RequestController();
        //$this->requestViewer=new RequestViewer();

    }

        //IObjectHandle
        public static function getObject($requestID){
            //get values from database
            $requestViewer=new RequestViewer(); // method of obtaining the viewer/controller must be determined and changed
            //$values=$requestViewer->getRecordByID($requestID); //continue implementing when needed

            //$obj = new Request($values[0],$values[1],$values[2],$values[3],$values[4],$values[5],$values[6],$values[7],$values[8],$values[9],$values[10],$values[11],$values[12]);
            
            //return $obj; //return false of fail
        }
    
        //IObjectHandle
        public static function constructObject($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOcomment,$CAOcomment){
            $obj = new Request($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOcomment,$CAOcomment);
    
            $obj->saveToDatabase(); //check for failure
    
            return $obj; //return false, if fail
        }

    private function saveToDatabase(){
        $this->RequestController->addRecord($this->createdDate,
                                    $this->state,
                                    $this->dateOfTrip,
                                    $this->timeOfTrip,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->state,
                                    $this->dateOfTrip,
                                    $this->timeOfTrip,
                                    $this->dropLocation,
                                    $this->pickLocation);
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