<?php

namespace Employee;

use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use DB\Viewer\DriverViewer;

class VPMO extends Employee implements IRequestable
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
        //incluce required viewer and controller classes
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
        $vehicleViewer = new VehicleViewer();
        $vehicleIDs = $vehicleViewer->getAllRecords();
        $vehicles = array();
        foreach ($vehicleIDs as $values) {
            $vehicle = new Vehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['InRepair'], $values['CurrentLocation']);
            array_push($vehicles, $vehicle);
        }
        return $vehicles;
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
        $driverViewer = new DriverViewer();
        $driverIDs = $driverViewer->getAllRecords();
        $drivers = array();
        foreach ($driverIDs as $values) {
            $driver = new Driver($values['DriverID'], $values['FirstName'], $values['LastName'], $values['LicenseNumber'], $values['LicenseExpirationDay'], $values['DateOfAdmission'], $values['AssignedVehicleID'], $values['Email']);
            array_push($drivers, $driver);
        }
        return $drivers;
    }
    /**
     *
     * Adding a new vehicle to database
     *
     * @param $registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation
     * @return void
     *
     */
    public function addVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation)
    {
        $vehicle = Vehicle::constructObject($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation);
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateVehicle($registrationNo, $fields)
    {
        Vehicle::updateVehicle($registrationNo, $fields);
    }

    /**
     *
     * Delete vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    public function deleteVehicle($registrationNo)
    {
        Vehicle::deleteVehicle($registrationNo);
    }

    //IRequestable
    public function placeRequest()
    {
        //create new request
    }

    //IRequestable
    public function getPendingRequests()
    {
        //check database for pending requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getCancelledRequests()
    {
        //check database for cancelled requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getApprovedRequests()
    {
        //check database for approved(but trip isn't completed) requests placed by the requester and return an array of requests
    }

    //IRequestable
    public function getOldRequests()
    {
        //check database for all old requests(all requests other than approved and pending requests) placed by the requester and return an array of requests
    }
}
