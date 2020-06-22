<?php
namespace Employee;

use Request\Request;
use DB\IObjectHandle;
use DB\Viewer\RequestViewer;
use DB\Viewer\EmployeeViewer;
// use Request as Request;
class Requester extends Employee implements IRequestable,IObjectHandle
{
    public function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
    }

    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new Requester($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], $values['Password']);
        
        return $obj; //return false, if fail
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){
        $obj = new Requester($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

       return $obj; //return false, if fail
    }

    private function saveToDatabase(){
        $this->RequestController->addRecord($this->date,
                                    $this->time,
                                    $this->dropLocation,
                                    $this->pickLocation,
                                    $this->purpose,
                                    $this->requesterID);
    }


    //IRequestable
    public function placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose){
        $request= Request::constructObject($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$this->empID,$purpose);
        //$request->notifyJOs(); //change: notify JOs when the state change occurs
    }

    //IRequestable
    public function getMyPendingRequests(){
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getPendingRequestsByID($this->empID);
        $requests=array();

        foreach($requestIDs as $values){
            $request= new Request($values['RequestID'], $values['CreatedDate'], $values['State'], $values['DateOfTrip'], $values['TimeOfTrip'], $values['DropLocation'], $values['PickLocation'],$values['RequesterID'], $values['Purpose'], $values['JustifiedBy'], $values['ApprovedBy'], $values['JOComment'], $values['CAOComment']);
            array_push($requests,$request);
        }

        return $requests;
    }

    //IRequestable
    public function getCancelledRequests(){
        //check database for cancelled requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getApprovedRequests(){
        //check database for approved(but trip isn't completed) requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getOldRequests(){
        //check database for all old requests(all requests other than approved and pending requests) placed by the requester and return an array of requests
    }
}