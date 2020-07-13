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
        $leasedVehicles = $this->leasedVehicleFactory->getVehicles();
        $purchasedVehicles = $this->purchasedVehicleFactory->getVehicles();
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
    
    public function addPurchasedVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany)
    {
        $vehicleInfo = array($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
        $vehicle = $this->purchasedVehicleFactory->makeNewVehicle($vehicleInfo);
    }

    /**
     *
     * Adding a new purchased vehicle to database
     *
     * @param $registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment
     * @return void
     *
     */
    public function addLeasedVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        $vehicleInfo = array($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
        $vehicle = $this->leasedVehicleFactory->makeNewVehicle($vehicleInfo);
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updatePurchasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany)
    {
        $vehicle = $this->purchasedVehicleFactory->makeVehicle($registrationNo);
        $vehicleInfo = array($model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
        $vehicle->updateInfo($vehicleInfo);
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateLeasedVehicleInfo($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        $vehicle = $this->leasedVehicleFactory->makeVehicle($registrationNo); 
        $vehicleInfo = array($model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
        $vehicle->updateInfo($vehicleInfo);
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
