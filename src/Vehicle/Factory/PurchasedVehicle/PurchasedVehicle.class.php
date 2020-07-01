<?php
namespace Vehicle\Factory\PurchasedVehicle;

use db\Controller\VehicleController;
use db\Viewer\VehicleViewer;
use Vehicle\Factory\Base\AbstractVehicle;
use Vehicle\State\State;

class PurchasedVehicle extends AbstractVehicle
{
    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation)
    {
        parent::__construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation);
    }

    public function getField(string $field){ 
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
    public static function constructObject($vehicleInfo)
    {
        $state=State::getState(State::getStateID('available'));//set using an enum
        $currentLocation=""; //attention!
        $obj = new PurchasedVehicle($vehicleInfo[0],$vehicleInfo[1],$vehicleInfo[2], $vehicleInfo[3],$vehicleInfo[4],$vehicleInfo[5],$vehicleInfo[6],$state,$currentLocation);
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
                                    $this->state->getID(),
                                    $this->currentLocation);
    }
}