<?php
namespace Employee;

use DB\IObjectHandle;
use Request\Request;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;
use Request\Factory\RequesterRequestFactory\RequesterRequestFactory;

// use Request as Request;
class Requester extends PrivilegedEmployee implements IObjectHandle
{
    //IObjectHandle
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

        $obj = new Requester($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }
  
    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new JO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){
        $obj = new Requester($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

       return $obj; //return false, if fail
    }

    //IObjectHandle
    protected function saveToDatabase(){
        $employeeController = new EmployeeController();
        $employeeController->saveRecord($this->empID,
                                    $this->firstName,
                                    $this->lastName,
                                    $this->position,
                                    $this->email,
                                    $this->username,
                                    $this->password);
    }

    public function placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose){
        $request = RequesterRequestFactory::makeRequest($dateOfTrip,
                                                        $timeOfTrip,
                                                        $dropLocation,
                                                        $pickLocation,
                                                        $this->empID,
                                                        $purpose);
    }

    public function getMyRequestsByState(string $state) : array 
    {
        return RequesterRequestFactory::getRequests($this->empID,$state);
        // $requestViewer = new RequestViewer();
        // $requestIDs= $requestViewer->getRequestsByIDNState($this->empID,$state);
        // $requests=array();

        // foreach($requestIDs as $values){
        //     $request= Request::getObjectByValues($values);
        //     array_push($requests,$request);
        // }

        // return $requests;
        }
}