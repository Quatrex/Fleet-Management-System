<?php 
namespace Request\State;

use Request\Factory\Base\RealRequest;

abstract class State {

    protected int $stateID;

    public function cancel(RealRequest $request) : void {
        echo "Invalid transition cancel";
    }

    public function justify(RealRequest $request) : void {
        echo "Invalid transition justify";
    }

    public function denyJustify(RealRequest $request) : void {
        echo "Invalid transition denyJustify";
    }

    public function approve(RealRequest $request) : void {
        echo "Invalid transition approve";
    }

    public function disapprove(RealRequest $request) : void {
        echo "Invalid transition disapprove";
    }

    public function expire(RealRequest $request) : void {
        echo "Invalid transition expire";
    }

    public function schedule(RealRequest $request) : void {
        echo "Invalid transition schedule";
    }

    public function close(RealRequest $request) : void {
        echo "Invalid transition close";
    }

    public function getID() : int{
        return $this->stateID;
    }

    /**
     * Returns state
     * @param int $stateID
     * @return null|State
     */
    public static function getState(int $stateID) : ?State {
        $state=null;
        switch ($stateID) {
            case 1:
                $state=Pending::getInstance();
                break;
            case 2:
                $state=Justified::getInstance();
                break;
            case 3:
                $state=Approved::getInstance();
                break;
            case 4:
                $state=Denied::getInstance();
                break;
            case 5:
                $state=Disapproved::getInstance();
                break;
            case 6:
                $state=Cancelled::getInstance();
                break;
            case 7:
                $state=Scheduled::getInstance();
                break;
            case 8:
                $state=Completed::getInstance();
                break;
            case 9:
                $state=Expired::getInstance();
                break;
          }
        return $state;
    }
    /**
     * Returns state
     * @param int $stateID
     * @return null|String
     */
    public static function getStateString(int $stateID) : string {
        $stateString=null;
        switch ($stateID) {
            case 1:
                $stateString="Pending";
                break;
            case 2:
                $stateString="Justified";
                break;
            case 3:
                $stateString="Approved";
                break;
            case 4:
                $stateString="Denied";
                break;
            case 5:
                $stateString="Disapproved";
                break;
            case 6:
                $stateString="Cancelled";
                break;
            case 7:
                $stateString="Scheduled";
                break;
            case 8:
                $stateString="Completed";
                break;
            case 9:
                $stateString="Expired";
                break;
          }
        return $stateString;
    }

    /**
     * Returns stateID
     * @param string $stateName
     * @return int
     */
    public static function getStateID(string $stateName) : int {
        $stateID=false;
        $stateName=strtolower($stateName);
        switch ($stateName) {
            case "pending":
                $stateID=1;
                break;
            case "justified":
                $stateID=2;
                break;
            case "approved":
                $stateID=3;
                break;
            case "denied":
                $stateID=4;
                break;
            case "disapproved":
                $stateID=5;
                break;
            case "cancelled":
                $stateID=6;
                break;
            case "scheduled":
                $stateID=7;
                break;
            case "completed":
                $stateID=8;
                break;
            case 'expired':
                $stateID=9;
                break;
            default:
                $stateID=false; //returning false in a function with a return type of int. is this appropriate?
          }
        return $stateID;
    }
}