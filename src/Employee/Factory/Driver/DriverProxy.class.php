<?php

namespace Employee\Factory\Driver;

use Exception;
use JsonSerializable;

class DriverProxy implements Driver, JsonSerializable
{
    protected RealDriver $driver;

    public function __construct($values)
    {
        $this->driver = new RealDriver($values);
    }
    /**
     * @inheritDoc
     */
    public function allocate() : void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function deallocate() : void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function assignVehicle(string $registrationNo) : void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function updateInfo(array $values) : void
    {
        throw new Exception('Illegel Access');      
    }

    public function getField(string $field)
    {
        return $this->getField($field);
    }

    public function jsonSerialize()
    {
        return ['DriverId'=>$this->getField('driverId'),
                'FirstName'=> $this->getField('firstName'),
                'LastName'=>$this->getField('lastName')];
    }

    public function saveToDatabase()
    {
        $this->driver->saveToDatabase();
    }
}