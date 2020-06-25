<?php
namespace Employee;

use Request\Request;
use DB\IObjectHandle;
use DB\Viewer\RequestViewer;
use DB\Viewer\EmployeeViewer;

class JO extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
        //incluce required viewer and controller classes
    }

    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], $values['Password']);
        
        return $obj; //return false, if fail
    }

    public function getRequestsToJustify(){
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getRequestsOfAState(1);
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function getJustifiedRequests(){
        //return an array of all requests, justified by this JO
    }

    public function getDeniedRequests(){
        //return an array of all requests, denied by this JO
    }

    //IRequestable
    public function placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose){
        $request= Request::constructObject($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$this->empID,$purpose);
        //$request->notifyJOs(); //change: notify JOs when the state change occurs
    }

    //IRequestable
    public function getMyPendingRequests(){
        //check database for pending requests placed by the requester and return an array of requests
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