<?php
namespace Request\State;

use Request\Factory\Type\RealRequest;

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

    public function justify(RealRequest $request) : void {
        $request->setState(Justified::getInstance());
    }

    public function denyJustify(RealRequest $request) : void {
        $request->setState(Denied::getInstance());
    }
    
    public function cancel(RealRequest $request) : void {
        $request->setState(Cancelled::getInstance());
    }
}