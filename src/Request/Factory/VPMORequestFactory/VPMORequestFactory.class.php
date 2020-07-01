<?php
namespace Request\Factory\VPMORequestFactory;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Factory\RequesterRequestFactory\RequesterRequestFactory;
use Request\Request;

class VPMORequestFactory extends RequesterRequestFactory
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
            array_push($requests,VPMORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all the approved requests
     * 
     * @return array(VPMORequestPorxy)
     */
    public static function makeApprovedRequests() : array
    {
        $requestViewer = new RequestViewer();
        $requestRecords = $requestViewer->getApprovedRequests();
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