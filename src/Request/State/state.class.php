<?php 
namespace Request\State;

use Request\Request;

abstract class State {

    protected int $stateID;

    public function cancel(Request $request) : void {
        echo "Invalid transition";
    }

    public function justify(Request $request) : void {
        echo "Invalid transition";
    }

    public function denyJustify(Request $request) : void {
        echo "Invalid transition";
    }

    public function approve(Request $request) : void {
        echo "Invalid transition";
    }

    public function denyApprove(Request $request) : void {
        echo "Invalid transition";
    }

    public function getID() : int{
        return $this->stateID;
    }

    /**
     *
     * Returns state
     *
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
     *
     * Returns stateID
     *
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