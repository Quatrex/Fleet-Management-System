<?php
namespace Employee;

use DB\Controller\EmployeeController;

abstract class PrivilegedEmployee extends Employee
{
    protected string $empID;
    protected string $position; 
    protected string $username;
    protected string $password; //TODO: might need a separate table for username and password

    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($firstName,$lastName,$email);
        $this->empID=$empID;
        $this->position=$position;
        $this->username=$username;
        $this->password=$password;
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

    
}
