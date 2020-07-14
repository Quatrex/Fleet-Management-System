<?php
namespace Vehicle\State;

use Vehicle\Factory\Base\AbstractVehicle;

class Allocated extends State {

    private static ?Allocated $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('allocated');
    }

    public static function getInstance() : Allocated {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function deallocate(AbstractVehicle $vehicle) : void {
        $vehicle->setState(Available::getInstance());
    }
}