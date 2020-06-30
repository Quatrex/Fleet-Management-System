<?php

namespace Employee;

use Request\Request;
use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;
use Vehicle\Vehicle;
use DB\Viewer\VehicleViewer;
use DB\Viewer\DriverViewer;
use Request\Factory\Type\RealRequest;


class VPMO extends Requester
{
    function __construct($empID, $firstName, $lastName, $position, $email, $username, $password)
    {
        parent::__construct($empID, $firstName, $lastName, $position, $email, $username, $password);
    }

    //overide
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new EmployeeViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        
        return $obj; //return false, if fail
    }

    //overide
    public static function getObjectByValues(array $values){
        $obj = new VPMO($values['EmpID'], $values['FirstName'], $values['LastName'], $values['Position'], $values['Email'], $values['Username'], "");
        return $obj;
    }

    //overide
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
    public function updateVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation)
    {
        Vehicle::updateVehicle($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation);
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
    public function placeRequest($dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $purpose)
    {
        $request = RealRequest::constructObject($dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $this->empID, $purpose);
        //$request->notifyJOs(); //change: notify JOs when the state change occurs
    }
}
