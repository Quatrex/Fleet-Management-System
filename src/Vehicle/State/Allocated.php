<?php
namespace Vehicle\State;

class Allocated extends State {

    private static ?Allocated $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('allocated');
    }

    public static function getInstance() : Allocated {
        if (self::$instance == null)
            return new Allocated();
        else return self::$instance;
    }
}