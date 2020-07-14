<?php

namespace Employee\Factory\Privileged;

use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use Employee\Factory\Driver\DriverFactory;

class Administrator extends PrivilegedEmployee
{
    public function getAllPriviledgedEmployees()
    {
        $employees=PrivilegedEmployeeFactory::makeEmployees();
        return $employees;
    }

    public function getAllDrivers()
    {
        return DriverFactory::makeDrivers();
    }

    public function createNewAccount(array $values): PrivilegedEmployee
    {
        $employee = PrivilegedEmployeeFactory::makeNewEmployee($values);
        return $employee;
    }

    public function createNewDriver(array $values)
    {
        $driver = DriverFactory::makeNewDriver($values);
        return $driver;
    }

    public function updateAccount(array $values): PrivilegedEmployee
    {
        $employee = PrivilegedEmployeeFactory::makeEmployee($values['EmpID']);
        $employee->updateInfo($values);
        return $employee;
    }

    public function removeAccount(string $empID)
    {
        $employee = PrivilegedEmployeeFactory::makeEmployee($empID);
        $employee->delete();
    }
}
