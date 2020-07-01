<?php
namespace Request\State;
use Request\Factory\RealRequest;

class Approved extends State {

    private static ?Approved $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID('approved');
    }

    public static function getInstance() : Approved {
        if (self::$instance == null)
            return new Approved();
        else return self::$instance;
    }
    
    public function cancel(RealRequest $request) : void 
    {
        $request->setState(Cancelled::getInstance());
    }

    public function schedule(RealRequest $request) : void 
    {
        $request->setState(Scheduled::getInstance());
    }

    public function expire(RealRequest $request) : void 
    {
        $request->setState(Expired::getInstance());
    }
}