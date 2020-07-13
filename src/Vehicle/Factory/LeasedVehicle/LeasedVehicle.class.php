<?php

namespace Vehicle\Factory\LeasedVehicle;

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

    public function __construct($values)
    {
        parent::__construct($values);
        $this->leasedCompany = $values['LeasedCompany'];
        $this->leasedPeriodFrom = $values['LeasedPeriodFrom'];
        $this->leasedPeriodTo = $values['LeasedPeriodTo'];
        $this->monthlyPayment = $values['MonthlyPayment'];
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
            'registration' => $this->registrationNo,
            'model' => $this->model,
            'purchasedYear' => $this->purchasedYear,
            'value' => $this->value,
            'fuelType' => $this->fuelType,
            'insuranceValue' => $this->insuranceValue,
            'insuranceCompany'=>$this->insuranceCompany,
            'state' => State::getStateString($this->state->getID()),
            'currentLocation' => $this->currentLocation,
            'leasedCompany' => $this->leasedCompany,
            'leasedPeriodFrom' => $this->leasedPeriodFrom,
            'leasedPeriodTo' => $this->leasedPeriodTo,
            'monthlyPayment' => $this->monthlyPayment];
    }

    //IObjectHandle
    public function saveToDatabase() : void
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
