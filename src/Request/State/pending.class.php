<?php
namespace Request\State;

use Request\Request;

class Pending extends State {

    private static ?Pending $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("pending");
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