<?php
namespace Request\Factory\RequesterRequest;

use Request\Factory\Base\EmployeeRequestProxy;
use EmailClient\EmailClient;
use Request\State\State;
use Exception;

class RequesterRequestProxy extends EmployeeRequestProxy
{

    /**
     * @inheritDoc
     */
    public function cancel() : void 
    {
        $state = State::getState(State::getStateID($this->realRequest->getField('state')));
        $conditions = array(State::getState(State::getStateID('pending')),State::getState(State::getStateID('justified')),State::getState(State::getStateID('approved')));
        if (in_array($state,$conditions))
            $this->realRequest->cancel();
        else
            throw new Exception('Access Denied');
    }
    
    public function noitfyNewRequest() //not the correct class to put this method?
    {
        $emailClient = EmailClient::getInstance();
        $emailClient->notifyRequestSubmission($this->realRequest);
    }

    public function saveToDatabase()
    {
        $this->realRequest->saveToDatabase();
    }
}