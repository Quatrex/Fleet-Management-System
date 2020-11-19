<?php

namespace Employee\Factory\Driver;

class VPMODriverProxy extends DriverProxy
{
    /**
     * @inheritDoc
     */
    public function allocate() : void
    {
        $this->driver->allocate();
    }

    /**
     * @inheritDoc
     */
    public function deallocate() : void
    {
        $this->driver->deallocate();
    }

    /**
     * @inheritDoc
     */
    public function assignVehicle(string $registrationNo) : void
    {
        $this->driver->assignVehicle($registrationNo);
    }
}