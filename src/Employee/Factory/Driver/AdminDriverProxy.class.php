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

    public function deleteDriver(string $driverID): void
    {
        $this->driver->deleteDriver($driverID);
    }

    public function updatePicture(string $imagePath): void
    {
        $this->driver->updatePicture($imagePath);
    }
}