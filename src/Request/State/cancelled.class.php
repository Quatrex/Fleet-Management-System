<?php
namespace Request\State;

class Cancelled extends State {

    private static ?Cancelled $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('cancelled');
    }

    public static function getInstance() : Cancelled {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }
}