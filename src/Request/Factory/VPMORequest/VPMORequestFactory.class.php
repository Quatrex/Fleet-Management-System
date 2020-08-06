<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;
use Exception;

class VPMORequestFactory
{
    /**
     * Returns all requests for a given state
     * 
     * @param string $state
     * 
     * @return array(Request)
     */
    public static function makeRequests(string $state) : array
    {
        $acceptedStates = ['scheduled', 'approved', 'completed','cancelled'];
        if (!in_array($state, $acceptedStates))
            throw new Exception('Invalid state parameter');

        $requestViewer = new RequestViewer();
        $state = State::getStateID($state);
        $requestRecords = $requestViewer->getRequestsbyState($state);
        $requests=array();

        foreach($requestRecords as $values){
            $request = new VPMORequestProxy($values);
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
        $requestViewer = new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $requestViewer->getRecordByID($requestID);

        return VPMORequestFactory::castToRequest(new VPMORequestProxy($values));
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