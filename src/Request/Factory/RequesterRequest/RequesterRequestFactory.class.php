<?php
namespace Request\Factory\RequesterRequest;

use Request\State\State;
use DB\Viewer\RequestViewer;
use DB\Controller\RequestController;
use Request\Request;

class RequesterRequestFactory
{
    /**
     * Returns the requests made by the requester
     * 
     * @param int $empID
     * @param string $stateString
     * @return array(Request)
     */
    public static function makeRequests(int $empID, array $states) : array
    {
        $requestViewer = new RequestViewer();
        $stateIDs =  array_map(function($state) { return State::getStateID($state); }, $states);
        $requestRecords = $requestViewer->getRequestsByIDNState($empID,$stateIDs);
        $requests=array();

        foreach($requestRecords as $values){
            $request = new RequesterRequestProxy($values);
            array_push($requests,self::castToRequest($request));
        }

        return $requests;
    }

    public static function makeRequest(int $requestID) : Request
    {
        //get values from database
        $requestViewer = new requestViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values = $requestViewer->getRecordByID($requestID);

        return self::castToRequest(new RequesterRequestProxy($values));
    }


    /**
     * Creates a new request
     * 
     * @return Request
     */
    public static function makeNewRequest($values) : Request
    {
        $values['CreatedDate'] = date("Y-m-d");
        $values['State'] = State::getStateID('pending');
        $values['RequestID'] = -1;
        $values['JustifiedBy'] = null;
        $values['ApprovedBy'] = null;
        $values['ScheduledBy'] = null;
        $values['JOComment'] = "";
        $values['CAOComment'] = "";
        $values['Driver'] = null;
        $values['Vehicle'] = null;
        
        $request = new RequesterRequestProxy($values);
        $request->saveToDatabase(); //check for failure
        $request->noitfyNewRequest();

        return self::castToRequest($request); //return false, if fail
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