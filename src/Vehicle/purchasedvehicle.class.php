<?php
namespace Vehicle;
use db\Controller\VehicleController;
use db\Viewer\VehicleViewer;

class PurchasedVehicle extends Vehicle
{
    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation)
    {
        parent::__construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation);
    }

    public function getField($field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    //IObjectHandle
    public static function getObject($registrationNo)
    {
        //get values from database
        $vehicleViewer = new VehicleViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $vehicleViewer->getRecordByID($registrationNo);
        $obj = new PurchasedVehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['State'], $values['CurrentLocation']);
        return $obj;
    }

    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new PurchasedVehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['State'], $values['CurrentLocation']);
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany)
    {
        $state=1;//set using an enum
        $currentLocation=""; //attention!
        $obj = new PurchasedVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation);
        $obj->saveToDatabase(); //check for failure
        return $obj; //return false, if fail
    }

    //IObjectHandle
    private function saveToDatabase(){
        $vehicleController = new VehicleController();
        $vehicleController->savePurchasedVehicleRecord($this->registrationNo,
                                    $this->model,
                                    $this->purchasedYear,
                                    $this->value,
                                    $this->fuelType,
                                    $this->insuranceValue,
                                    $this->insuranceCompany,
                                    $this->state,
                                    $this->currentLocation);
    }
}