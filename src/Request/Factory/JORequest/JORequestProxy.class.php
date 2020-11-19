<?php
namespace Request\Factory\JORequest;

use Request\Factory\RequesterRequest\RequesterRequestProxy;
use Request\Factory\Base\RealRequest;

class JORequestProxy extends RequesterRequestProxy
{
    public function setJustify(bool $justification, int $empID, string $comment) : void 
    {
        $this->realRequest->setJustify($justification,$empID,$comment);
    }
}