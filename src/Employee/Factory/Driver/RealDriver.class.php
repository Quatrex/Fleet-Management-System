<?php
namespace Employee\Factory\Driver;

use DB\Controller\DriverController;
use Employee\Employee;
use Employee\State\Driver\State;
use Exception;
use Request\Factory\VPMORequest\VPMORequestFactory;

class RealDriver extends Employee implements Driver
{
    //TODO: set attributes to private and implement a getter
    private string $driverId;
    private string $licenseNumber;
    private string $licenseType; 
    private string $licenseExpirationDay;
    private string $dateOfAdmission;
    private ?string $assignedVehicle;
    private State $state;
    private int $numOfAllocations;
    private ?array $assignedRequests;
    private ?string $imagePath;
    
    public function __construct($values)
    {
        parent::__construct($values);
        $this->driverId = $values['DriverID'];
        $this->licenseNumber = $values['LicenseNumber'];
        $this->licenseType = $values['LicenseType'];
        $this->licenseExpirationDay = $values['LicenseExpirationDay'];
        $this->dateOfAdmission = $values['DateOfAdmission'];
        $this->assignedVehicle = $values['AssignedVehicle'];
        $this->state = State::getState($values['State']);
        $this->numOfAllocations=$values['NumOfAllocations'];
        $this->assignedRequests=null;
        $this->imagePath=$values['ProfilePicturePath'];
    }


    public function getField($field)
    {
        if (property_exists($this, $field)) {
            $noIDObjectFields = ['assignedRequests'];
            if (in_array($field, $noIDObjectFields)) {
                if ($this->$field === null)
                    $this->loadObject($field);
                return $this->$field;
            }
           
            return $this->$field;
        }
        if ($field === 'state') return State::getStateString($this->state->getID());
        
        return null;
    }

    /**
     * Loads a specified object without a reference to it
     * 
     * @param string $objectName
     * @param bool $byValue default => false
     * @param array $values default => [ ]
     */
    public function loadObject(string $objectName, bool $byValue = false, array $values = array())
    {
        switch ($objectName) {
            case 'assignedRequests':
                if($byValue){
                    throw new Exception("Cannot load assignedRequests by value");
                }
                else{
                    $this->assignedRequests = VPMORequestFactory::makeAssignedRequests($this->driverId,"driver");
                }
                
                break;
            default:
                throw new Exception("Invalid parameter $objectName for AbstractVehicle::loadNoIDObject");
        }
    }

    public function saveToDatabase(){
        $driverController = new DriverController();
        $driverController->saveRecord($this->driverId,
                                    $this->firstName,
                                    $this->lastName,
                                    $this->licenseNumber,
                                    $this->licenseType,
                                    $this->licenseExpirationDay,
                                    $this->dateOfAdmission,
                                    $this->assignedVehicle,
                                    $this->email,
                                    $this->state->getID(),
                                    $this->numOfAllocations); 
    }

    public function updateInfo(array $values): void
    {
        //changed driver attributes can be analysed here

        $this->driverId = $values['NewDriverID'];
        $this->firstName = $values['FirstName'];
        $this->lastName = $values['LastName'];
        $this->licenseNumber = $values['LicenseNumber'];
        $this->licenseType = $values['LicenseType'];
        $this->licenseExpirationDay = $values['LicenseExpirationDay'];
        $this->dateOfAdmission = $values['DateOfAdmission'];
        $this->assignedVehicle = $values['AssignedVehicle'];
        $this->email = $values['Email'];

        $driverController = new DriverController();
        $driverController->updateDriverInfo(
            $values['DriverID'],
            $this->driverId,
            $this->firstName,
            $this->lastName,
            $this->licenseNumber,
            $this->licenseType,
            $this->licenseExpirationDay,
            $this->dateOfAdmission,
            $this->assignedVehicle,
            $this->email
        );
    }

    public function updatePicture(string $imagePath): void
    {
        $this->imagePath=$imagePath;
        $driverController = new DriverController();
        $driverController->updateDriverPicture(
            $this->driverId,
            $this->imagePath
        );
    }

    public function deleteDriver(string $driverID): void
    {
        $driverController = new DriverController();
        $driverController->deleteDriver($driverID);
    }

    public function setState(State $state) 
    {
        $this->state = $state;
    }

    public function allocate() : void
    {
        $this->numOfAllocations += 1;
        $driverController = new DriverController();
        $driverController->updateNumOfAllocations($this->driverId, $this->numOfAllocations);

        if ($this->numOfAllocations > 0) {
            $this->state->allocate($this);
        }
    }

    public function deallocate() : void
    {
        $this->numOfAllocations -= 1;
        $driverController = new DriverController();
        $driverController->updateNumOfAllocations($this->driverId, $this->numOfAllocations);

        if ($this->numOfAllocations == 0) {
            $this->state->deallocate($this);
        }
    }

    public function assignVehicle(string $registrationNo) : void
    {
        $this->assignedVehicle = $registrationNo;

        $driverController = new DriverController();
        $driverController->updateAssignedVehicle(
            $this->driverId,
            $this->assignedVehicle
        );
    }
}