<?php
namespace Request\State;

class Expired extends State {

    private static ?Expired $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("expired");
    }

    public static function getInstance() : Expired {
        if (self::$instance == null)
            return new Expired();
        else return self::$instance;
    }
}