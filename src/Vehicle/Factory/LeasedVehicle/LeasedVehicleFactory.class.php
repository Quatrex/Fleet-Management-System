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
    public function makeVehicle(string $vehicleID) : Vehicle
    {
        return $this->castToVehicle(LeasedVehicle::getObject($vehicleID));
    }

    /**
     * @inheritDoc
     */
    public function getVehicles() : array
    {
        $vehicleViewer = new VehicleViewer();
        $vehicleIDs = $vehicleViewer->getAllRecords('leased');
        $vehicles = array();
        foreach ($vehicleIDs as $values) {
            $vehicle = new LeasedVehicle($values['RegistrationNo'], 
                                        $values['Model'], 
                                        $values['PurchasedYear'], 
                                        $values['Value'], 
                                        $values['FuelType'], 
                                        $values['InsuranceValue'], 
                                        $values['InsuranceCompany'], 
                                        $values['State'],
                                        $values['CurrentLocation'],
                                        $values['LeasedCompany'], 
                                        $values['LeasedPeriodFrom'], 
                                        $values['LeasedPeriodTo'],
                                        $values['MonthlyPayment'],);
            array_push($vehicles, $this->castToVehicle($vehicle));
        }
        return $vehicles;
    }

    /**
     * @inheritDoc
     */
    public function makeVehicleByValues(array $vehicleInfo) : Vehicle
    {
        return $this->castToVehicle(LeasedVehicle::getObjectByValues($vehicleInfo));
    }
}