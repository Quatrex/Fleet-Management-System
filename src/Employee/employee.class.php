<?php

namespace Employee;

abstract class Employee
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected ?string $profilePicturePath;

    public function __construct($values)
    {
        $this->firstName = $values['FirstName'];
        $this->lastName = $values['LastName'];
        $this->email = $values['Email'];
        $this->profilePicturePath = $values['ProfilePicturePath'];
    }

    abstract public function getField($field);
}
