<?php

namespace Employee;

use Request\Request;
use DB\Viewer\EmployeeViewer;
use Vehicle\Vehicle;
use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;
use Employee\Driver\Factory\DriverFactory;
use Request\Factory\VPMORequest\VPMORequestFactory;


class VPMO extends Requester
{
    private VehicleFactory $leasedVehicleFactory;
    private VehicleFactory $purchasedVehicleFactory;

    function __construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);
        $this->leasedVehicleFactory = LeasedVehicleFactory::getInstance();
        $this->purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
    }

    //IObjectHandle
    public static function getObject($ID)
    {
        $empID = $ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $employeeViewer->getRecordByID($empID);

        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");

        return $obj; //return false, if fail
    }

    //IObjectHandle
    public static function getObjectByValues(array $values)
    {
        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Designation'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $designation, $email, $username, $password)
    {

        $obj = new VPMO($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
    }

    /**
     *
     * Returns all approved requests
     *
     * @return array(Request)
     *
     */
    public function getApprovedRequests()
    {
        return VPMORequestFactory::makeRequests('scheduled');
    }

    /**
     *
     * Returns all scheduled requests
     *
     * @return array(Request)
     *
     */
    public function getScheduledRequests()
    {
        return VPMORequestFactory::makerequests('approved');
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
    public function scheduleRequest($requestID, $driver, $vehicle)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->schedule($this->empID, $driver, $vehicle);
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



}
