<?php
namespace Employee\Factory\Privileged;

use Employee\Employee;
use DB\Controller\EmployeeController;

abstract class PrivilegedEmployee extends Employee
{
    protected string $empID;
    protected string $position; 
    protected string $username;
    protected ?string $password; //TODO: might need a separate table for username and password
    protected string $designation;

    function __construct($values)
    {
        parent::__construct($values);
        $this->empID = $values['EmpID'];
        $this->position = $values['Position'];
        $this->username = $values['Username'];
        $this->password = $values['Password'];
        $this->designation = $values['Designation'];
    }

    public function getField($field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    //IObjectHandle
    public function saveToDatabase(){
        $employeeController = new EmployeeController();
        $employeeController->saveRecord($this->empID,
                                    $this->firstName,
                                    $this->lastName,
                                    $this->position,
                                    $this->email,
                                    $this->username,
                                    $this->password);
    }    
}
