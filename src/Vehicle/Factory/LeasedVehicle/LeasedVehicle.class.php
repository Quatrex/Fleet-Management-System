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
        $this->leasedCompany = $values['LeasedCompany'];
        $this->leasedPeriodFrom = $values['LeasedPeriodFrom'];
        $this->leasedPeriodTo = $values['LeasedPeriodTo'];
        $this->monthlyPayment = $values['MonthlyPayment'];
    }

    public function getField(string $field)
    {
        $property = parent::getField($field);
        if ($property == null && property_exists($this, $field)) {
            return $this->$field;
        }
        return $property;
    }


    public function jsonSerialize()
    {
        return [
            'RegistrationNo' => $this->registrationNo,
            'Model' => $this->model,
            'PurchasedYear' => $this->purchasedYear,
            'Value' => $this->value,
            'FuelType' => $this->fuelType,
            'InsuranceValue' => $this->insuranceValue,
            'InsuranceCompany' => $this->insuranceCompany,
            'State' => State::getStateString($this->state->getID()),
            'CurrentLocation' => $this->currentLocation,
            'NumOfAllocations' => $this->numOfAllocations,
            'LeasedCompany' => $this->leasedCompany,
            'LeasedPeriodFrom' => $this->leasedPeriodFrom,
            'LeasedPeriodTo' => $this->leasedPeriodTo,
            'MonthlyPayment' => $this->monthlyPayment,
            'VehiclePicturePath' => $this->vehicleImagePath,
            'AssignedRequests'=>$this->assignedRequests,
            'AssignedOfficer'=>$this->assignedOfficer,
            'IsLeased'=>1 //true/false or 1/0?

        ];
    }

    //IObjectHandle
    public function saveToDatabase(): void
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

        $this->registrationNo = $values['NewRegistrationNo'];
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
        $vehicleController->updateLeasedVehicleInfo(
            $values['RegistrationNo'],
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
            $this->monthlyPayment
        );
    }

    
}
