<?php

namespace Vehicle\Factory\Base;

use DB\IObjectHandle;
use Vehicle\State\State;
use Vehicle\Vehicle;
use db\Controller\VehicleController;


abstract class AbstractVehicle implements IObjectHandle, Vehicle
{
    protected string $registrationNo;
    protected string $model;
    protected string $purchasedYear;
    protected string $value;
    protected string $fuelType;
    protected int $insuranceValue;
    protected string $insuranceCompany;
    protected State $state;
    protected string $currentLocation;
    protected string $status;

    //  getTrips(String): array
    //  allocate()
    //  deallocate()
    
    

    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation)
    {
        $this->registrationNo = $registrationNo;
        $this->model = $model;
        $this->purchasedYear = $purchasedYear;
        $this->value = $value;
        $this->fuelType = $fuelType;
        $this->insuranceValue = $insuranceValue;
        $this->insuranceCompany = $insuranceCompany;
        $this->status = State::getStateString($state);
        $this->state = State::getState($state);
        $this->currentLocation = ($currentLocation != null) ? $currentLocation : '';
    }

    

    // public static function deleteVehicle($registrationNo){
    //     $vehicleController = new VehicleController();
    //     $vehicleController->updateRecord($registrationNo,array("Status"=>"Delete"));
    // }

    // public static function updateVehicle($registrationNo,$fields){
    //     $vehicleController = new VehicleController();
    //     $vehicleController->updateRecord($registrationNo,$fields);
    // }
    
    abstract public function getField(string $field);

    abstract public static function getObject(int $ID);

    abstract public static function getObjectByValues(array $values);

    abstract public function updateInfo(array $vehicleInfo) : void;

    public function delete(): void{
        $vehicleController = new VehicleController();
        $vehicleController->deleteVehicle($this->registrationNo);
    }

    public function setState(State $state) 
    {
        $this->state = $state;
    }

    public function allocate() : void
    {
        $this->state->allocate($this);
    }

    public function deallocate() : void
    {
        $this->state->deallocate($this);
    }

    public function repair() : void
    {
        $this->state->repair($this);
    }

    public function finishRepair() : void
    {
        $this->state->finishRepair($this);
    }
}
