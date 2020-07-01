<?php
namespace Request\State;

class Denied extends State {

    private static ?Denied $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('denied');
    }

    public static function getInstance() : Denied {
        if (self::$instance == null)
            return new Denied();
        else return self::$instance;
    }
}