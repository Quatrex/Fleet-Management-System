<?php
namespace Vehicle\State;

use Vehicle\Factory\Base\AbstractVehicle;

class Repairing extends State {

    private static ?Repairing $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('repairing');
    }

    public static function getInstance() : Repairing {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function finishRepair(AbstractVehicle $vehicle) : void {
        $vehicle->setState(Available::getInstance());
    }
}