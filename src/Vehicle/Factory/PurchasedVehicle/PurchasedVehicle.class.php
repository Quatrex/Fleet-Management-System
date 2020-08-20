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

    public function getField(string $field)
    {
        $property=parent::getField($field);
        if ($property==null and property_exists($this, $field)) {
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
            'AssignedOfficer' => $this->assignedOfficer,
            'State' => State::getStateString($this->state->getID()),
            'CurrentLocation' => $this->currentLocation,
            'NumOfAllocations' => $this->numOfAllocations,
            'VehiclePicturePath' => $this->vehicleImagePath,
            'assignedRequests'=>$this->assignedRequests,
            'IsLeased'=>0 //true/false or 1/0?
        ];
    }

    //IObjectHandle
    public function saveToDatabase(): void
    {
        $vehicleController = new VehicleController();
        $vehicleController->savePurchasedVehicleRecord(
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
            $this->numOfAllocations
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

        $vehicleController = new VehicleController();
        $vehicleController->updatePurchasedVehicleInfo(
            $values['RegistrationNo'],
            $this->registrationNo,
            $this->model,
            $this->purchasedYear,
            $this->value,
            $this->fuelType,
            $this->insuranceValue,
            $this->insuranceCompany,
            $this->assignedOfficer
        );
    }
}
