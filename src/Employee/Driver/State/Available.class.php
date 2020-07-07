<?php
namespace Employee\Driver\State;

use Employee\Driver\Factory\Driver;

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

    public function allocate(Driver $driver) : void {
        $driver->setState(Allocated::getInstance());
    }
}