<?php
namespace Employee\Factory\Driver;

use DB\Viewer\DriverViewer;
use Employee\State\Driver\State;

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
        $driver = new Driver($values);
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
        return new Driver($values);
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
            $driver = new Driver($values);
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
        return new Driver($values);
    }
}