<?php

namespace Request\Factory\Base;

use DB\Viewer\RequestViewer;
use DB\Controller\RequestController;
use DB\IObjectHandle;
use Request\State\State;
use Request\Request;
use Employee\Driver\Factory\Driver;
use Employee\JO;
use Employee\CAO;
use employee\VPMO;
use Employee\Requester;
use Vehicle\Vehicle;
use EmailClient\EmailClient;
use EmailClient\INotifiableRequest;
use Employee\Driver\Factory\DriverFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\Base\VehicleFactory;

class RealRequest implements Request, INotifiableRequest
{
    //ToDO: make attributes private and use get/set methods
    private int $requestID;
    private ?string $createdDate; //how to handle 'date' in php? 
    private ?State $state;
    private string $dateOfTrip; //how to handle 'date' in php? 
    private string $timeOfTrip; //how to handle 'time' in php? 
    private string $dropLocation;
    private string $pickLocation;
    private array $requester; //EmpID
    private ?string $purpose;
    private array $justifiedBy; //EmpID
    private array $approvedBy; //EmpID
    private array $scehduledBy; //EmpID
    private ?string $JOComment;
    private ?string $CAOComment;
    private array $driver;
    private array $vehicle;

    public function __construct(array $values)
    {

        //initialize state
        //TODO: vehicle,drive,scheduledby initialization
        $this->requestID = $values['RequestID'];
        $this->createdDate = $values['CreatedDate'];
        $this->state = State::getState($values['State']);;
        $this->dateOfTrip = $values['DateOfTrip'];
        $this->timeOfTrip = $values['TimeOfTrip'];
        $this->dropLocation = $values['DropLocation'];
        $this->pickLocation = $values['PickLocation'];
        $this->requester = array('ID' => $values['RequesterID'], 'object' => null);
        $this->purpose = $values['Purpose'];
        $this->justifiedBy = array("ID" => $values['JustifiedBy'], "object" => null);
        $this->approvedBy = array("ID" => $values['ApprovedBy'], "object" => null);
        $this->scehduledBy = array("ID" => $values['ScheduledBy'], "object" => null);
        $this->JOComment = $values['JOComment'];
        $this->CAOComment = $values['CAOComment'];
        $this->driver = array("ID" => $values['Driver'], "object" => null);
        $this->vehicle = array("ID" => $values['Vehicle'], "object" => null);
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function setJustify(bool $justification, int $empID, string $comment): void
    {
        $this->justifiedBy['ID'] = $empID;
        $this->JOComment = $comment;
        $stateID=null;

        if ($justification) {
            $this->state->justify($this);
            $requestController = new RequestController();
            $stateID = State::getStateID('justified');
        } else {
            $this->state->denyJustify($this);
            $requestController = new RequestController();
            $stateID = State::getStateID('denied');
        }

        $requestController->justifyRequest(
            $this->requestID,
            $this->JOComment,
            $this->justifiedBy['ID'],
            $stateID
        );
    }

    public function setApprove(bool $approval, int $empID, string $comment): void
    {
        $this->approvedBy['ID'] = $empID;
        $this->CAOComment = $comment;
        $stateID=null;

        if ($approval) {
            $this->state->approve($this);
            $requestController = new RequestController();
            $stateID = State::getStateID('approved');
        } else {
            $this->state->disapprove($this);
            $requestController = new RequestController();
            $stateID = State::getStateID('denied');
        }

        $requestController->approveRequest(
            $this->requestID,
            $this->CAOComment,
            $this->approvedBy['ID'],
            $stateID
        );
    }

    public function schedule(string $empID, string $driver, string $vehicle) : void{
        $this->scehduledBy['ID'] = $empID;
        $this->driver['ID'] = $driver;
        $this->vehicle['ID'] = $vehicle;

        $this->state->schedule($this);
        $requestController = new RequestController();
        $stateID = State::getStateID('scheduled');

        $requestController->scheduleRequest(
            $this->requestID,
            $this->scehduledBy['ID'],
            $this->driver['ID'],
            $this->vehicle['ID'],
            $stateID
        );
    }

    public function close(): void
    {
        $this->state->close($this);
        $requestController = new RequestController();
        $stateID = State::getStateID('completed');

        $requestController->closeRequest(
            $this->requestID,
            $stateID
        );
    }

    public function cancel(): void
    {
        $this->state->cancel($this);
        $requestController = new RequestController();
        $stateID = State::getStateID('cancelled');
        $requestController->updateState($this->requestID, $stateID);
    }

    public function getField($field)
    {
        if (property_exists($this, $field)) {
            $objectFields = ['requester', 'justifiedBy', 'approvedBy', 'scehduledBy', 'driver', 'vehicle'];
            if (in_array($field, $objectFields)) {
                if ($this->$field['ID'] === null)
                    return null;
                if ($this->$field['object'] === null)
                    $this->loadObject($field);
                return $this->$field['object'];
            } else {
                return $this->$field;
            }
        }
        return null;
    }

    /**
     * Loads a specified object
     * 
     * @param string $objectName
     * @param bool $byValue default => false
     * @param array $values default => [ ]
     */
    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        $objectName = strtolower($objectName);
        switch ($objectName) {
            case "requester":
                $this->requester['object'] = $byValue ? Requester::getObjectByValues($values) 
                                                : Requester::getObject($this->requester["ID"]);
            break;

            case "jo":
                $this->justifiedBy['object'] = $byValue ? JO::getObjectByValues($values)
                                                : JO::getObject($this->justifiedBy["ID"]);
            break;

            case "cao":
                $this->approvedBy['object'] = $byValue ? CAO::getObjectByValues($values)
                                                : CAO::getObject($this->approvedBy["ID"]);
            break;

            case "vpmo":
                $this->scehduledBy['object'] = $byValue ? VPMO::getObjectByValues($values)
                                                : VPMO::getObject($this->scehduledBy["ID"]);
            break;

            case "vehicle":
                $this->vehicle['object'] = $byValue ? $this->constructVehicleObject(true,$values)
                                                : $this->constructVehicleObject(false);
            break;

            case 'driver':
                $this->driver['object'] = $byValue ? DriverFactory::makeDriverByValues($values) 
                                                : DriverFactory::makeDriver($this->driver['ID']);
            break;

        }
    }

    /**
     * Creates a vehice object by either values or ID
     * 
     * @param array $values
     * @param bool $byValue
     * 
     * @return Vehicle
     */
    private function constructVehicleObject(bool $byValue,array $values = []) : Vehicle
    {
        if ($byValue)
        {
            if ($values['isLeased'])
            {
                $leasedVehicleFactory = LeasedVehicleFactory::getInstance();
                $vehicle = $leasedVehicleFactory->makeVehicleByValues($values);
            } 
            else 
            {
                $purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
                $vehicle = $purchasedVehicleFactory->makeVehicleByValues($values);
            }
            
        }
        else
        {
            // print_r($this->vehicle['ID']);
            $vehicle = VehicleFactory::getVehicle($this->vehicle['ID']);
        }
        return $vehicle;
    }
}