<?php
namespace Request\State;

use Request\Request;

class Scheduled extends State {

    private static ?Justified $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("scheduled");
    }

    public static function getInstance() : Justified {
        if (self::$instance == null)
            return new Justified();
        else return self::$instance;
    }

}