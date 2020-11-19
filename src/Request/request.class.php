<?php
namespace Request;

use Report\VehicleHandoutSlip;

interface Request {
    public function cancel() : void;
    public function setJustify(bool $justification, int $empID, string $comment) : void;
    public function setApprove(bool $approval, int $empID, string $comment) : void;
    public function schedule(string $empID, string $driver, string $vehicle) : void;
    public function close() : void;
    public function getField(string $field);
    public function loadObject(string $objectName, bool $byValue = false, array $values = array());
    public function generateVehicleHandoutSlip(): VehicleHandoutSlip;
}