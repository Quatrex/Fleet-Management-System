<?php

namespace Employee\Factory\Driver;

use Exception;
use JsonSerializable;
use Employee\State\Driver\State;

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

    /**
     * @inheritDoc
     */
    public function updatePicture(string $imagePath): void
    {
        throw new Exception('Illegel Access');
    }

    /**
     * @inheritDoc
     */
    public function deleteDriver(string $driverID) : void
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
            'FirstName' => $this->driver->getField('firstName'),
            'LastName' => $this->driver->getField('lastName'),
            'Email' => $this->driver->getField('email'),
            'DriverID' => $this->driver->getField('driverId'),
            'LicenseNumber' => $this->driver->getField('licenseNumber'),
            'LicenseType' => $this->driver->getField('licenseType'),
            'LicenseExpirationDay' => $this->driver->getField('licenseExpirationDay'),
            'DateOfAdmission' => $this->driver->getField('dateOfAdmission'),
            'AssignedVehicle' => $this->driver->getField('assignedVehicle')== null ? '' : $this->getField('assignedVehicle'),
            'NumOfAllocations' => $this->driver->getField('numOfAllocations'),
            'State' => State::getStateString($this->driver->getField('state')->getID()),
            'ProfilePicturePath' => $this->driver->getField('profilePicturePath'),            
            'AssignedRequests' => $this->driver->getField('assignedRequests',false),
            'ContactNo' => $this->driver->getField('contactNumber')     
            // 'AssignedRequests' => []            
        ];
    }

    public function saveToDatabase()
    {
        $this->driver->saveToDatabase();
    }
}
