<?php
namespace Request\State;

class Cancelled extends State {

    private ?Cancelled $instance = null;

    private function __construct() {
    }

    public static function getInstance() : Cancelled {
        if (self::$instance == null)
            return new Cancelled();
        else return self::$instance;
    }
}