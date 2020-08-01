<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use Request\Factory\Base\EmployeeRequestProxy;
use Report\VehicleHandoutSlip;
use Exception;

class VPMORequestProxy extends EmployeeRequestProxy
{
    /**
     * @inheritDoc
     */
    public function schedule(string $empID, string $driver, string $vehicle) : void 
    {
        $this->realRequest->schedule($empID,$driver,$vehicle);
    }

    /**
     * @inheritDoc
     */
    public function close() : void 
    {
        $this->realRequest->close();
    }

    /**
     * @inheritDoc
     */
    public function cancel() : void 
    {
        $state = State::getState(State::getStateID($this->realRequest->getField('state')));
        $conditions = array(State::getState(State::getStateID('scheduled')));
        
        if (in_array($state,$conditions))
            $this->realRequest->cancel();
        else
            throw new Exception('Access Denied');
    }

    /**
     * @inheritDoc
     */
    public function generateVehicleHandoutSlip(): VehicleHandoutSlip
    {
        return $this->realRequest->generateVehicleHandoutSlip();
    }
}