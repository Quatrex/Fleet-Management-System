<?php

namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use DB\Viewer\DriverViewer;
use Request\Factory\Base\RealRequest;
use Vehicle\Factory\Base\AbstractVehicleFactory;
use Vehicle\Factory\LeasedVehicle\LeasedVehicle;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicle;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;


class VPMO extends Requester
{
    private AbstractVehicleFactory $leasedVehicleFactory;
    private AbstractVehicleFactory $purchasedVehicleFactory;

    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
    }

    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($empID, $firstName, $lastName, $position, $email, $username, $password){

        $obj = new VPMO($empID, $firstName, $lastName, $position, $email, $username, $password);

        $obj->saveToDatabase(); //check for failure

        return $obj; //return false, if fail
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
        $leasedVehicleFactory = LeasedVehicleFactory::getInstance();
        $leasedVehicles = $leasedVehicleFactory->getVehicles();
        $purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
        $purchasedVehicles = $purchasedVehicleFactory->getVehicles();
        return array_merge($purchasedVehicles,$leasedVehicles);
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
            $driver = Driver::getObjectByValues($values);
            array_push($drivers, $driver);
        }
        return $drivers;
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
        $purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
        $vehicle = $purchasedVehicleFactory->makeNewVehicle($vehicleInfo);
    }

    /**
     *
     * Adding a new purchased vehicle to database
     *
     * @param $registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment
     * @return void
     *
     */
    public function addLeasedVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        $vehicleInfo = array($registrationNo,$model,$purchasedYear,$value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
        $leasedVehicleFactory = LeasedVehicleFactory::getInstance();
        $vehicle = $leasedVehicleFactory->makeNewVehicle($vehicleInfo);
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
        $vehicle = PurchasedVehicle::getObject($registrationNo);
        $vehicle->updateInfo($model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany);
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateLeasedVehicleInfo($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        $vehicle = LeasedVehicle::getObject($registrationNo);
        $vehicle->updateInfo($model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
    }

    /**
     *
     * Delete vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    // public function deleteVehicle($registrationNo)
    // {
    //     Vehicle::deleteVehicle($registrationNo);
    // }
    public function placeRequest($dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $purpose)
    {
        $request = RealRequest::constructObject($dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $this->empID, $purpose);
        //$request->notifyJOs(); //change: notify JOs when the state change occurs
    }
}
