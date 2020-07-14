<?php

namespace Employee\Factory\Privileged;

use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;

class Administrator extends PrivilegedEmployee
{
    public function getAllEmployees()
    {
        //return an array of all employees (implement sperately for drivers)
    }

    public function createNewAccount(array $values): PrivilegedEmployee
    {
        $employee = PrivilegedEmployeeFactory::makeNewEmployee($values);
        return $employee;
    }

    public function updateAccount(array $values): PrivilegedEmployee
    {
        $employee = PrivilegedEmployeeFactory::makeEmployee($values['PrevEmpID']);
        $employee->updateInfo($values);
        return $employee;
    }

    public function removeAccount(string $empID)
    {
        $employee = PrivilegedEmployeeFactory::makeEmployee($empID);
        $employee->delete();
    }
}
