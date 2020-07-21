<?php
namespace Employee\Factory\Driver;

use DB\Viewer\DriverViewer;
use Employee\Factory\Privileged\Administrator;
use Employee\Factory\Privileged\VPMO;
use Request\Factory\Base\RealRequest;
use Employee\State\Driver\State;
use Exception;

class DriverFactory 
{
    /**
     * Creates a new driver object
     * 
     * @param array $driverInfo
     * @return Driver
     */
    public static function makeNewDriver(array $values): Driver
    {
        $values['State'] = State::getStateID('available');
        $values['NumOfAllocations']=0;
        $driver = self::createProxy($values);
        $driver->saveToDatabase();

        return $driver;
    }
    
    /**
     * Creates a driver object for a give ID
     * 
     * @param int $driverID
     * @return Driver
     */
    public static function makeDriver(string $empID) : Driver
    {
        $employeeViewer = new DriverViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $employeeViewer->getRecordByID($empID);
        return self::createProxy($values);
    }

    /**
     * Returns all driver objects
     * 
     * @return array(Driver)
     */
    public static function makeDrivers() : array
    {
        $driverViewer = new DriverViewer();
        $driverIDs = $driverViewer->getAllRecords();
        $drivers = array();
        foreach ($driverIDs as $values) {
            $driver = self::createProxy($values);
            array_push($drivers, $driver);
        }
        return $drivers;
    }

    /**
     * Create a vehicle object for given values
     * 
     * @param array $driverInfo
     * @return Driver
     */
    public static function makeDriverByValues(array $values) : Driver
    {
        return self::createProxy($values);
    }

    /**
     * Casts an object to Employee type
     * 
     * @param Driver $employee
     * 
     * @return Driver
     */
    private static function castToDriver(Driver $driver) : Driver
    {
        return $driver;
    }

    private static function createProxy(array $values) : DriverProxy
    {
        $trace1 = debug_backtrace();
        if (array_key_exists(2,$trace1))
        {
            $trace2 = debug_backtrace()[2];
            if (array_key_exists('class',$trace2))
            {
                $class = $trace2['class'];
                switch($class)
                {
                    case Administrator::class:
                        return self::castToDriver(new AdminDriverProxy($values));
                    case VPMO::class:
                        return self::castToDriver(new VPMODriverProxy($values));
                    case RealRequest::class:
                        return self::castToDriver(new DriverProxy($values));
                }
            }
        }
        throw new Exception('Illegel Access');
    }
}