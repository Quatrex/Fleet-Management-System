<?php
namespace Request\State;

use Request\Request;

class Pending extends State {

    private ?Pending $instance = null;

    private function __construct() {
    }

    public static function getInstance() : Pending {
        if (self::$instance == null)
            return new Pending();
        else return self::$instance;
    }

    public function justify(Request $request) : void {
        //justify request
    }

    public function denyJustify(Request $request) : void {
        //deny justify request
    }
}