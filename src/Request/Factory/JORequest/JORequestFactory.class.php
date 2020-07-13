<?php
namespace Request\Factory\JORequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Factory\JORequest\JORequestProxy;
use Request\Request;

class JORequestFactory
{

    /**
     * Returns the requests justified by the JO
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(Request)
     */
    public static function makeJustifiedRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestRecords= $requestViewer->getJustifiedRequestsByIDNState($empID,$stateID);
        $requests=array();

        foreach($requestRecords as $values){
            $request= new JORequestProxy($values);
            array_push($requests,JORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all the pending requests
     * 
     * @return array(Request)
     */
    public static function makePendingRequests() : array
    {
        $requestViewer = new RequestViewer();
        $state = State::getStateID('pending');
        $requestIDs= $requestViewer->getRequestsbyState($state);
        $requests=array();

        foreach($requestIDs as $values){
            $request= new JORequestProxy($values);
            $request->loadObject('requester',true,$values);
            array_push($requests,JORequestFactory::castToRequest($request));
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
        $requestViewer = new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $requestViewer->getRecordByID($requestID);

        return JORequestFactory::castToRequest(new JORequestProxy($values));
    }

     /**
     * Casts a request proxy to a request interface type
     * 
     * @param Request $requestProxy
     * @return Request
     */
    protected static function castToRequest(Request $requestProxy) : Request
    {
        return $requestProxy;
    }
}