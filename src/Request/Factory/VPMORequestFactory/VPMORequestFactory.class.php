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
    public static function getScheduledRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestIDs= $requestViewer->getRequestsByIDNState($empID,$stateID);
        $requests=array();

        // foreach($requestIDs as $values){
        //     $request= Request::getObjectByValues($values);
        //     array_push($requests,$request);
        // }

        return $requests;
    }

    /**
     * Returns all the approved requests
     * 
     * @return array(VPMORequestPorxy)
     */
    public static function getApprovedRequests() : array
    {
        $requests = array();
        return $requests;
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