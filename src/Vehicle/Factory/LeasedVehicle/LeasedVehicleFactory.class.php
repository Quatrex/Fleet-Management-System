<?php
namespace Vehicle\Factory\LeasedVehicle;

use Vehicle\Factory\Base\AbstractVehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;

class LeasedVehicleFactory extends AbstractVehicleFactory 
{
    private static ?LeasedVehicleFactory $instance = null;

    private function __construct() {}

    public static function getInstance() : LeasedVehicleFactory 
    {
        if (LeasedVehicleFactory::$instance == null)
            LeasedVehicleFactory::$instance = new LeasedVehicleFactory();
        return LeasedVehicleFactory::$instance;
    }

    /**
     * @inheritDoc
     */
    public function makeNewVehicle(array $vehicleInfo) : Vehicle
    {
        return $this->castToVehicle(LeasedVehicle::constructObject($vehicleInfo));
    }

    /**
     * @inheritDoc
     */
    public function makeVehicle(int $vehicleID) : Vehicle
    {
        return $this->castToVehicle(LeasedVehicle::getObject($vehicleID));
    }

    /**
     * @inheritDoc
     */
    public function getVehicles() : array
    {
    }

}