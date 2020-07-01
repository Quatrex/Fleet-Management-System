<?php
namespace Employee;

use DB\Controller\DriverController;
use DB\Viewer\DriverViewer;

class Driver extends Employee
{
    //TODO: set attributes to private and implement a getter
    private string $driverId;
    private string $licenseType;
    private string $licenseNumber;
    private string $licenseExpirationDay;
    private string $dateOfAdmission;
    private int $assignedVehicleId;
    private int $state; //change type to State
    
    public function __construct($driverId, $firstName, $lastName, $licenseNumber,$licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state)
    {
        parent::__construct($firstName,$lastName,$email);
        $this->driverId = $driverId;
        $this->licenseNumber = $licenseNumber;
        $this->licenseType = $licenseType;
        $this->licenseExpirationDay = $licenseExpirationDay;
        $this->dateOfAdmission = $dateOfAdmission;
        $this->assignedVehicleId = $assignedVehicleId;
        $this->state=$state; //assign real state object instead
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
    public static function constructObject($driverId, $firstName, $lastName, $licenseNumber,$licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email){
        $state=1; //set using enum
        $obj = new Driver($driverId, $firstName, $lastName, $licenseNumber,$licenseType, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email, $state);

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
}