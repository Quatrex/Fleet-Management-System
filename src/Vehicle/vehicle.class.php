<?php

namespace Vehicle;

use DB\Viewer\VehicleViewer;
use DB\Controller\VehicleController;

abstract class Vehicle
{
    //check the types of the variables
    public string $registrationNo;
    public string $model;
    public int $purchasedYear;
    public string $value;
    public string $fuelType;
    public int $insuranceValue;
    public string $insuranceCompany;
    public bool $inRepair;
    public string $currentLocation;

    //  setState(State):
    //  getTrips(String): array
    //  allocate()
    //  deallocate()
    
    

    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $inRepair, $currentLocation)
    {
        //initialize state
        $this->registrationNo = $registrationNo;
        $this->model = $model;
        $this->purchasedYear = $purchasedYear;
        $this->value = $value;
        $this->fuelType = $fuelType;
        $this->insuranceValue = $insuranceValue;
        $this->insuranceCompany = $insuranceCompany;
        $this->inRepair = $inRepair;
        $this->currentLocation = ($currentLocation != null) ? $currentLocation : '';
    }

    //IObjectHandle
    public static function getObject($registrationNo)
    {
        //get values from database
        $vehicleViewer = new VehicleViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $vehicleViewer->getRecordByID($registrationNo);
        $obj = new Vehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['InRepair'], $values['CurrentLocation']);
        return $obj;
    }

    public static function constructObject($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation)
    {
        $obj = new Vehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$inRepair,$currentLocation);
        $obj->saveToDatabase(); //check for failure
        return $obj; //return false, if fail
    }

    public static function deleteVehicle($registrationNo){
        $vehicleController = new VehicleController();
        $vehicleController->updateRecord($registrationNo,array("Status"=>"Delete"));
    }

    public static function updateVehicle($registrationNo,$fields){
        $vehicleController = new VehicleController();
        $vehicleController->updateRecord($registrationNo,$fields);
    }
    
    private function saveToDatabase()
    {
        $vehicleController = new VehicleController();
        $vehicleController->saveRecord($this->registrationNo, $this->model, $this->purchasedYear, $this->value, $this->fuelType, $this->insuranceValue, $this->insuranceCompany, $this->inRepair, $this->currentLocation);
    }
}
