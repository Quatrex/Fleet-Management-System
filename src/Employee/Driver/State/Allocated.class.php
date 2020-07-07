<?php
namespace Employee\Driver\State;

use Employee\Driver\Factory\Driver;

class Allocated extends State {

    private static ?Allocated $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('allocated');
    }

    public static function getInstance() : Allocated {
        if (self::$instance == null)
            return new Allocated();
        else return self::$instance;
    }

    public function deallocate(Driver $driver) : void {
        $driver->setState(Available::getInstance());
    }
}