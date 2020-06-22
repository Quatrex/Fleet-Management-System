<?php
namespace Request\State;

use Request\Request;

class Justified extends State {

    private ?Justified $instance = null;

    private function __construct() {
    }

    public static function getInstance() : Justified {
        if (self::$instance == null)
            return new Justified();
        else return self::$instance;
    }

    public function approve(Request $request) : void {
        //approve request
    }

    public function denyApprove(Request $request) : void {
        //deny approve
    }
}