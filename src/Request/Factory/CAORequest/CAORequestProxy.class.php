<?php
namespace Request\Factory\CAORequest;

use Request\Factory\RequesterRequest\RequesterRequestProxy;
use Request\Factory\Base\RealRequest;

class CAORequestProxy extends RequesterRequestProxy
{
    public function setApprove(bool $approval, int $empID, string $comment) : void
    {
        $this->realRequest->setApprove($approval,$empID,$comment);
    }
}