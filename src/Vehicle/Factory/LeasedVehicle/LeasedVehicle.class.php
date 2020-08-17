<?php

namespace Vehicle\Factory\LeasedVehicle;

use DB\Controller\VehicleController;
use JsonSerializable;
use Request\Factory\VPMORequest\VPMORequestFactory;
use Vehicle\Factory\Base\AbstractVehicle;
use Vehicle\State\State;

class LeasedVehicle extends AbstractVehicle implements JsonSerializable
{
    private string $leasedCompany;
    private string $leasedPeriodFrom;
    private string $leasedPeriodTo;
    private string $monthlyPayment;

    public function __construct(array $values)
    {
        parent::__construct($values);
        $this->leasedCompany = $values['leasedCompany'];
        $this->leasedPeriodFrom = $values['leasedPeriodFrom'];
        $this->leasedPeriodTo = $values['leasedPeriodTo'];
        $this->monthlyPayment = $values['monthlyPayment'];
    }

    public function getField(string $field)
    {
        $property=parent::getField($field);
        if ($property==null && property_exists($this, $field)) {
            return $this->$field;
        }
        return $property;
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
            'numOfAllocations'=>$this->numOfAllocations,
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
            $this->assignedOfficer,
            $this->state->getID(),
            $this->currentLocation,
            $this->numOfAllocations,
            $this->leasedCompany,
            $this->leasedPeriodFrom,
            $this->leasedPeriodTo,
            $this->monthlyPayment
        );
    }

    public function updateInfo(array $values): void
    {
        //changed vehicle attributes can be analysed here

        $this->registrationNo=$values['NewRegistrationNo'];
        $this->model = $values['Model'];
        $this->purchasedYear = $values['PurchasedYear'];
        $this->value = $values['Value'];
        $this->fuelType = $values['FuelType'];
        $this->insuranceValue = $values['InsuranceValue'];
        $this->insuranceCompany = $values['InsuranceCompany'];
        $this->currentLocation = $values['CurrentLocation'];
        $this->leasedCompany = $values['LeasedCompany'];
        $this->leasedPeriodFrom = $values['LeasedPeriodFrom'];
        $this->leasedPeriodTo = $values['LeasedPeriodTo'];
        $this->monthlyPayment = $values['MonthlyPayment'];

        $vehicleController = new VehicleController();
        $vehicleController->updateLeasedVehicleInfo($values['RegistrationNo'],
                                                    $this->registrationNo, 
                                                    $this->model, 
                                                    $this->purchasedYear, 
                                                    $this->value, 
                                                    $this->fuelType, 
                                                    $this->insuranceValue, 
                                                    $this->insuranceCompany,
                                                    $this->assignedOfficer, 
                                                    $this->leasedCompany, 
                                                    $this->leasedPeriodFrom, 
                                                    $this->leasedPeriodTo, 
                                                    $this->monthlyPayment);
    }
}
