<?php

namespace Employee\Factory\Privileged;

use Employee\Employee;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use JsonSerializable;


abstract class PrivilegedEmployee extends Employee implements JsonSerializable
{
    protected string $empID;
    protected string $position;
    protected string $designation;
    protected ?string $password; 

    function __construct($values)
    {
        parent::__construct($values);
        $this->empID = $values['EmpID'];
        $this->position = $values['Position'];
        $this->designation = $values['Designation'];
        $this->password = $values['Password'];
    }
    public function jsonSerialize()
    {
        return [
            'empID' => $this->empID,
            'FirstName' => $this->firstName,
            'LastName' => $this->lastName,
            'Designation' => $this->designation,
            'Position' => $this->position,
            'Email' => $this->email,
            'ProfilePicturePath' => $this->profilePicturePath
        ];
    }

    public function updateInfo(array $values): void
    {
        //changed employee attributes can be analysed here

        $this->empID = $values['NewEmpID'];
        $this->firstName = $values['FirstName'];
        $this->lastName = $values['LastName'];
        $this->position = $values['Position'];
        $this->designation = $values['Designation'];
        $this->email = $values['Email'];

        $employeeController = new EmployeeController();
        $employeeController->updateEmployeeInfo(
            $this->empID,
            $values['EmpID'],
            $this->firstName,
            $this->lastName,
            $this->position,
            $this->designation,
            $this->email
        );
    }

    public function updatePassword(array $values): void
    {
        //$values should include 'OldPassword', 'NewPassword'

        $employeeController = new EmployeeController();
        if ($this->verifyPassword($values['OldPassword'])) {
            $employeeController->updateEmployeePassword(
                $this->empID,
                $values['NewPassword']
            );
        }
    }

    public function verifyPassword(string $password): bool
    {
        $employeeViewer = new EmployeeViewer();
        return $employeeViewer->checkPasswordByID($this->empID, $password);
    }

    public function updateProfilePicture(array $values): void
    {

        $this->profilePicturePath = $values['ProfilePicturePath'];
        $employeeController = new EmployeeController();
        $employeeController->updateEmployeeProfilePicture(
            $this->empID,
            $this->profilePicturePath
        );
    }

    public function delete(): void
    {
        $employeeController = new EmployeeController();
        $employeeController->deleteEmployee($this->empID);
    }

    public function getField($field)
    {
        if (property_exists($this, $field)) {
            return $this->$field;
        }
        return null;
    }

    //IObjectHandle
    public function saveToDatabase()
    {
        $employeeController = new EmployeeController();
        $employeeController->saveRecord(
            $this->empID,
            $this->firstName,
            $this->lastName,
            $this->position,
            $this->designation,
            $this->email,
            $this->password,
            $this->profilePicturePath
        );
    }
}
