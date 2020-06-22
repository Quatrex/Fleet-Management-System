<?php
namespace Request\State;

class Approved extends State {

    private ?Approved $instance = null;

    private function __construct() {
    }

    public static function getInstance() : Approved {
        if (self::$instance == null)
            return new Approved();
        else return self::$instance;
    }
}