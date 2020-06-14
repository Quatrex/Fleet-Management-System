<?php
class Requester extends Employee implements IRequestable,IObjectHandle
{
    //private $controller;
    //private $viewer;
    public function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);

        //incluce required viewer and controller classes
        //$this->controller= new Controller();
        //$this->viewer= new Viewer();
        $this->employeeController= new EmployeeController();
        $this->employeeViewer= new EmployeeViewer();

    }

    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer=new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new Requester($values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6]);
        
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
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose){
        //create request object
        //$request= Request::constructObject($date,$time,$dropLocation,$pickLocation,$purpose,$this->empID);
        //$request->notifyJOs();
    }

    //IRequestable
    public function getPendingRequests($requesterID, $status){
        return $this->viewer->getRecords($requesterID, $status);
        // return array();
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