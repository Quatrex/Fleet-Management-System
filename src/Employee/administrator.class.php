<?php
namespace Employee;

use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;

class Administrator extends PrivilegedEmployee
{
    function __construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);
    }

    public function getField($field){
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new Administrator($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }
  
    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new Administrator($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $designation, $email, $username, $password){
        $obj = new Administrator($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

       return $obj; //return false, if fail
    }

    public function getAllEmployees(){
        //return an array of all employees (implement sperately for drivers)
    }

    public function createNewAccount(){
        //create a new employee account
    }

    public function updateAccount(){
        //update an existing employee account's details
    }

    public function removeAccount(){
        //delete an employee account
    }
}
