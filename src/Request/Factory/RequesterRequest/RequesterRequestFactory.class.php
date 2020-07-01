<?php
namespace Request\Factory\RequesterRequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;

class RequesterRequestFactory
{
    /**
     * Returns the requests made by the requester
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(Request)
     */
    public static function getRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestRecords = $requestViewer->getRequestsByIDNState($empID,$stateID);
        $requests=array();

        foreach($requestRecords as $values){
            $request = RequesterRequestProxy::getRequestByValues($values);
            array_push($requests,RequesterRequestFactory::castToRequest($request));
        }

        return $requests;
    }

    public static function getRequest(int $requestID) : Request
    {
        return RequesterRequestFactory::castToRequest(RequesterRequestProxy::getRequestByID($requestID));
    }


    /**
     * Creates a new request
     * 
     * @return Request
     */
    public static function makeRequest(string $dateOfTrip, 
                                        string $timeOfTrip, 
                                        string $dropLocation,
                                        string $pickLocation,
                                        string $empID,
                                        string $purpose) : Request
    {
        return RequesterRequestFactory::castToRequest(RequesterRequestProxy::constructRequest($dateOfTrip,
                                                                                                $timeOfTrip,
                                                                                                $dropLocation,
                                                                                                $pickLocation,
                                                                                                $empID,
                                                                                                $purpose));
    }


    /**
     * casts a request proxy to a request interface type
     * 
     * @param Request $requestProxy
     * @return Request
     */
    private static function castToRequest(Request $requestProxy) : Request
    {
        return $requestProxy;
    }
}