<?php
namespace Request\Factory\Base;

use Vehicle\Vehicle;
use Employee\Driver\Factory\Driver;
use Exception;
use Request\Request;
use JsonSerializable;
use Report\VehicleHandoutSlip;

abstract class EmployeeRequestProxy implements Request, JsonSerializable
{
    protected RealRequest $realRequest;

    public function __construct(array $values)
    {
        $this->realRequest = new RealRequest($values);
    }

    public function jsonSerialize()
    {
        return ['RequestId'=>$this->getField('requestID'),
                'DateOfTrip'=> $this->getField('dateOfTrip'),
                'Status'=> $this->getField('state'),
                'TimeOfTrip'=> $this->getField('timeOfTrip'),
                'PickLocation'=>$this->getField('pickLocation'),
                'DropLocation'=> $this->getField('dropLocation'),
                'Purpose'=>$this->getField('purpose'),
                'Requester'=>$this->getField('requester'),
                'JOComment'=>$this->getField('JOComment') == '' ? '--no comment--' : $this->getField('JOComment'),
                'CAOComment'=>$this->getField('CAOComment') == '' ? '--no comment--' : $this->getField('CAOComment'),
                'Driver'=>$this->getField('driver') === null ? '' : $this->getField('driver'),
                'Vehicle'=>$this->getField('vehicle') === null ? '' : $this->getField('vehicle'),];
    }

    /**
     * Cancels the request
     */
    public function cancel() : void
    {
        echo "Access Denied";
    }

    /**
     * Set the justification status of the request
     * 
     * @param bool $justification
     * @param int $empID
     * @param string $comment
     */
    public function setJustify(bool $justification, int $empID, string $comment) : void
    {
        echo "Access Denied";
    }

    /**
     * Set the justification status of the request
     * 
     * @param bool $approval 
     * @param int $empID
     * @param string $comment
     */
    public function setApprove(bool $approval, int $empID, string $comment) : void
    {
        echo "Access Denied";
    }


    /**
     * Schedules the request
     * 
     * @param int $empID
     * @param Driver $driver
     * @param Vehicle $vehicle
     */
    public function schedule(string $empID, string $driver, string $vehicle) : void 
    {
        echo "Access Denied";
    }

    /**
     * Closes the request
     */
    public function close() : void 
    {
        echo "Access Denied";
    }

    /**
     * Get RequestToken
     */
    public function generateVehicleHandoutSlip(): VehicleHandoutSlip
    {
        throw new Exception('Access Denied');
    }

    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        $this->realRequest->loadObject($objectName, $byValue, $values);
    }

    public function getField(string $field) 
    {
        return $this->realRequest->getField($field);
    }
}