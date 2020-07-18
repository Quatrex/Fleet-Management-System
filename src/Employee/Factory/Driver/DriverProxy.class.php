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
    public function allocate(): void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function deallocate(): void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function assignVehicle(string $registrationNo): void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function updateInfo(array $values): void
    {
        throw new Exception('Illegel Access');
    }

    public function getField(string $field)
    {
        return $this->driver->getField($field);
    }

    public function jsonSerialize()
    {
        return [
            'driverId' => $this->driver->getField('driverId'),
            'firstName' => $this->driver->getField('firstName'),
            'employedDate' => $this->driver->getField('employedDate'),
            'firstName' => $this->driver->getField('firstName'),
            'lastName' => $this->driver->getField('lastName'),
            'assignedVehicleID' => $this->driver->getField('assignedVehicleID'),
            'licenseID' => $this->driver->getField('licenseID'),
            'licenseExpDate' => $this->driver->getField('licenseExpDate'),
            'email' => $this->driver->getField('email'),
            'licenseType' => $this->driver->getField('licenseType')
        ];
    }

    public function saveToDatabase()
    {
        $this->driver->saveToDatabase();
    }
}
