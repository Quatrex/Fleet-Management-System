<?php
namespace Employee;

use DB\IObjectHandle;

abstract class Employee implements IObjectHandle
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;

    function __construct($firstName, $lastName, $email)
    {
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->email=$email;
    }

    abstract public function getField($field);
}