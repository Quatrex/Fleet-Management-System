<?php 
namespace Vehicle\State;

use Vehicle\Vehicle;

abstract class State {
    //TODO: add all transitions and implement

    protected int $stateID;

    public function allocate(Vehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function deallocate(Vehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function repair(Vehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function finishRepair(Vehicle $vehicle) : void {
        echo "Invalid transition";
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
                $state=Allocated::getInstance();
                break;
            case 2:
                $state=Available::getInstance();
                break;
            case 3:
                $state=Repairing::getInstance();
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
                $stateString="allocated";
                break;
            case 2:
                $stateString="available";
                break;
            case 3:
                $stateString="repairing";
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
            case "allocated":
                $stateID=1;
                break;
            case "available":
                $stateID=2;
                break;
            case "repairing":
                $stateID=3;
                break;
            default:
                $stateID=false; //returning false in a function with a return type of int. is this appropriate?
          }
        return $stateID;
    }
}