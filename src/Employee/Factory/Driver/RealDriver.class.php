<?php
namespace Employee\Factory\Driver;

use DB\Controller\DriverController;
use Employee\Employee;
use Employee\State\Driver\State;

class RealDriver extends Employee implements Driver
{
    //TODO: set attributes to private and implement a getter
    private string $driverId;
    private string $licenseType;
    private string $licenseNumber;
    private string $licenseExpirationDay;
    private string $dateOfAdmission;
    private ?string $assignedVehicleId;
    private State $state;
    
    public function __construct($values)
    {
        parent::__construct($values);
        $this->driverId = $values['DriverID'];
        $this->licenseNumber = $values['LicenseNumber'];
        $this->licenseType = $values['LicenseType'];
        $this->licenseExpirationDay = $values['LicenseExpirationDay'];
        $this->dateOfAdmission = $values['DateOfAdmission'];
        $this->assignedVehicleId = $values['AssignedVehicleID'];
        $this->state = State::getState($values['State']);
    }

    public function getField($field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }

    public function saveToDatabase(){
        $employeeController = new DriverController();
        $employeeController->saveRecord($this->driverId,
                                    $this->firstName,
                                    $this->lastName,
                                    $this->licenseNumber,
                                    $this->licenseType,
                                    $this->licenseExpirationDay,
                                    $this->dateOfAdmission,
                                    $this->assignedVehicleId,
                                    $this->email,
                                    $this->state->getID()); //use $this->state->getID; instead
    }

    // TODO: Implement updateInfo
    public function updateInfo(array $values): void
    {

    }

    public function setState(State $state) 
    {
        $this->state = $state;
    }

    public function allocate() : void
    {
        $this->state->allocate($this);
    }

    public function deallocate() : void
    {
        $this->state->deallocate($this);
    }

    public function assignVehicle(string $registrationNo) : void
    {
        $this->assignedVehicleId = $registrationNo;
    }
}