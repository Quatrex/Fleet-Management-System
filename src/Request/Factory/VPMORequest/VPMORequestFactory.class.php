<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;

class VPMORequestFactory
{

    /**
     * Returns the requests scheduled by the VPMO
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(VPMORequestProxy)
     */
    public static function makeScheduledRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestRecords = $requestViewer->getRequestsByIDNState($empID,$stateID);
        $requests=array();

        foreach($requestRecords as $values){
            $request = VPMORequestProxy::getRequestByValues($values);
            $request->loadObject('requester',true,$values);
            array_push($requests,VPMORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all the approved requests
     * 
     * @return array(VPMORequestPorxy)
     */
    public static function getApprovedRequests() : array
    {
        $requestViewer = new RequestViewer();
        $state = State::getStateID('justified');
        $requestRecords = $requestViewer->getRequestsbyState($state);
        $requests=array();

        foreach($requestRecords as $values){
            $request = VPMORequestProxy::getRequestByValues($values);
            array_push($requests,VPMORequestFactory::castToRequest($request));
        }

        return $requests;
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