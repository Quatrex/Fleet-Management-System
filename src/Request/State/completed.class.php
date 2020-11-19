<?php
namespace Request\State;

class Completed extends State {

    private static ?Completed $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('completed');
    }

    public static function getInstance() : Completed {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

}