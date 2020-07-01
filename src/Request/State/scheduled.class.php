<?php
namespace Request\State;

use Request\Factory\RealRequest;

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

    public function close(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function cancel(RealRequest $request) : void {
        $request->setState(Cancelled::getInstance());
    }
}