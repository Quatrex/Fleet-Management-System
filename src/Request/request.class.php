<?php
namespace Request;

use Employee\Driver;
use Vehicle\Vehicle;

interface Request {
    public function cancel() : void;
    public function setJustify(bool $justification, int $empID, string $comment, string $position) : void;
    public function setApprove(bool $approval, int $empID, string $comment, string $position) : void;
    public function schedule(int $empID, Driver $driver, Vehicle $vehicle) : void;
    public function close() : void;
    public function getField(string $field);
}