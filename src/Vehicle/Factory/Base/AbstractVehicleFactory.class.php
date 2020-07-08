<?php
namespace Vehicle\Factory\Base;

use Vehicle\Vehicle;

abstract class AbstractVehicleFactory
{
    /**
     * Creates a new vehicle
     * 
     * @param array $vehicleInfo
     * @return Vehicle
     */
    abstract public function makeNewVehicle(array $vehicleInfo) : Vehicle;

    /**
     * Creates a vehicle object for a given ID
     * 
     * @param int $vehicleID
     * @return Vehicle
     */
    abstract public function makeVehicle(string $vehicleID) : Vehicle;

    /**
     * Get all the vehicles
     * 
     * @return array(Vehicle)
     */
    abstract public function getVehicles() : array;

    /**
     * Casts a vehicle object to vehicle interface
     * 
     * @param Vehicle $vehicle
     * @return Vehicle
     */
    protected function castToVehicle(Vehicle $vehicle) : Vehicle 
    {
        return $vehicle;
    }
}