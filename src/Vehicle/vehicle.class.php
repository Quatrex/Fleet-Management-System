<?php

namespace Vehicle;

use DB\Viewer\VehicleViewer;
use DB\Controller\VehicleController;
use IObjectHandle\IObjectHandle;

abstract class Vehicle implements IObjectHandle
{
    protected string $registrationNo;
    protected string $model;
    protected string $purchasedYear;
    protected string $value;
    protected string $fuelType;
    protected int $insuranceValue;
    protected string $insuranceCompany;
    protected int $state;
    protected string $currentLocation;

    //  setState(State):
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
        $this->state = $state;
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
    
    

    public function getField($field){ //suitable location for the function?
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }
}
