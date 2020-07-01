<?php 
namespace Request\State;

use Request\Factory\RealRequest;

abstract class State {
    //TODO: add all transitions and implement

    protected int $stateID;

    public function cancel(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function justify(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function denyJustify(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function approve(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function disapprove(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function expire(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function schedule(RealRequest $request) : void {
        echo "Invalid transition";
    }

    public function close(RealRequest $request) : void {
        echo "Invalid transition";
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
                $state=Cancelled::getInstance();
                break;
            case 6:
                $state=Scheduled::getInstance();
                break;
            case 7:
                $state=Completed::getInstance();
                break;
          }
        return $state;
    }
    /**
     * Returns state
     * @param int $stateID
     * @return null|String
     */
    public static function getStateString(int $stateID) : ?State {
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
                $stateString="Cancelled";
                break;
            case 6:
                $stateString="Scheduled";
                break;
            case 7:
                $stateString="Completed";
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
            case "cancelled":
                $stateID=5;
                break;
            case "scheduled":
                $stateID=6;
                break;
            case "completed":
                $stateID=7;
                break;
            default:
                $stateID=false; //returning false in a function with a return type of int. is this appropriate?
          }
        return $stateID;
    }
}