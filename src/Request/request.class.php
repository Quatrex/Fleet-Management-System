<?php
namespace Request;

use DB\Viewer\RequestViewer;
use DB\Controller\RequestController;
use DB\IObjectHandle;
use Request\State\State;

class Request implements IObjectHandle
{
    //ToDO: make attributes private and use get/set methods
    private int $requestID; 
    private string $createdDate; //how to handle 'date' in php? 
    private int $state;
    private string $dateOfTrip; //how to handle 'date' in php? 
    private string $timeOfTrip; //how to handle 'time' in php? 
    private string $dropLocation;
    private string $pickLocation;
    private string $requesterID; //EmpID
    private string $purpose; 
    private string $justifiedBy; //EmpID
    private string $approvedBy; //EmpID
    private string $JOComment; 
    private string $CAOComment;

    private State $stateObject;
    //private EmailClient $emailClient;

    //private $requestController;
    //private $requestViewer;

    public function __construct($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOComment,$CAOComment)
    {
        //initialize state
        $this->requestID=$requestID;
        $this->createdDate=($createdDate!= null)?$createdDate:'';
        $this->state=($state!= null)?$state:''; //TODO: assign the real state object using State class
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
        
        //initializing the state object


        //$this->requestController= new RequestController();
        //$this->requestViewer=new RequestViewer();

    }

        //IObjectHandle
        public static function getObject(int $ID){
            $requestID=$ID;
            //get values from database
            $requestViewer=new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
            $values=$requestViewer->getRecordByID($requestID);


            $obj = new Request($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
            
            return $obj;
        }

        public static function getObjectByValues(array $values){
            $obj = new Request($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
            return $obj;
        }
    
        //IObjectHandle
        public static function constructObject($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose){
            $createdDate= date("Y-m-d");
            $state=1;//get state using enum
            $obj = new Request(-1,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,-1,-1,"","");
    
            $obj->saveToDatabase(); //check for failure
    
            return $obj; //return false, if fail
        }

    private function saveToDatabase(){
        $requestController= new RequestController();
        $requestController->saveRecord( 
                                    //requestID is auto generated by the database
                                    $this->createdDate,
                                    $this->state,
                                    $this->dateOfTrip,
                                    $this->timeOfTrip,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->requesterID,
                                    $this->purpose);
    }

    public function setState(State $stateObject) : void {
        $this->stateObject = $stateObject;
    }

    public function notifyJOs(){
        // $emailClient = new EmailClient();
        // $emailClient ->notifyRequestSubmission($this);
    }

    public function setJustified($officerID,$comment){
        //if condition
        $this->stateObject->justify($this);
        $this->stateObject->denyJustify($this);
        //update $justifiedBy
    }

    public function setApproved($officerID,$comment){
        //if condition
        $this->stateObject->approve($this);
        $this->stateObject->denyApprove($this);
        //update $approvedBy
    }

    public function getField($field){
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
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

    public function getRequestID() : int
    {
        return $this->requestID;
    }
}