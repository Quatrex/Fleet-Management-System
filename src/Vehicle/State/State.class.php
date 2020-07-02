<?php 
namespace Vehicle\State;

use Vehicle\Factory\Base\AbstractVehicle;

abstract class State {
    //TODO: add all transitions and implement

    protected int $stateID;

    public function allocate(AbstractVehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function deallocate(AbstractVehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function repair(AbstractVehicle $vehicle) : void {
        echo "Invalid transition";
    }

    public function finishRepair(AbstractVehicle $vehicle) : void {
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
                $state=Available::getInstance();
                break;
            case 2:
                $state=Allocated::getInstance();
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
    public static function getStateString(int $stateID) : string {
        $stateString=null;
        switch ($stateID) {
            case 1:
                $stateString="Available";
                break;
            case 2:
                $stateString="Allocated";
                break;
            case 3:
                $stateString="Repairing";
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
            case "Available":
                $stateID=1;
                break;
            case "Allocated":
                $stateID=2;
                break;
            case "Repairing":
                $stateID=3;
                break;
            default:
                $stateID=false; //returning false in a function with a return type of int. is this appropriate?
          }
        return $stateID;
    }
}