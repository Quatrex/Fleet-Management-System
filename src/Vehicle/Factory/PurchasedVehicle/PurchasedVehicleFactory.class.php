<?php

namespace Vehicle\Factory\PurchasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;

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
    protected function createVehicle(array $values = [], string $registrationNo = '') : Vehicle
    {
        if (empty($values)) 
        {
            $vehicleViewer = new VehicleViewer();
            $values = $vehicleViewer->getRecordByID($registrationNo, false); 
            $vehicle = new PurchasedVehicle($values);
        } else 
        {
            $vehicle = new PurchasedVehicle($values);
        }
        
        $vehicle->saveToDatabase();
        return $this->castToVehicle($vehicle);
    }
}
