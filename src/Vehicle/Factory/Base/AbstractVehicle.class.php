<?php

namespace Vehicle\Factory\Base;

use Vehicle\State\State;
use Vehicle\Vehicle;
use db\Controller\VehicleController;


abstract class AbstractVehicle implements Vehicle
{
    protected string $registrationNo;
    protected string $model;
    protected string $purchasedYear;
    protected string $value;
    protected string $fuelType;
    protected int $insuranceValue;
    protected string $insuranceCompany;
    protected ?string $assignedOfficer;
    protected State $state;
    protected string $currentLocation;
    protected string $numOfAllocations;
    protected string $status;

    public function __construct($values)
    {
        $this->registrationNo = $values['RegistrationNo'];
        $this->model = $values['Model'];
        $this->purchasedYear = $values['PurchasedYear'];
        $this->value = $values['Value'];
        $this->fuelType = $values['FuelType'];
        $this->insuranceValue = $values['InsuranceValue'];
        $this->insuranceCompany = $values['InsuranceCompany'];
        $this->assignedOfficer = $values['AssignedOfficer'];
        $this->status = State::getStateString($values['State']);
        $this->state = State::getState($values['State']);
        $this->currentLocation = ($values['CurrentLocation'] != null) ? $values['CurrentLocation'] : '';
        $this->numOfAllocations = $values['NumOfAllocations'];
    }

    abstract public function getField(string $field);

    abstract public function updateInfo(array $vehicleInfo): void;

    abstract public function saveToDatabase(): void;

    public function delete(): void
    {
        $vehicleController = new VehicleController();
        $vehicleController->deleteVehicle($this->registrationNo);
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function allocate(): void
    {
        $this->numOfAllocations += 1;
        $vehicleController = new VehicleController();
        $vehicleController->updateNumOfAllocations($this->registrationNo, $this->numOfAllocations);

        if ($this->numOfAllocations > 0) {
            $this->state->allocate($this);
        }
    }

    public function deallocate(): void
    {
        $this->numOfAllocations -= 1;
        $vehicleController = new VehicleController();
        $vehicleController->updateNumOfAllocations($this->registrationNo, $this->numOfAllocations);

        if ($this->numOfAllocations == 0) {
            $this->state->deallocate($this);
        }
    }

    public function repair(): void
    {
        $this->state->repair($this);
    }

    public function finishRepair(): void
    {
        $this->state->finishRepair($this);
    }
}
