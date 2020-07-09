<?php
namespace Employee;

use DB\IObjectHandle;
use Request\Request;
use DB\Controller\EmployeeController;
use DB\Controller\RequestController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;
use Request\Factory\RequesterRequest\RequesterRequestFactory;
use JsonSerializable;


// use Request as Request;
class Requester extends PrivilegedEmployee implements JsonSerializable
{
    public function __construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $designation,  $email, $username, $password);
    }

    public function jsonSerialize()
    {
        return ['empID'=>$this->getField('empID'),
                'FirstName'=> $this->getField('firstName'),
                'LastName'=> $this->getField('lastName'),
                'Position'=>$this->getField('position'),
            ];
    }
    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new Requester($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }
  
    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new Requester($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $designation, $email, $username, $password){
        $obj = new Requester($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

       return $obj; //return false, if fail
    }

    

    public function placeRequest($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose){
        $request = RequesterRequestFactory::makeRequest($dateOfTrip,
                                                        $timeOfTrip,
                                                        $dropLocation,
                                                        $pickLocation,
                                                        $this->empID,
                                                        $purpose);
    }

    public function cancelRequest($requestID){
        $request = RequesterRequestFactory::getrequest($requestID);
        $request->cancel();
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