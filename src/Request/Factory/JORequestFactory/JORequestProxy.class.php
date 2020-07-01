<?php
namespace Request\Factory\JORequestFactory;

use Request\Factory\RequesterRequestFactory\RequesterRequestProxy;
use Request\Factory\RealRequest;

class JORequestProxy extends RequesterRequestProxy
{
    /**
     * Retruns a request object
     * 
     * @param int $id
     * @return JORequestProxy
     */
    public static function getRequestByID(int $id) : JORequestProxy
    {
        $realRequest = RealRequest::getObject($id);
        return new JORequestProxy($realRequest);
    }

    /**
     * Returns a request object
     * 
     * @param array(String) $values
     * @return JORequestProxy
     */
    public static function getRequestByValues(array $values) : JORequestProxy
    {
        $realRequest = RealRequest::getObjectByValues($values);
        return new JORequestProxy($realRequest);
    }

    public function setJustify(bool $justification, int $empID, string $comment, string $position) : void 
    {
        $this->realRequest->setJustify($justification,$empID,$comment,$position);
    }
}