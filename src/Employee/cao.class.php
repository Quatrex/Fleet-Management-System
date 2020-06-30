<?php
namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use DB\Controller\RequestController;
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

    public function getMyApprovedRequestsByState(string $state) : array {
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getApprovedRequestsByIDNState($this->empID,$state);
        $requests=array();

        foreach($requestIDs as $values){
            $request= Request::getObjectByValues($values);
            array_push($requests,$request);
        }

        return $requests;
    }

    public function getJustifiedRequests(){
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
        $request=Request::getObject($requestID);
        $request->setApproved($this->empID,$CAOComment);
    }

    public function denyRequest($requestID,$CAOComment){
        $request=Request::getObject($requestID);
        $request->setDenied($this->empID,$CAOComment,$this->position);
    }

}
