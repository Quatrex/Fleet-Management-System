<?php
namespace Employee;

use DB\Viewer\EmployeeViewer;
use Request\Factory\JORequest\JORequestFactory;

class JO extends Requester
{
    function __construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);
    }

    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $designation, $email, $username, $password){

        $obj = new JO($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    public function getMyJustifiedRequestsByState(string $state) : array {
        return JORequestFactory::makeJustifiedRequests($this->empID,$state);
    }

    public function getPendingRequests(){
        return JORequestFactory::makePendingRequests();
    }

    public function justifyRequest($requestID,$JOComment){
        $request = JORequestFactory::makeRequest($requestID);
        $request->setJustify(true,$this->empID,$JOComment,$this->position);
    }

    public function denyRequest($requestID,$JOComment){
        $request = JORequestFactory::makeRequest($requestID);
        $request->setJustify(false,$this->empID,$JOComment,$this->position);
    }
}