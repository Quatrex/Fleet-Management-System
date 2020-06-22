<?php
namespace Employee;

abstract class Employee
{
    protected string $empID;
    protected string $firstName;
    protected string $lastName;
    protected string $position;
    protected string $email;
    protected string $username; //recheck way of keeping login info (for security purposes)
    protected string $password; //recheck way of keeping login info (for security purposes)

    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        $this->empID=$empID;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->position=$position;
        $this->email=$email;
        $this->username=$username;
        $this->password=$password;
    }

    public static function getAllEmployeeDetails(){
        //return an array of employee details (implement separately for driver and other employees)
    }

    public function getFullName() {
        return $this ->firstName . " " . $this ->lastName;
    }

    public function getEmail() {
        return $this ->email;
    }
}
