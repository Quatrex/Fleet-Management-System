<?php
namespace Employee\State\Driver;

use Employee\Factory\Driver\RealDriver;

class Available extends State {

    private static ?Available $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('available');
    }

    public static function getInstance() : Available {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function allocate(RealDriver $driver) : void {
        $driver->setState(Allocated::getInstance());
    }
}