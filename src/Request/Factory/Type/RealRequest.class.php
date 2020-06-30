<?php
namespace Request\Factory\Type;

use DB\Viewer\RequestViewer;
use DB\Controller\RequestController;
use DB\IObjectHandle;
use Request\State\State;
use Request\Request;
use Employee\Driver;
use Vehicle\Vehicle;
use JsonSerializable;

class RealRequest implements IObjectHandle, Request, JsonSerializable
{
    //ToDO: make attributes private and use get/set methods
    private int $requestID; 
    private string $createdDate; //how to handle 'date' in php? 
    private ?State $state;
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

    //private EmailClient $emailClient;

    //private $requestController;
    //private $requestViewer;

    public function __construct($requestID,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,$justifiedBy,$approvedBy,$JOComment,$CAOComment)
    {

        //initialize state
        $this->requestID=$requestID;
        $this->createdDate=($createdDate!= null)?$createdDate:'';
        $this->state=State::getState($state);;
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
    }
    public function jsonSerialize()
    {
        return ['RequestId'=>$this->requestID,'DateOfTrip'=> $this->dateOfTrip,'TimeOfTrip'=> $this->timeOfTrip,'PickLocation'=>$this->pickLocation,'DropLocation'=> $this->dropLocation,'Purpose'=>$this->purpose];
    }

    //IObjectHandle
    public static function getObject(int $ID){
        $requestID=$ID;
        //get values from database
        $requestViewer=new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$requestViewer->getRecordByID($requestID);


        $obj = new RealRequest($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
        
        return $obj;
    }

    //IObjectHandle 
    public static function getObjectByValues(array $values){
        $obj = new RealRequest($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose){
        $createdDate= date("Y-m-d");
        $state=1;//get state using enum
        $obj = new RealRequest(-1,$createdDate,$state,$dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$requesterID,$purpose,-1,-1,"","");

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    private function saveToDatabase(){
        $requestController= new RequestController();
        $requestController->saveRecord( 
                                    //requestID is auto generated by the database
                                    $this->createdDate,
                                    $this->state->getID(),
                                    $this->dateOfTrip,
                                    $this->timeOfTrip,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->requesterID,
                                    $this->purpose);
    }

    public function setState(State $state) : void {
        $this->state = $state;
    }

    public function notifyJOs(){
        // $emailClient = new EmailClient();
        // $emailClient ->notifyRequestSubmission($this);
    }

    public function setJustified($justifiedBy,$JOComment){
        $this->justifiedBy=$justifiedBy;
        $this->JOComment=$JOComment;
        $this->state->justify($this);
        
        $requestController=new RequestController();
        $requestController->justifyRequest($this->requestID,$this->JOComment,$this->justifiedBy);
    }

    public function setApproved($approvedBy,$CAOComment){
        $this->justifiedBy=$approvedBy;
        $this->JOComment=$CAOComment;
        $this->state->approve($this);
        
        $requestController=new RequestController();
        $requestController->approveRequest($this->requestID,$this->CAOComment,$this->approvedBy);
    }

    public function setDenied($empID,$comment,$position){
        
        switch ($position) {
            case "jo"://TODO: must be the same name as in employee table
                $this->justifiedBy=$empID;
                $this->JOComment=$comment;
                break;
            case "cao"://TODO: must be the same name as in employee table
                $this->approvedBy=$empID;
                $this->CAOComment=$comment;
                break;
        }
        
        $this->state->approve($this);
        
        $requestController=new RequestController();
        $requestController->denyRequest($this->requestID,$comment,$empID,$position);
    }

    public function getField($field){
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    public function cancel() : void
    {

    }

    public function setJustify(bool $justification, int $empID, string $comment) : void
    {

    }

    public function setApprove(bool $approval, int $empID, string $comment) : void
    {

    }
    
    public function schedule(int $empID, Driver $driver, Vehicle $vehicle) : void
    {

    }
    
    public function close() : void
    {

    }
}