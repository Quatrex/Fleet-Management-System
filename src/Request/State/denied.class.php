<?php
namespace Request\State;

class Denied extends State {

    private static ?Denied $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('denied');
    }

    public static function getInstance() : Denied {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }
}