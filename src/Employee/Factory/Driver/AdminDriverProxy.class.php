<?php

namespace Employee\Factory\Driver;

class AdminDriverProxy extends DriverProxy
{
    /**
     * @inheritDoc
     */
    public function updateInfo(array $values) : void
    {
        $this->driver->updateInfo($values);
    }
}