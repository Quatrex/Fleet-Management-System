<?php
namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;

class CAO extends Requester
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
    }

    //overide
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new CAO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    //overide
    public static function getObjectByValues(array $values){
        $obj = new CAO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //overide
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){

        $obj = new CAO($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    private function saveToDatabase(){
        parent::saveToDatabase();
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
        //$requestController = new RequestController(); //wrong implementation
        //$requestController->approveRequest($requestID,$CAOComment,$this->empID);
    }

    public function denyRequest($requestID,$CAOComment){
        //$requestController = new RequestController(); //wrong implementation
        //$requestController->denyRequest($requestID,$CAOComment,$this->empID,$this->position);
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
}
