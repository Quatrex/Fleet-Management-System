<?php
namespace Request\Factory\Base;

use Vehicle\Vehicle;
use Employee\Driver\Factory\Driver;
use Request\Request;
use JsonSerializable;

abstract class EmployeeRequestProxy implements Request, JsonSerializable
{

    protected Request $realRequest;

    protected function __construct(Request $realRequest)
    {
        $this->realRequest = $realRequest;
    }

    public function jsonSerialize()
    {
        return ['RequestId'=>$this->getField('requestID'),
                'DateOfTrip'=> $this->getField('dateOfTrip'),
                'TimeOfTrip'=> $this->getField('timeOfTrip'),
                'PickLocation'=>$this->getField('pickLocation'),
                'DropLocation'=> $this->getField('dropLocation'),
                'Purpose'=>$this->getField('purpose'),
                'Requester'=>$this->getField('requester'),
            ];
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

    public function getField(string $field) 
    {
        return $this->realRequest->getField($field);
    }
}