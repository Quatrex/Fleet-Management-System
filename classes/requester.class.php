<?php
class Requester extends Employee implements IRequestable,IObjectHandle
{
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

        $obj = new Requester($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], $values['Password']);
        
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
    public function getMyPendingRequests(){
        $requestViewer = new RequestViewer();
        $requestIDs= $requestViewer->getPendingRequestsByID($this->empID);
        $requests=array();

        foreach($requestIDs as $key => $requestID){
            if (is_numeric($requestID['RequestID'])) {
                $request=Request::getObject($requestID['RequestID']);
                array_push($requests,$request);
            } else {
                break;
            }
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