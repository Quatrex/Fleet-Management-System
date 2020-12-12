<?php
namespace Request\Factory\VPMORequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use Request\Request;
use Exception;

class VPMORequestFactory
{
    /**
     * Returns the requests scheduled by the VPMO
     * 
     * @param string $empID
     * @param string $stateString
     * @return array(Request)
     */
    public static function makeScheduledRequests(string $empID, array $states, int $offset, array $sort, array $search) : array
    {
        $requestViewer = new RequestViewer();
        $stateIDs =  array_map(function($state) { return State::getStateID($state); }, $states);
        $requestRecords= $requestViewer->getScheduledRequestsByIDNState($empID,$stateIDs,$offset,$sort,$search);
        $requests=array();

        foreach($requestRecords as $values){
            $request= new VPMORequestProxy($values);
            array_push($requests,self::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns all requests for a given state
     * 
     * @param string $state
     * 
     * @return array(Request)
     */
    public static function makeRequests(array $states, int $offset, array $sort, array $search) : array
    {
        $acceptedStates = ['scheduled', 'approved', 'completed', 'cancelled'];
        foreach ($states as $state)
            if (!in_array($state, $acceptedStates))
                throw new Exception('Invalid state parameter');

        $requestViewer = new RequestViewer();
        $stateIDs =  array_map(function($state) { return State::getStateID($state); }, $states);
        $requestRecords = $requestViewer->getRequestsbyState($stateIDs,$offset,$sort,$search);
        $requests=array();

        foreach($requestRecords as $values){
            $request = new VPMORequestProxy($values);
            array_push($requests,VPMORequestFactory::castToRequest($request));
        }

        return $requests;
    }

    /**
     * Returns assigned requests for a vehicle
     * 
     * @param string $registrationNo
     * @return Request
     */
    public static function makeAssignedRequests(string $id, string $type)
    {
        $state = State::getStateID('scheduled');
        $requestViewer = new RequestViewer();
        switch ($type)
        {
            case 'driver':
                $requestRecords = $requestViewer->getRequestsByDriver($id,$state);
                break;

            case 'vehicle':
                $requestRecords = $requestViewer->getRequestsByVehicle($id,$state);
                break;
        }
        $requests = [];
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