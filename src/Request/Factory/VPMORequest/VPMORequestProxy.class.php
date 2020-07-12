<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use Request\Factory\Base\EmployeeRequestProxy;

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
        $state = $this->realRequest->getField('state');
        $conditions = array(State::getState(State::getStateID('scheduled')));
        
        if (in_array($state,$conditions))
            $this->realRequest->cancel();
        else
            echo "Access Denied"; //throw an exception instead
    }
}