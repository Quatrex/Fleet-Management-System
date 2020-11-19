<?php
namespace Vehicle\Factory\LeasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;

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
    protected function createVehicle(array $values = [], string $registrationNo = '') : Vehicle
    {
        if (empty($values)) 
        {
            $vehicleViewer = new VehicleViewer();
            $values = $vehicleViewer->getRecordByID($registrationNo, true); 
            $vehicle = new LeasedVehicle($values);
        } else 
        {
            $vehicle = new LeasedVehicle($values);
            $vehicle->saveToDatabase();
        }
        return $this->castToVehicle($vehicle);
    }
}