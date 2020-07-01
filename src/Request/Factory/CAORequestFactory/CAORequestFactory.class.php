<?php
namespace Request\Factory\CAORequestFactory;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;

class CAORequestFactory
{

    /**
     * Returns the requests approved by the CAO
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(CAORequestProxy)
     */
    public static function makeApprovedRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestIDs= $requestViewer->getApprovedRequestsByIDNState($empID,$stateID);
        $requests=array();

        foreach($requestIDs as $values){
            $request= CAORequestProxy::getRequestByValues($values);
            array_push($requests,CAORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all the justified requests
     * 
     * @return array(CAORequestPorxy)
     */
    public static function getJustifiedRequests() : array
    {
        $requestViewer = new RequestViewer();
        $requestRecords= $requestViewer->getJustifiedRequests();
        $requests=array();

        foreach($requestRecords as $values){
            $request= CAORequestProxy::getRequestByValues($values);
            array_push($requests,CAORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    public static function makeRequest(int $requestID) : Request
    {
        return CAORequestFactory::castToRequest(CAORequestProxy::getRequestByID($requestID));
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