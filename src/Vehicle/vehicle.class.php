<?php
namespace Vehicle;

interface Vehicle
{
    public function getField(string $field);
    public function updateInfo(array $vehicleInfo) : void;
    public function allocate() : void;
    public function deallocate() : void;
    public function repair() : void;
    public function finishRepair() : void;
}