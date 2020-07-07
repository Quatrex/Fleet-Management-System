<?php
namespace Request;

use Employee\Driver\Factory\Driver;
use Vehicle\Vehicle;

interface Request {
    public function cancel() : void;
    public function setJustify(bool $justification, int $empID, string $comment) : void;
    public function setApprove(bool $approval, int $empID, string $comment) : void;
    public function schedule(int $empID, Driver $driver, Vehicle $vehicle) : void;
    public function close() : void;
    public function getField(string $field);
}