<?php
namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
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

        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], $values['Password']);
        
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

    public function justifyRequest($requestID,$JOComment){
        //$requestController = new RequestController(); //wrong implementation
        //$requestController->justifyRequest($requestID,$JOComment,$this->empID);
    }

    public function denyRequest($requestID,$JOComment){
        //$requestController = new RequestController(); //wrong implementation
        //$requestController->denyRequest($requestID,$JOComment,$this->empID,$this->position);
    }

    public function getMyJustifiedRequests(){
        //return an array of all requests, justified by this JO
    }

    public function getDeniedRequests(){
        //return an array of all requests, denied by this JO
    }
}