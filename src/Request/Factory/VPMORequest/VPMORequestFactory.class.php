<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;

class VPMORequestFactory
{

    /**
     * Returns all the scheduled requests
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(VPMORequestProxy)
     */
    public static function getScheduledRequests() : array
    {
        return VPMORequestFactory::getRequests('scheduled');
    }

    /**
     * Returns all the approved requests
     * 
     * @return array(VPMORequestPorxy)
     */
    public static function getApprovedRequests() : array
    {
        return VPMORequestFactory::getRequests('approved');
    }

    /**
     * Returns a request for a given id
     * 
     * @param int $requestID
     * @return Request
     */
    public static function makeRequest(int $requestID) : Request
    {
        return VPMORequestFactory::castToRequest(VPMORequestProxy::getRequestByID($requestID));
    }

     /**
     * Casts a request proxy to a request interface type
     * 
     * @param Request $requestProxy
     * @return Request
     */
    private static function castToRequest(Request $requestProxy) : Request
    {
        return $requestProxy;
    }

    /**
     * Returns all requests for a given state
     * 
     * @param string $state
     * 
     * @return array(Request)
     */
    private static function getRequests(string $state) : array
    {
        $requestViewer = new RequestViewer();
        $state = State::getStateID($state);
        $requestRecords = $requestViewer->getRequestsbyState($state);
        $requests=array();

        foreach($requestRecords as $values){
            $request = VPMORequestProxy::getRequestByValues($values);
            array_push($requests,VPMORequestFactory::castToRequest($request));
        }

        return $requests;
    }
}