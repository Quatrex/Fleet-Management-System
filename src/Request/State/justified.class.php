<?php
namespace Request\State;

use Request\Factory\Base\RealRequest;
use EmailClient\EmailClient;

class Justified extends State {

    private static ?Justified $instance = null;
    private EmailClient $emailClient;

    private function __construct() {
        $this->stateID=parent::getStateID('justified');
        $this->emailClient = EmailClient::getInstance();
    }

    public static function getInstance() : Justified {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public function approve(RealRequest $request) : void 
    {
        $request->setState(Approved::getInstance());
        $this->emailClient->notifyApprovalApprove($request);
    }

    public function disapprove(RealRequest $request) : void 
    {
        $request->setState(Denied::getInstance());
        $this->emailClient->notifyApprovalDeny($request);
    }
    
    public function cancel(RealRequest $request) : void 
    {
        $request->setState(Cancelled::getInstance());
    }

    public function expire(RealRequest $request) : void 
    {
        $request->setState(Expired::getInstance());
    }
}