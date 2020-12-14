<?php

namespace Employee\Factory\Privileged;

use DB\Viewer\EmployeeViewer;
use Exception;
use Request\Factory\Base\RealRequest;

class PrivilegedEmployeeFactory
{
    /**
     * Make an employee object for a given ID
     * 
     * @param string $empID
     * 
     * @return mixed
     */
    public static function makeEmployee(string $empID)
    {
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $employeeViewer->getRecordByID($empID);
        $values['Password'] = null;

        $employee = self::createConcreteEmployee($values);

        // if (self::checkAccess()) $employee = self::castToEmployee($employee);
        return $employee;
    }

    /**
     * Make a new employee object
     * 
     * @param array $values
     * 
     * @return PrivilegedEmployee
     */
    public static function makeNewEmployee(array $values): PrivilegedEmployee
    {
        if (!self::checkAccess()) throw new Exception('Illegel Access');

        $values['ProfilePicturePath'] = '';
        $values['Password']=password_hash(self::generateRandomPassword(), PASSWORD_BCRYPT);
        $employee = self::createConcreteEmployee($values);
        $employee->saveToDatabase();
        return self::castToEmployee($employee);
    }

    /**
     * Make an employee object for given values
     * 
     * @param array(string) $values
     * 
     * @return PrivilegedEmployee
     */
    public static function makeEmployeeByValues(array $values): PrivilegedEmployee
    {
        if (!self::checkAccess()) throw new Exception('Illegel Access');

        $values['Password'] = null;

        $employee = self::createConcreteEmployee($values);

        // if (self::checkAccess()) $employee = self::castToEmployee($employee);
        return self::castToEmployee($employee);
    }

    /**
     * Make an array of all the employee objects
     * 
     * @param string $position @default = all
     * 
     * @return array(PrivilegedEmployee)
     */
    public static function makeEmployees(int $offset, string $position = '', array $sort, array $search): array
    {
        if (!self::checkAccess()) throw new Exception('Illegel Access');

        $position = strtolower($position);
        $validPositonNames = ['', 'requester', 'jo', 'cao', 'vpmo', 'admin', 'dcao'];
        $position = strtolower($position);
        if (!in_array($position, $validPositonNames)) {
            echo 'Invalid Position Paramter'; // TODO: throw exception
        }

        $employeeViewer = new EmployeeViewer();
        $employeeRecords = $position === '' ? $employeeViewer->getAllEmployees($offset, $sort, $search) :
            $employeeViewer->getEmployeesByPosition($position, $offset, $sort, $search);;

        $employees = [];
        foreach ($employeeRecords as $record) {
            $record['Password'] = null;
            $employee = self::createConcreteEmployee($record);
            array_push($employees, self::castToEmployee($employee));
        }
        return $employees;
    }

    /**
     * Casts an object to Employee type
     * 
     * @param PrivilegedEmployee $employee
     * 
     * @return PrivilegedEmployee
     */
    private static function castToEmployee(PrivilegedEmployee $employee): PrivilegedEmployee
    {
        return $employee;
    }

    private static function checkAccess(): bool
    {
        $accessibleClasses = [Administrator::class, RealRequest::class];
        $trace1 = debug_backtrace();
        if (array_key_exists(2, $trace1)) {
            $trace2 = debug_backtrace()[2];
            if (array_key_exists('class', $trace2)) {
                $class = $trace2['class'];
                return in_array($class, $accessibleClasses);
            }
        }
        return false;
    }

    private static function createConcreteEmployee(array $values)
    {
        $values['Position'] = strtolower($values['Position']);
        switch ($values['Position']) {
            case 'requester':
                return new Requester($values);
            case 'jo':
                return new JO($values);
            case 'cao':
                return new CAO($values);
            case 'dcao':
                return new CAO($values);
            case 'vpmo':
                return new VPMO($values);
            case 'admin':
                return new Administrator($values);
            default:
                throw new Exception('Invalid Position Parameter'); // TODO: throw excpetion
        }
    }

    private static function generateRandomPassword()
    {
        $len = 8;

        $sets = array();
        $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        $sets[] = '123456789';
        $sets[] = '!@#$%^&*';

        $password = '';

        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
        }

        while (strlen($password) < $len) {
            $randomSet = $sets[array_rand($sets)];
            $password .= $randomSet[array_rand(str_split($randomSet))];
        }

        return str_shuffle($password);
    }
}
