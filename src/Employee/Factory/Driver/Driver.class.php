<?php

namespace Employee\Factory\Driver;

interface Driver
{
    /**
     * Allocate the driver to a request
     */
    public function allocate() : void;

    /**
     * Deallocate the driver from a request
     */
    public function deallocate() : void;

    /**
     * Assgin a vehicle to a driver. Only the VPMO is privileged to invoke this.
     */
    public function assignVehicle(string $registrationNo) : void;

    /**
     * Update driver information. Only the Admin is privileged to invoke this.
     */
    public function updateInfo(array $values) : void;

    public function getField(string $field);
}