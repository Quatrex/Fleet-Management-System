<?php
namespace Request\Factory\JORequest;

use Request\Factory\RequesterRequest\RequesterRequestProxy;
use Request\Factory\Base\RealRequest;

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

    public function setJustify(bool $justification, int $empID, string $comment) : void 
    {
        $this->realRequest->setJustify($justification,$empID,$comment);
    }

    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        $this->realRequest->loadObject($objectName, $byValue, $values);
    }
}