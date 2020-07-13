<?php
namespace Vehicle\Factory\PurchasedVehicle;

use db\Controller\VehicleController;
use JsonSerializable;
use Vehicle\Factory\Base\AbstractVehicle;
use Vehicle\State\State;

class PurchasedVehicle extends AbstractVehicle implements JsonSerializable
{
    public function __construct($values)
    {
        parent::__construct($values);
    }

    public function getField(string $field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    public function jsonSerialize()
    {
        return [
            'registration' => $this->registrationNo,
            'model' => $this->model,
            'purchasedYear' => $this->purchasedYear,
            'value' => $this->value,
            'fuelType' => $this->fuelType,
            'insuranceValue' => $this->insuranceValue,
            'insuranceCompany'=>$this->insuranceCompany,
            'state' => State::getStateString($this->state->getID()),
            'currentLocation' => $this->currentLocation];
    }

    //IObjectHandle
    public function saveToDatabase() : void{
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

    public function updateInfo(array $vehicleInfo) : void{
        //changed vehicle attributes can be analysed here

        $vehicleController = new VehicleController();
        $vehicleController->updatePurchasedVehicleInfo($this->registrationNo, 
                                                        $vehicleInfo[0], 
                                                        $vehicleInfo[1], 
                                                        $vehicleInfo[2], 
                                                        $vehicleInfo[3], 
                                                        $vehicleInfo[4], 
                                                        $vehicleInfo[5]);
    }
}