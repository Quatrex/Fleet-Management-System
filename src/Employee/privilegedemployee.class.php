<?php
namespace Employee;

abstract class PrivilegedEmployee extends Employee
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

    public function getField($field){
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }
}
