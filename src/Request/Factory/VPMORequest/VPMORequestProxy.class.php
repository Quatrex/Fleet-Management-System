<?php
namespace Request\Factory\VPMORequest;

use Request\Factory\Base\RealRequest;
use Request\Factory\RequesterRequest\RequesterRequestProxy;
use Request\State\State;
use Employee\Driver\Factory\Driver;
use Vehicle\Vehicle;

class VPMORequestProxy extends RequesterRequestProxy
{
    /**
     * Retruns a request object
     * 
     * @param int $id
     * @return JORequestProxy
     */
    public static function getRequestByID(int $id) : VPMORequestProxy
    {
        $realRequest = RealRequest::getObject($id);
        return new VPMORequestProxy($realRequest);
    }

    /**
     * Returns a request object
     * 
     * @param array(String) $values
     * @return JORequestProxy
     */
    public static function getRequestByValues(array $values) : VPMORequestProxy
    {
        $realRequest = RealRequest::getObjectByValues($values);
        return new VPMORequestProxy($realRequest);
    }

    public function schedule(int $empID, Driver $driver, Vehicle $vehicle) : void 
    {
        $this->realRequest->schedule($empID,$driver,$vehicle);
    }

    public function close() : void 
    {
        $this->realRequest->close();
    }

    public function cancel() : void 
    {
        $state = $this->realRequest->getField('state');
        if ($state === State::getState(State::getStateID('approved')))
            $this->realRequest->cancel();
        else
            echo "Access Denied";
    }

    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        $this->realRequest->loadObject($objectName, $byValue, $values);
    }
}