<?php
namespace Vehicle\State;

use Vehicle\Factory\Base\AbstractVehicle;

class Available extends State {

    private static ?Available $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('available');
    }

    public static function getInstance() : Available {
        if (self::$instance == null)
            return new Available();
        else return self::$instance;
    }

    public function allocate(AbstractVehicle $vehicle) : void {
        $vehicle->setState(Allocated::getInstance());
    }

    public function repair(AbstractVehicle $vehicle) : void {
        $vehicle->setState(Repairing::getInstance());
    }
}