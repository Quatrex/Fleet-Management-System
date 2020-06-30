<?php
namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
use DB\Controller\RequestController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;

class JO extends Requester
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

        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    //overide
    public static function getObjectByValues(array $values){
        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //overide
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){

        $obj = new JO($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    public function getMyJustifiedRequestsByState(int $state) : array {
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getJustifiedRequestsByIDNState($this->empID,$state);
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function getRequestsToJustify(){
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getPendingRequests();
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function getPendingRequests(){
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getPendingRequests();
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function justifyRequest($requestID,$JOComment){
        $request=Request::getObject($requestID);
        $request->setJustified($this->empID,$JOComment);
    }

    public function denyRequest($requestID,$JOComment){
        $request=Request::getObject($requestID);
        $request->setDenied($this->empID,$JOComment,$this->position);
    }
}