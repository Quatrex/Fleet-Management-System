<?php
namespace Request\Factory\JORequestFactory;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Factory\RequesterRequestFactory\RequesterRequestFactory;

class JORequestFactory extends RequesterRequestFactory
{

    /**
     * Returns the requests justified by the JO
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(JORequestProxy)
     */
    public static function getJustifiedRequests(int $empID, string $stateString) : array
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
     * Returns all the pending requests
     * 
     * @return array(JORequestProxy)
     */
    public static function getPendingRequests() : array
    {
        $requests = array();
        return $requests;
    }
}