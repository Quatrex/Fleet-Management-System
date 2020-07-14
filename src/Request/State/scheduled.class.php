<?php
namespace Request\State;

use Request\Factory\Base\RealRequest;

class Scheduled extends State {

    private static ?Scheduled $instance = null;

    private function __construct() {
        $this->stateID=parent::getStateID("scheduled");
    }

    public static function getInstance() : Scheduled {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function close(RealRequest $request) : void {
        $request->getField('vehicle')->deallocate();
        $request->getField('driver')->deallocate();
        $request->setState(Completed::getInstance());
    }

    public function cancel(RealRequest $request) : void {
        $request->getField('vehicle')->deallocate();
        $request->getField('driver')->deallocate();
        $request->setState(Cancelled::getInstance());
    }
}