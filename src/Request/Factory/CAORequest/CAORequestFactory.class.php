<?php
namespace Request\Factory\CAORequest;

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
     * @return array(Request)
     */
    public static function makeApprovedRequests(int $empID, string $stateString) : array
    {
        $requestViewer = new RequestViewer();
        $stateID = State::getStateID($stateString);
        $requestIDs= $requestViewer->getApprovedRequestsByIDNState($empID,$stateID);
        $requests=array();

        foreach($requestIDs as $values){
            $request = new CAORequestProxy($values);
            $request->loadObject('requester',true,$values);
            array_push($requests,CAORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all the justified requests
     * 
     * @return array(Request)
     */
    public static function makeJustifiedRequests() : array
    {
        $requestViewer = new RequestViewer();
        $state = State::getStateID('justified');
        $requestRecords= $requestViewer->getRequestsbyState($state);
        $requests=array();

        foreach($requestRecords as $values){
            $request= new CAORequestProxy($values);
            array_push($requests,CAORequestFactory::castToRequest($request));
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
        //get values from database
        $requestViewer = new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $requestViewer->getRecordByID($requestID);

        return CAORequestFactory::castToRequest(new CAORequestProxy($values));
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
}