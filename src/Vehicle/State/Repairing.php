<?php
namespace Vehicle\State;

class Repairing extends State {

    private static ?Repairing $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('repairing');
    }

    public static function getInstance() : Repairing {
        if (self::$instance == null)
            return new Repairing();
        else return self::$instance;
    }
}