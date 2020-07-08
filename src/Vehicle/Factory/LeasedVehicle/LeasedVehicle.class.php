<?php

namespace Vehicle\Factory\LeasedVehicle;

use DB\Viewer\VehicleViewer;
use DB\Controller\VehicleController;
use JsonSerializable;
use Vehicle\Factory\Base\AbstractVehicle;
use Vehicle\State\State;

class LeasedVehicle extends AbstractVehicle implements JsonSerializable
{
    private string $leasedCompany;
    private string $leasedPeriodFrom;
    private string $leasedPeriodTo;
    private string $monthlyPayment;

    public function __construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment)
    {
        parent::__construct($registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany, $state, $currentLocation);
        $this->leasedCompany = $leasedCompany;
        $this->leasedPeriodFrom = $leasedPeriodFrom;
        $this->leasedPeriodTo = $leasedPeriodTo;
        $this->monthlyPayment = $monthlyPayment;
    }

    public function getField(string $field)
    {
        if (property_exists($this, $field)) {
            return $this->$field;
        }
        return null;
    }


    public function jsonSerialize()
    {
        return [
            'registration' => $this->getField('registrationNo'),
            'model' => $this->getField('model'),
            'purchasedYear' => $this->getField('purchasedYear'),
            'value' => $this->getField('value'),
            'fuelType' => $this->getField('fuelType'),
            'insuranceValue' => $this->getField('insuranceValue'),
            'insuranceCompany'=>$this->getField('insuranceCompany'),
            'state' => $this->getField('state'),
            'currentLocation' => $this->getField('currentLocation'),
            'leasedCompany' => $this->getField('leasedCompany'),
            'leasedPeriodFrom' => $this->getField('leasedPeriodFrom'),
            'leasedPeriodTo' => $this->getField('leasedPeriodTo'),
            'monthlyPayment' => $this->getField('monthlyPayment')

        ];
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
    public static function getObjectByValues(array $values)
    {
        $obj = new LeasedVehicle($values['RegistrationNo'], $values['Model'], $values['PurchasedYear'], $values['Value'], $values['FuelType'], $values['InsuranceValue'], $values['InsuranceCompany'], $values['State'], $values['CurrentLocation'], $values['LeasedCompany'], $values['LeasedPeriodFrom'], $values['LeasedPeriodTo'], $values['MonthlyPayment']);
        return $obj;
    }

    //IObjectHandle
    public static function constructObject($vehicleInfo)
    {
        $state = State::getState(State::getStateID('Available'));
        $currentLocation = ""; //attention!
        $obj = new LeasedVehicle($vehicleInfo[0], $vehicleInfo[1], $vehicleInfo[2], $vehicleInfo[3], $vehicleInfo[4], $vehicleInfo[5], $vehicleInfo[6], $state, $currentLocation, $vehicleInfo[7], $vehicleInfo[8], $vehicleInfo[9], $vehicleInfo[10]);
        $obj->saveToDatabase(); //check for failure
        return $obj; //return false, if fail
    }

    //IObjectHandle
    private function saveToDatabase()
    {
        $vehicleController = new VehicleController();
        $vehicleController->saveLeasedVehicleRecord(
            $this->registrationNo,
            $this->model,
            $this->purchasedYear,
            $this->value,
            $this->fuelType,
            $this->insuranceValue,
            $this->insuranceCompany,
            $this->state->getID(),
            $this->currentLocation,
            $this->leasedCompany,
            $this->leasedPeriodFrom,
            $this->leasedPeriodTo,
            $this->monthlyPayment
        );
    }

    public function updateInfo(array $vehicleInfo): void
    {
        //changed vehicle attributes can be analysed here

        $vehicleController = new VehicleController();
        $vehicleController->updateLeasedVehicleInfo(
            $this->registrationNo,
            $vehicleInfo[0],
            $vehicleInfo[1],
            $vehicleInfo[2],
            $vehicleInfo[3],
            $vehicleInfo[4],
            $vehicleInfo[5],
            $vehicleInfo[6],
            $vehicleInfo[7],
            $vehicleInfo[8],
            $vehicleInfo[9]
        );
    }
}
