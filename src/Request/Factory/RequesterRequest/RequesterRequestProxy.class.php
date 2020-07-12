<?php
namespace Request\Factory\RequesterRequest;

use Request\Factory\Base\EmployeeRequestProxy;
use EmailClient\EmailClient;
use Request\State\State;

class RequesterRequestProxy extends EmployeeRequestProxy
{

    /**
     * @inheritDoc
     */
    public function cancel() : void 
    {
        $state = $this->realRequest->getField('state');
        $conditions = array(State::getState(State::getStateID('pending')),State::getState(State::getStateID('justified')),State::getState(State::getStateID('approved')));
        
        if (in_array($state,$conditions))
            $this->realRequest->cancel();
        else
            echo "Access Denied"; //throw an exception instead
    }
    
    public function noitfyNewRequest() //not the correct class to put this method?
    {
        $emailClient = EmailClient::getInstance();
        $emailClient->notifyRequestSubmission($this->realRequest);
    }
}