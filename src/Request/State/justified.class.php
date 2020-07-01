<?php
namespace Request\State;

use Request\Factory\Type\RealRequest;

class Justified extends State {

    private static ?Justified $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("justified");
    }

    public static function getInstance() : Justified {
        if (self::$instance == null)
            return new Justified();
        else return self::$instance;
    }

    public function approve(RealRequest $request) : void {
        $request->setState(Approved::getInstance());
    }

    public function denyApprove(RealRequest $request) : void {
        $request->setState(Denied::getInstance());
    }
    
    public function cancel(RealRequest $request) : void {
        $request->setState(Cancelled::getInstance());
    }
}