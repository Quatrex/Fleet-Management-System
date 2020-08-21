<?php
namespace Vehicle;

interface Vehicle
{
    public function getField(string $field);
    public function updateInfo(array $vehicleInfo) : void;
    public function updatePicture(array $vehicleInfo) : void;
    public function updateAssignedOfficer(array $values): void;
    public function allocate() : void;
    public function deallocate() : void;
    public function repair() : void;
    public function finishRepair() : void;
    public function delete() : void;
}