<?php

namespace Vehicle\Factory\PurchasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;

class PurchasedVehicleFactory extends VehicleFactory
{

    private static ?PurchasedVehicleFactory $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): PurchasedVehicleFactory
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
        $vehicle = new PurchasedVehicle($values);
        if ($isNew) $vehicle->saveToDatabase();
        return $this->castToVehicle($vehicle);
    }
}
