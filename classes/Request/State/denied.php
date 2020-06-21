<?php
namespace Request\State;

class Denied extends State {

    private ?Denied $instance = null;

    private function __construct() {
    }

    public static function getInstance() : Denied {
        if (self::$instance == null)
            return new Denied();
        else return self::$instance;
    }
}