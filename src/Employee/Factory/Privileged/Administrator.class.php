<?php

namespace Employee\Factory\Privileged;

use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use Employee\Factory\Driver\AdminDriverProxy;
use Employee\Factory\Driver\Driver;
use Employee\Factory\Driver\DriverFactory;

class Administrator extends PrivilegedEmployee
{
    public function getAllPriviledgedEmployees( int $offset = 0,
                                                array $sort = ['FirstName' => 'ASC'], 
                                                array $search = ['' => ['All']])
    {
        $employees= PrivilegedEmployeeFactory::makeEmployees($offset,'',$sort,$search);
        return $employees;
    }

    public function getDrivers(  int $offset = 0,
                                    array $sort = ['FirstName' => 'ASC'], 
                                    array $search = ['' => ['All']])
    {
        return DriverFactory::makeDrivers($offset,$sort,$search);
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

    /**
     *
     * update driver's info
     *
     * @param driverID, registrationNo
     * @return VPMODriverProxy
     *
     */
    public function updateDriverInfo(string $driverID, array $values): Driver
    {
        $driver =  DriverFactory::makeDriver($driverID);
        $driver->updateInfo($values);
        return $driver;
    }

    /**
     *
     * update driver's picture
     *
     * @param driverID,imagePath
     * @return VPMODriverProxy
     *
     */
    public function updateDriverPicture(array $values): Driver
    {
        $driver =  DriverFactory::makeDriver($values['DriverId']);
        $driver->updatePicture($values['DriverPicturePath']);
        return $driver;
    }

    public function deleteDriver(string $driverID) : Driver
    {
        $driver = DriverFactory::makeDriver($driverID);
        return $driver;
    }
}
