<?php
namespace Vehicle\State;

use Vehicle\Factory\Base\AbstractVehicle;

class Assigned extends State {

    private static ?Assigned $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('assigned');
    }

    public static function getInstance() : Assigned {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function repair(AbstractVehicle $vehicle) : void 
    {
        $vehicle->setState(Repairing::getInstance());
    }

    public function disassociate(AbstractVehicle $vehicle): void
    {
        $vehicle->setState(Available::getInstance());
    }
}