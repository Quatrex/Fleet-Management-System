<?php
namespace Vehicle\Factory\PurchasedVehicle;

use Vehicle\Factory\Base\AbstractVehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;

class PurchasedVehicleFactory extends AbstractVehicleFactory 
{

    private static ?PurchasedVehicleFactory $instance = null;

    private function __construct() {}

    public static function getInstance() : PurchasedVehicleFactory 
    {
        if (PurchasedVehicleFactory::$instance == null)
            PurchasedVehicleFactory::$instance = new PurchasedVehicleFactory();
        return PurchasedVehicleFactory::$instance;
    }
    
    /**
     * @inheritDoc
     */
    public function makeNewVehicle(array $vehicleInfo) : Vehicle
    {
        return $this->castToVehicle(PurchasedVehicle::constructObject($vehicleInfo));
    }

    /**
     * @inheritDoc
     */
    public function makeVehicle(string $vehicleID) : Vehicle
    {
        return $this->castToVehicle(PurchasedVehicle::getObject($vehicleID));
    }

    /**
     * @inheritDoc
     */
    public function getVehicles() : array
    {
        $vehicleViewer = new VehicleViewer();
        $vehicleIDs = $vehicleViewer->getAllRecords('purchased');
        $vehicles = array();
        foreach ($vehicleIDs as $values) {
            $vehicle = new PurchasedVehicle($values['RegistrationNo'], 
                                            $values['Model'], 
                                            $values['PurchasedYear'], 
                                            $values['Value'], 
                                            $values['FuelType'], 
                                            $values['InsuranceValue'], 
                                            $values['InsuranceCompany'], 
                                            $values['State'],
                                            $values['CurrentLocation']);
            array_push($vehicles, $this->castToVehicle($vehicle));
        }
        return $vehicles;
    }

}