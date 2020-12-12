<?php

namespace Employee;

abstract class Employee
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected ?string $profilePicturePath;
    protected ?string $contactNumber;

    public function __construct($values)
    {
        $this->firstName = $values['FirstName'];
        $this->lastName = $values['LastName'];
        $this->email = $values['Email'];
        $this->profilePicturePath = $values['ProfilePicturePath'];
        $this->contactNumber=$values['ContactNumber'];
    }

    abstract public function getField($field);
}
