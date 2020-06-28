<?php
namespace Request\State;

class Approved extends State {

    private static ?Approved $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("approved");
    }

    public static function getInstance() : Approved {
        if (self::$instance == null)
            return new Approved();
        else return self::$instance;
    }
}