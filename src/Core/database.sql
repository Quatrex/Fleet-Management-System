CREATE TABLE `employee` (
  `EmpID` CHAR(30) NOT NULL,
  `FirstName` VARCHAR(255),
  `LastName` VARCHAR(255),
  `Position` VARCHAR(30),
  `Designation` VARCHAR(30),
  `Email` VARCHAR(50),
  `Username` VARCHAR(50),
  `Password` CHAR(64),
  `ProfilePicturePath` VARCHAR(255),
  `IsDeleted` TINYINT(1),
  PRIMARY KEY (`EmpID`)
);

CREATE TABLE `vehicle` (
  `RegistrationNo` CHAR(30) NOT NULL,
  `Model` VARCHAR(50),
  `PurchasedYear` TIMESTAMP,
  `Value` INT,
  `FuelType` VARCHAR(30),
  `InsuranceValue` VARCHAR(50),
  `InsuranceCompany` VARCHAR(100),
  `AssignedOfficer` CHAR(30),
  `State` TINYINT,
  `CurrentLocation` VARCHAR(255),
  `NumOfAllocations` INT,
  `IsLeased` TINYINT(1),
  `VehiclePicturePath` VARCHAR(50),
  `IsDeleted` TINYINT,
  PRIMARY KEY (`RegistrationNo`),
  FOREIGN KEY (AssignedOfficer) REFERENCES employee(EmpID)
);

CREATE TABLE `driver` (
  `DriverID` CHAR(30) NOT NULL,
  `FirstName` VARCHAR(255),
  `LastName` VARCHAR(255),
  `LicenseNumber` VARCHAR(30),
  `LicenseType` VARCHAR(30),
  `LicenseExpirationDay` VARCHAR(50),
  `DateOfAdmission` TIMESTAMP,
  `ProfilePicturePath` VARCHAR(255),
  `IsDeleted` TINYINT,
  `AssignedVehicle` CHAR(30),
  `State` TINYINT,
  `NumOfAllocations` INT,
  `Email` VARCHAR(50),
  PRIMARY KEY (`DriverID`),
  FOREIGN KEY (AssignedVehicle) REFERENCES vehicle(RegistrationNo)
);

CREATE TABLE `leased_vehicle` (
  `RegistrationNo` CHAR(30) NOT NULL,
  `LeasedCompany` VARCHAR(50),
  `LeasedPeriodFrom` VARCHAR(255),
  `LeasedPeriodTo` VARCHAR(30),
  `MonthlyPayment` VARCHAR(30),
  PRIMARY KEY (`RegistrationNo`)
);

CREATE TABLE `request` (
  `RequestID` INT NOT NULL,
  `CreatedDate` TIMESTAMP,
  `State` TINYINT,
  `DateOfTrip` DATE,
  `TimeOfTrip` TIME,
  `DropLocation` VARCHAR(100),
  `PickLocation` VARCHAR(100),
  `RequesterID` CHAR(30),
  `Purpose` VARCHAR(400),
  `JustifiedBy` CHAR(30),
  `JOComment` TINYTEXT,
  `ApprovedBy` CHAR(30),
  `CAOComment` TINYTEXT,
  `ScheduledBy` CHAR(30),
  `Driver` CHAR(30),
  `Vehicle` CHAR(30),
  PRIMARY KEY (`RequestID`),
  FOREIGN KEY (RequesterID) REFERENCES employee(EmpID),
  FOREIGN KEY (ApprovedBy) REFERENCES employee(EmpID),
  FOREIGN KEY (ScheduledBy) REFERENCES employee(EmpID),
  FOREIGN KEY (Driver) REFERENCES driver(DriverID),
  FOREIGN KEY (Vehicle) REFERENCES vehicle(RegistrationNo)
);