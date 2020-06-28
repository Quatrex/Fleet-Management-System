<?php
namespace Request\State;

use Request\Request;

class Completed extends State {

    private ?Justified $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("completed");
    }

    public static function getInstance() : Justified {
        if (self::$instance == null)
            return new Completed();
        else return self::$instance;
    }

}