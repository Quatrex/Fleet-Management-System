<?php
namespace Employee;

use DB\Controller\EmployeeController;
use Request\Request;
use DB\IObjectHandle;
use DB\Controller\RequestController;
use DB\Viewer\RequestViewer;
use DB\Viewer\EmployeeViewer;
class CAO extends Employee implements IRequestable
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

        $obj = new CAO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    public static function getObjectByValues(array $values){
        $obj = new CAO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){

        $obj = new CAO($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    private function saveToDatabase(){
        $employeeController= new EmployeeController();
        $employeeController->saveRecord( 
                                    $this->empID, //check for existing accounts of this empID
                                    $this->firstName,
                                    $this->lastName,
                                    $this->position,
                                    $this->email,
                                    $this->username,
                                    $this->password);
    }

    public function getRequestsToApprove(){
        //return an array of all pending requests
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getJustifiedRequests();
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function approveRequest($requestID,$CAOComment){
        $requestController = new RequestController();
        $requestController->approveRequest($requestID,$CAOComment,$this->empID);
    }

    public function denyRequest($requestID,$CAOComment){
        $requestController = new RequestController();
        $requestController->denyRequest($requestID,$CAOComment,$this->empID,$this->position);
    }

    public function getApprovals(){
        //return an array of all requests, approved by this CAO
    }

    public function getDeniedRequests(){
        //return an array of all requests, denied by this CAO
    }

    //IRequestable
    public function placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose){
        //create new request
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
