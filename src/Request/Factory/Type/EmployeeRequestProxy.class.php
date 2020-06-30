<?php
namespace Request\Factory\Type;

use Vehicle\Vehicle;
use Employee\Driver;
use Request\Request;

abstract class EmployeeRequestProxy implements Request
{

    protected Request $realRequest;

    public function __construct(Request $realRequest)
    {
        $this->realRequest = $realRequest;
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
    public function schedule(int $empID, Driver $driver, Vehicle $vehicle) : void 
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