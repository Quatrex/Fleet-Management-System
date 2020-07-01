<?php
namespace Request\Factory\RequesterRequestFactory;

use Request\Factory\EmployeeRequestProxy;
use Request\Factory\RealRequest;

class RequesterRequestProxy extends EmployeeRequestProxy
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

    /**
     * Creates a new request object
     * 
     * @param string $dateOfTrip
     * @param string $timeOfTrip
     * @param string $dropLocation
     * @param string $pickLocation
     * @param string $requesterID
     * @param string $purpose
     * @return RequesterRequestProxy
     */
    public static function constructRequest(string $dateOfTrip,
                                            string $timeOfTrip, 
                                            string $dropLocation, 
                                            string $pickLocation, 
                                            string $requesterID, 
                                            string $purpose) : RequesterRequestProxy
    {
        $realRequest = RealRequest::constructObject($dateOfTrip,
                                                        $timeOfTrip, 
                                                        $dropLocation, 
                                                        $pickLocation, 
                                                        $requesterID, 
                                                        $purpose);
        return new RequesterRequestProxy($realRequest);
    }

    /**
     * @inheritDoc
     */
    public function cancel() : void 
    {
        $this->realRequest->cancel();
    }   
}