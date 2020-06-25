<?php
namespace Employee;

class Driver extends Employee
{
    public int $driverId;
    public string $firstName;
    public string $lastName;
    public string $licenseNumber;
    public string $licenseExpirationDay;
    public string $dateOfAdmission;
    public int $assignedVehicleId;
    public string $email;
    
    public function __construct($driverId, $firstName, $lastName, $licenseNumber, $licenseExpirationDay, $dateOfAdmission, $assignedVehicleId, $email)
    {
        //initialize state
        $this->driverId = $driverId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->licenseNumber = $licenseNumber;
        $this->licenseExpirationDay = $licenseExpirationDay;
        $this->dateOfAdmission = $dateOfAdmission;
        $this->assignedVehicleId = $assignedVehicleId;
        $this->email = $email;
    }
}