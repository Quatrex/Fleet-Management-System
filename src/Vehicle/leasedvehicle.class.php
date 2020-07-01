<?php
namespace Vehicle;

use DB\Viewer\VehicleViewer;
use DB\Controller\VehicleController;

class LeasedVehicle extends Vehicle
{
    private string $leasedCompany;
    private string $leasedPeriodFrom;
    private string $leasedPeriodTo;
    private string $monthlyPayment;

    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::__construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation);
        $this->leasedCompany=$leasedCompany;
        $this->leasedPeriodFrom=$leasedPeriodFrom;
        $this->leasedPeriodTo=$leasedPeriodTo;
        $this->monthlyPayment=$monthlyPayment;
    }

    //IObjectHandle
    public static function getObject($registrationNo)
    {
        //get values from database
        $vehicleViewer = new VehicleViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $vehicleViewer->getRecordByID($registrationNo);
        $obj = new LeasedVehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['State'], $values['CurrentLocation'], $values['LeasedCompany'], $values['LeasedPeriodFrom'], $values['LeasedPeriodTo'], $values['MonthlyPayment']);
        return $obj;
    }

    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new LeasedVehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['State'], $values['CurrentLocation'], $values['LeasedCompany'], $values['LeasedPeriodFrom'], $values['LeasedPeriodTo'], $values['MonthlyPayment']);
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        $state=1;//set using an enum
        $currentLocation=""; //attention!
        $obj = new LeasedVehicle($registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany,$state,$currentLocation, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment);
        $obj->saveToDatabase(); //check for failure
        return $obj; //return false, if fail
    }

    //IObjectHandle
    private function saveToDatabase(){
        $vehicleController = new VehicleController();
        $vehicleController->saveLeasedVehicleRecord($this->registrationNo,
                                    $this->model,
                                    $this->purchasedYear,
                                    $this->value,
                                    $this->fuelType,
                                    $this->insuranceValue,
                                    $this->insuranceCompany,
                                    $this->state,
                                    $this->currentLocation,
                                    $this->leasedCompany,
                                    $this->leasedPeriodFrom,
                                    $this->leasedPeriodTo,
                                    $this->monthlyPayment);
    }
}