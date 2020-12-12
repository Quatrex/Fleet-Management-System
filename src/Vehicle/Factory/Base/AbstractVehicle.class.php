<?php

namespace Vehicle\Factory\Base;

use Vehicle\State\State;
use Vehicle\Vehicle;
use db\Controller\VehicleController;
use Exception;
use Request\Factory\VPMORequest\VPMORequestFactory;


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
    protected ?array $assignedRequests;
    protected ?string $vehicleImagePath;

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
        // $this->status = State::getStateString($values['State']);
        $this->state = is_numeric($values['State'])?State::getState($values['State']):State::getState(State::getStateID($values['State']));
        $this->currentLocation = ($values['CurrentLocation'] != null) ? $values['CurrentLocation'] : '';
        $this->numOfAllocations = $values['NumOfAllocations'];
        $this->assignedRequests = null;
        $this->vehicleImagePath=$values['VehiclePicturePath'];
    }

    //abstract public function getField(string $field);

    abstract public function updateInfo(array $vehicleInfo): void;

    abstract public function saveToDatabase(): void;

    public function getField(string $field)
    {
        if (property_exists($this, $field)) {
            $noIDObjectFields = ['assignedRequests'];
            if (in_array($field, $noIDObjectFields)) {
                if ($this->$field === null)
                    $this->loadObject($field);
                return $this->$field;
            }

            if ($field === 'state') return State::getStateString($this->state->getID());
            return $this->$field;
        }
        
        return null;
    }

    /**
     * Loads a specified object without a reference to it
     * 
     * @param string $objectName
     * @param bool $byValue default => false
     * @param array $values default => [ ]
     */
    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        switch ($objectName) {
            case 'assignedRequests':
                if($byValue){
                    throw new Exception("Cannot load assignedRequests by value");
                }
                else{
                    $this->assignedRequests = VPMORequestFactory::makeAssignedRequests($this->registrationNo,"vehicle");
                }
                break;
            default:
                throw new Exception("Invalid parameter $objectName for AbstractVehicle::loadNoIDObject");
        }
    }

    public function delete(): void
    {
        $vehicleController = new VehicleController();
        $vehicleController->deleteVehicle($this->registrationNo);
    }

    public function updatePicture(array $vehicleInfo): void
    {
        $vehicleController = new VehicleController();
        $this->vehicleImagePath=$vehicleInfo['VehiclePicturePath'];
        $vehicleController->updatePicture($this->registrationNo,$vehicleInfo['VehiclePicturePath']);
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function allocate(): void
    {
        $this->numOfAllocations += 1;
        if ($this->numOfAllocations == 1) {
            $this->state->allocate($this);
        }
        $stateID = $this->state->getID();

        $vehicleController = new VehicleController();
        $vehicleController->updateNumOfAllocations($this->registrationNo, $this->numOfAllocations, $stateID);
    }

    public function deallocate(): void
    {
        $this->numOfAllocations -= 1;
        if ($this->numOfAllocations == 0) {
            $this->state->deallocate($this);
        }
        $stateID = $this->state->getID();
        
        $vehicleController = new VehicleController();
        $vehicleController->updateNumOfAllocations($this->registrationNo, $this->numOfAllocations, $stateID);
    }

    public function repair(): void
    {
        $this->state->repair($this);
    }

    public function finishRepair(): void
    {
        $this->state->finishRepair($this);
    }

    public function updateAssignedOfficer(array $values): void
    {
        //changed vehicle attributes can be analysed here

        $this->assignedOfficer = $values['AssignedOfficer'];

        $vehicleController = new VehicleController();
        $vehicleController->updateAssignedOfficer(
            $this->registrationNo,
            $this->assignedOfficer,
        );
    }
}
