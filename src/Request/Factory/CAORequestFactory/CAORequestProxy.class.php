<?php
namespace Request\Factory\CAORequestFactory;

use Request\Factory\RequesterRequestFactory\RequesterRequestProxy;
use Request\Factory\RealRequest;

class CAORequestProxy extends RequesterRequestProxy
{
    /**
     * Retruns a request object
     * 
     * @param int $id
     * @return RequesterRequestProxy
     */
    public static function getRequestByID(int $id) : CAORequestProxy
    {
        $realRequest = RealRequest::getObject($id);
        return new CAORequestProxy($realRequest);
    }

    /**
     * Returns a request object
     * 
     * @param array(String) $values
     * @return RequesterRequestProxy
     */
    public static function getRequestByValues(array $values) : CAORequestProxy
    {
        $realRequest = RealRequest::getObjectByValues($values);
        return new CAORequestProxy($realRequest);
    }

    public function setApprove(bool $approval, int $empID, string $comment, string $position) : void
    {
        $this->realRequest->setApprove($approval,$empID,$comment, $position);
    }
}