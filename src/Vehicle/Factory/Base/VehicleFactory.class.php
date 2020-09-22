<?php
namespace Vehicle\Factory\Base;

use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;
use Vehicle\State\State;

abstract class VehicleFactory
{
    /**
     * Creates a new vehicle
     * 
     * @param array $vehicleInfo
     * @return Vehicle
     */
    public function makeNewVehicle(array $values) : Vehicle
    {
        $values['State'] = State::getStateID('available');
        $values['CurrentLocation'] = '';
        $values['AssignedOfficer'] = null;
        $values['NumOfAllocations'] = 0;
        $vehicle = $this->createVehicle($values);
        return $this->castToVehicle($vehicle);
    }

    /**
     * Creates a vehicle object for a given ID
     * 
     * @param int $vehicleID
     * @return Vehicle
     */
    public function makeVehicle(string $registrationNo) : Vehicle
    {
        $vehicle = $this->createVehicle([],$registrationNo);
        return $vehicle;
    }

    /**
     * Create a vehicle object for given values
     * 
     * @param array $vehicleInfo
     * @return Vehicle
     */
    public function makeVehicleByValues(array $values) : Vehicle
    {
        $vehicle = $this->createVehicle($values);
        return $vehicle;
    }

    /**
     * Factory method to create a concrete vehicle object
     * 
     * @param array $values
     * @param bool $isNew If creating a new vehicle object
     * 
     * @return Vehicle
     */
    abstract protected function createVehicle(array $values = [], string $registrationNo = '') : Vehicle;

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

    /**
     * Get either purchased or leased vehicle object for a given registration number.
     * 
     * @param string $registrationNo
     * 
     * @return Vehicle
     */
    public static function getVehicle(string $registrationNo) : Vehicle 
    {
        $vehicleViewer = new VehicleViewer();
        $isLeased = $vehicleViewer->isLeasedVehicle($registrationNo);
        if ($isLeased)
        {
            $leasedVehicleFactory = LeasedVehicleFactory::getInstance();
            return $leasedVehicleFactory->makeVehicle($registrationNo);
        }
        else
        {
            $purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
            return $purchasedVehicleFactory->makeVehicle($registrationNo);
        }
    }

     /**
     * Get all the vehicles
     * 
     * @return array(Vehicle)
     */
    public static function getVehicles(int $offset, array $sort, array $search, bool $isAvailable) : array
    {
        $vehicleViewer = new VehicleViewer();
        $states = $isAvailable ? [State::getStateID('available'), State::getStateID('allocated')] : [];
        $vehicleRecords = $vehicleViewer->getAllRecords($offset, $sort, $search, $states); 
        $vehicles = [];

        foreach ($vehicleRecords as $rec)
        {
            if($rec['IsLeased'])
            {
                $leasedVehicleFactory = LeasedVehicleFactory::getInstance();
                $vehicles[] = $leasedVehicleFactory->makeVehicleByValues($rec);
            } else {
                $purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
                $vehicles[] = $purchasedVehicleFactory->makeVehicleByValues($rec);
            }
        }

        return $vehicles;
    }
}