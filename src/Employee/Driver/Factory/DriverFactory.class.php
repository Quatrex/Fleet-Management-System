<?php
namespace Employee\Driver\Factory;

use DB\Viewer\DriverViewer;

class DriverFactory 
{
    /**
     * Creates a new driver object
     * 
     * @param array $driverInfo
     * @return Driver
     */
    public static function makeNewDriver(array $driverInfo): Driver
    {
        return Driver::constructObject($driverInfo);
    }
    
    /**
     * Creates a driver object for a give ID
     * 
     * @param int $driverID
     * @return Driver
     */
    public static function makeDriver(int $driverID) : Driver
    {
        return Driver::getObject($driverID);
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
            $driver = Driver::getObjectByValues($values);
            array_push($drivers, $driver);
        }
        return $drivers;
    }
}