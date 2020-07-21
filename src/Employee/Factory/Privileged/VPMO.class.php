<?php

namespace Employee\Factory\Privileged;

use Request\Request;
use Vehicle\Vehicle;
use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;
use Employee\Factory\Driver\DriverFactory;
use Report\VehicleHandoutSlip;
use Request\Factory\VPMORequest\VPMORequestFactory;


class VPMO extends Requester
{
    private VehicleFactory $leasedVehicleFactory;
    private VehicleFactory $purchasedVehicleFactory;

    function __construct($values)
    {
        parent::__construct($values);
        $this->leasedVehicleFactory = LeasedVehicleFactory::getInstance();
        $this->purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
    }

    /**
     *
     * Returns all requests with the given state
     * 
     * @param string $state 'approve', 'scheduled' or 'completed'
     *
     * @return array{Request}
     */
    public function getRequests(string $state): array
    {
        return VPMORequestFactory::makeRequests($state);
    }

    /**
     *
     * Returns all the vehicles
     *
     * @return array(Vehicle)
     *
     */
    public function getVehicles()
    {
        $leasedVehicles = $this->leasedVehicleFactory->makeVehicles();
        $purchasedVehicles = $this->purchasedVehicleFactory->makeVehicles();
        return array_merge($purchasedVehicles, $leasedVehicles);
    }

    /**
     *
     * Returns all the drivers
     *
     * @return array(Driver)
     *
     */
    public function getDrivers()
    {
        return DriverFactory::makeDrivers();
    }

    /**
     *
     * change a request's state from approved to schedule
     *
     * @param $requestID,
     * @param $driver,
     * @param $vehicle
     * @return void
     *
     */
    public function scheduleRequest($requestID, $driverID, $vehicleID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->schedule($this->empID, $driverID, $vehicleID);
        $driver = DriverFactory::makeDriver($driverID);
        $driver->allocate();
        $vehicle = VehicleFactory::getVehicle($vehicleID);
        $vehicle->allocate();
    }

    /**
     *
     * change a request's state from scheduled to completed
     *
     * @param $requestID,$driver,$vehicle
     * @return void
     *
     */
    public function closeRequest($requestID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->close();
    }

    /**
     *
     * change a request's state from scheduled to completed
     *
     * @param $requestID,$driver,$vehicle
     * @return void
     *
     */
    public function cancelRequest($requestID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->cancel();
    }

    /**
     *
     * Adding a new leased vehicle to database
     *
     * @param $registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany
     * @return void
     *
     */

    public function addPurchasedVehicle($values)
    {
        $vehicle = $this->purchasedVehicleFactory->makeNewVehicle($values);
        return $vehicle;
    }

    /**
     *
     * Adding a new purchased vehicle to database
     *
     * @param $registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment
     * @return void
     *
     */
    public function addLeasedVehicle($values)
    {
        $vehicle = $this->leasedVehicleFactory->makeNewVehicle($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updatePurchasedVehicleInfo($values)
    {
        $vehicle = $this->purchasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        $vehicle->updateInfo($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateLeasedVehicleInfo($values)
    {
        $vehicle = $this->leasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        $vehicle->updateInfo($values);
        return $vehicle;
    }

    /**
     *
     * Delete purchased vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    public function deletePurchasedVehicle($registrationNo)
    {
        $vehicle = $this->purchasedVehicleFactory->makeVehicle($registrationNo);
        $vehicle->delete();
    }

    /**
     *
     * Delete leased vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    public function deleteLeasedVehicle($registrationNo)
    {
        $vehicle = $this->leasedVehicleFactory->makeVehicle($registrationNo);
        $vehicle->delete();
    }

    /**
     *
     * Generate vehicle hand-out slip.
     *
     * @param requestID
     *
     */
    public function generateVehicleHandoutSlip(int $requestID) : void
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $vehicleHandoutSlip = $request->generateVehicleHandoutSlip();
        $vehicleHandoutSlip->print();
    }
}
