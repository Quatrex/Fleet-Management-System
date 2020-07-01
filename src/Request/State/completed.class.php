<?php
namespace Request\State;

class Completed extends State {

    private static ?Completed $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('completed');
    }

    public static function getInstance() : Completed {
        if (self::$instance == null)
            return new Completed();
        else return self::$instance;
    }

}