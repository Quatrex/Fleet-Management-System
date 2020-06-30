<?php
namespace Request\Factory\JORequestFactory;

use Request\Factory\Type\RealRequest;
use Request\Factory\RequesterRequestFactory\RequesterRequestProxy;

class JORequestProxy extends RequesterRequestProxy
{
    /**
     * Retruns a request object
     * 
     * @param int $id
     * @return RequesterRequestProxy
     */
    public static function getRequestByID(int $id) : RequesterRequestProxy
    {
        $realRequest = RealRequest::getObject($id);
        return new RequesterRequestProxy($realRequest);
    }

    /**
     * Returns a request object
     * 
     * @param array(String) $values
     * @return RequesterRequestProxy
     */
    public static function getRequestByValues(array $values) : RequesterRequestProxy
    {
        $realRequest = RealRequest::getObjectByValues($values);
        return new RequesterRequestProxy($realRequest);
    }

    public function justify() 
    {

    }

    public function deny() 
    {

    }
}