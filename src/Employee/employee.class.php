<?php
namespace Employee;

abstract class Employee
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;

    public function __construct($values)
    {
        $this->firstName = $values['FirstName'];
        $this->lastName = $values['LastName'];
        $this->email = $values['Email'];
    }

    abstract public function getField($field);
}