<?php
namespace Request\Factory\VPMORequestFactory;
use Request\Factory\Type\RealRequest;
use Request\Factory\RequesterRequestFactory\RequesterRequestProxy;

class VPMORequestProxy extends RequesterRequestProxy
{
    /**
     * Retruns a request object
     * 
     * @param int $id
     * @return JORequestProxy
     */
    public static function getRequestByID(int $id) : VPMORequestProxy
    {
        $realRequest = RealRequest::getObject($id);
        return new VPMORequestProxy($realRequest);
    }

    /**
     * Returns a request object
     * 
     * @param array(String) $values
     * @return JORequestProxy
     */
    public static function getRequestByValues(array $values) : VPMORequestProxy
    {
        $realRequest = RealRequest::getObjectByValues($values);
        return new VPMORequestProxy($realRequest);
    }

    public function schedule()
    {

    }

    public function close() 
    {

    }

    public function cancel() 
    {

    }
}