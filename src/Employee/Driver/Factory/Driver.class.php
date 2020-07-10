<?php
namespace Employee\Driver\Factory;

use DB\Controller\DriverController;
use DB\Viewer\DriverViewer;
use Employee\Employee;
use Employee\Driver\State\State;
use JsonSerializable;

class Driver extends Employee implements JsonSerializable
{
    //TODO: set attributes to private and implement a getter
    private string $driverId;
    private string $licenseType;
    private string $licenseNumber;
    private string $licenseExpirationDay;
    private string $dateOfAdmission;
    private ?int $assignedVehicleId;
    private State $state;
    
    public function __construct($driverId, $firstName, $lastName, $licenseNumber,$licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state)
    {
        parent::__construct($firstName,$lastName,$email);
        $this->driverId = $driverId;
        $this->licenseNumber = $licenseNumber;
        $this->licenseType = $licenseType;
        $this->licenseExpirationDay = $licenseExpirationDay;
        $this->dateOfAdmission = $dateOfAdmission;
        $this->assignedVehicleId = $assignedVehicleId;
        $this->state = State::getState($state);
    }

    public function getField($field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        return null;
    }
    
    public function jsonSerialize()
    {
        return ['DriverId'=>$this->getField('driverId'),
                'FirstName'=> $this->getField('firstName'),
                'LastName'=>$this->getField('lastName')
            
            ];
    }
    //IObjectHandle
    public static function getObject($ID){
        $empID=$ID;
        //get values from database
        $employeeViewer = new DriverViewer(); // method of obtaining the viewer/controller must be determined and changed
        $values=$employeeViewer->getRecordByID($empID);

        $obj = new Driver($values['DriverID'], $values['FirstName'], $values['LastName'], $values['LicenseNumber'], $values['LicenseType'], $values['LicenseExpirationDay'], $values['DateOfAdmission'],$values['AssignedVehicleID'],$values['Email'],$values['State']);
        
        return $obj; //return false, if fail
    }
  
    //IObjectHandle
    public static function getObjectByValues(array $values){
        $obj = new Driver($values['DriverID'], $values['FirstName'], $values['LastName'], $values['LicenseNumber'], $values['LicenseType'], $values['LicenseExpirationDay'], $values['DateOfAdmission'],$values['AssignedVehicleID'],$values['Email'],$values['State']);
        return $obj;
    }

    //IObjectHandle
    public static function constructObject(array $driverInfo){
        $state=State::getStateID('available'); //set using enum
        $obj = new Driver($driverInfo[0],
                        $driverInfo[1], 
                        $driverInfo[2], 
                        $driverInfo[3],
                        $driverInfo[4], 
                        $driverInfo[5], 
                        $driverInfo[6], 
                        $driverInfo[7],
                        $driverInfo[8], 
                        $state);

        $obj->saveToDatabase(); //check for failure

       return $obj; //return false, if fail
    }

    //IObjectHandle
    private function saveToDatabase(){
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
                                    $this->state); //use $this->state->getID; instead
    }

    public function setState(State $state) 
    {
        $this->state = $state;
    }
}