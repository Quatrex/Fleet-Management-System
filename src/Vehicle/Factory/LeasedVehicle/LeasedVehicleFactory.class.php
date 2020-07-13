<?php
namespace Vehicle\Factory\LeasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use Vehicle\State\State;

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
        $values['State'] = State::getStateID('available');
        $values['CurrentLocation'] = '';
        $vehicle = new LeasedVehicle($values);
        $vehicle->saveToDatabase(); //check for failure
        return $this->castToVehicle($vehicle);
    }

    /**
     * @inheritDoc
     */
    public function makeVehicle(string $registrationNo) : Vehicle
    {
        //get values from database
        $vehicleViewer = new VehicleViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $vehicleViewer->getRecordByID($registrationNo, true);
        return $this->castToVehicle(new LeasedVehicle($values));
    }

    /**
     * @inheritDoc
     */
    public function makeVehicles() : array
    {
        $vehicleViewer = new VehicleViewer();
        $vehicleIDs = $vehicleViewer->getAllRecords('leased');
        $vehicles = array();
        foreach ($vehicleIDs as $values) {
            $vehicle = new LeasedVehicle($values);
            array_push($vehicles, $this->castToVehicle($vehicle));
        }
        return $vehicles;
    }

    /**
     * @inheritDoc
     */
    public function makeVehicleByValues(array $values) : Vehicle
    {
        return $this->castToVehicle(new LeasedVehicle($values));
    }
}