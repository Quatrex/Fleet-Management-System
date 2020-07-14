<?php
namespace Employee\State\Driver;

use Employee\Factory\Driver\RealDriver;

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

    public function deallocate(RealDriver $driver) : void {
        $driver->setState(Available::getInstance());
    }
}