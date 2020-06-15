<?php
class Request implements IObjectHandle
{
    //ToDO: make attributes private and use get/set methods
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
    public string $JOComment; 
    public string $CAOComment;
    //private EmailClient $emailClient;

    //private $requestController;
    //private $requestViewer;

    private function __construct($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOComment,$CAOComment)
    {
        //initialize state
        $this->requestID=$requestID;
        $this->createdDate=($createdDate!= null)?$createdDate:'';
        $this->state=($state!= null)?$state:'';
        $this->dateOfTrip=$dateOfTrip;
        $this->timeOfTrip=$timeOfTrip;
        $this->dropLocation=$dropLocation;
        $this->pickLocation=$pickLocation;
        $this->requesterID=$requesterID;
        $this->purpose=($purpose!= null)?$purpose:'';
        $this->justifiedBy=($justifiedBy!= null)?$justifiedBy:'';
        $this->approvedBy=($approvedBy!= null)?$approvedBy:'';
        $this->JOComment=($JOComment!= null)?$JOComment:'';
        $this->CAOComment=($CAOComment!= null)?$CAOComment:'';


        //$this->requestController= new RequestController();
        //$this->requestViewer=new RequestViewer();

    }

        //IObjectHandle
        public static function getObject($ID){
            $requestID=$ID;
            //get values from database
            $requestViewer=new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
            $values=$requestViewer->getRecordByID($requestID);

            $obj = new Request($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
            
            return $obj;
        }
    
        //IObjectHandle
        public static function constructObject($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOComment,$CAOComment){
            $obj = new Request($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOComment,$CAOComment);
    
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