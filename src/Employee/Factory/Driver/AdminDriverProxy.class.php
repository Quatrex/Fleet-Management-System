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

    public function delete(): void
    {
        $this->driver->delete();
    }

    public function updatePicture(string $imagePath): void
    {
        $this->driver->updatePicture($imagePath);
    }
}