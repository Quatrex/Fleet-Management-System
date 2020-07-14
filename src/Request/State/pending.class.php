<?php
namespace Request\State;

use Request\Factory\Base\RealRequest;
use EmailClient\EmailClient;

class Pending extends State {

    private static ?Pending $instance = null;
    private EmailClient $emailClient;

    private function __construct() {
        $this->stateID=parent::getStateID('pending');
        $this->emailClient = EmailClient::getInstance();
    }

    public static function getInstance() : Pending {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function justify(RealRequest $request) : void 
    {
        $request->setState(Justified::getInstance());
        $this->emailClient->notifyJustificationApprove($request);
    }

    public function denyJustify(RealRequest $request) : void 
    {
        $request->setState(Denied::getInstance());
        $this->emailClient->notifyJustificationDeny($request);
    }
    
    public function cancel(RealRequest $request) : void {
        $request->setState(Cancelled::getInstance());
    }

    public function expire(RealRequest $request) : void 
    {
        $request->setState(Expired::getInstance());
    }
}