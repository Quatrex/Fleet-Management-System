<?php
namespace Vehicle\Factory\LeasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;

class LeasedVehicleFactory extends VehicleFactory 
{
    private static ?LeasedVehicleFactory $instance = null;

    private function __construct() {}

    public static function getInstance() : LeasedVehicleFactory 
    {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    protected function createVehicle(array $values, bool $isNew = false) : Vehicle
    {
        
        $vehicle = new LeasedVehicle($values);
        if ($isNew) $vehicle->saveToDatabase();
        return $this->castToVehicle($vehicle);
    }
}