<?php

namespace Vehicle\Factory\PurchasedVehicle;

use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use Vehicle\State\State;

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
    public function makeNewVehicle(array $values): Vehicle
    {
        $values['State'] = State::getStateID('available');
        $values['CurrentLocation'] = '';
        $values['AssignedOfficer'] = null;
        $values['numOfAllocations'] = 0;
        $vehicle = new PurchasedVehicle($values);
        $vehicle->saveToDatabase(); //check for failure
        return $this->castToVehicle($vehicle);
    }

    /**
     * @inheritDoc
     */
    public function makeVehicle(string $registrationNo): Vehicle
    {
        $vehicleViewer = new VehicleViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $vehicleViewer->getRecordByID($registrationNo, false);
        return $this->castToVehicle(new PurchasedVehicle($values));
    }

    /**
     * @inheritDoc
     */
    public function makeVehicles(): array
    {
        $vehicleViewer = new VehicleViewer();
        $vehicleIDs = $vehicleViewer->getAllRecords('purchased');
        $vehicles = array();
        foreach ($vehicleIDs as $values) {
            $vehicle = new PurchasedVehicle($values);
            array_push($vehicles, $this->castToVehicle($vehicle));
        }
        return $vehicles;
    }

    /**
     * @inheritDoc
     */
    public function makeVehicleByValues(array $values): Vehicle
    {
        return $this->castToVehicle(new PurchasedVehicle($values));
    }
}
