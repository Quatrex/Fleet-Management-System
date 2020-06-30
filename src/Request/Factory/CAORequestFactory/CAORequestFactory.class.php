<?php
namespace Request\Factory\CAORequestFactory;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Factory\RequesterRequestFactory\RequesterRequestFactory;
use Request\Request;

class CAORequestFactory extends RequesterRequestFactory
{

    /**
     * Returns the requests approved by the CAO
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(CAORequestProxy)
     */
    public static function getApprovedRequests(int $empID, string $stateString) : array
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
     * Returns all the justified requests
     * 
     * @return array(CAORequestPorxy)
     */
    public static function getJustifiedRequests() : array
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