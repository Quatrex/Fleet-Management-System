<?php
namespace Request\Factory\JORequest;

use Request\Factory\RequesterRequest\RequesterRequestProxy;
use Request\Factory\Base\RealRequest;

class JORequestProxy extends RequesterRequestProxy
{
    public function setJustify(bool $justification, string $empID, string $comment) : void 
    {
        $this->realRequest->setJustify($justification,$empID,$comment);
    }
}