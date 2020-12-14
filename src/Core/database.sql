CREATE TABLE `employee` (
  `EmpID` CHAR(30) NOT NULL,
  `FirstName` VARCHAR(255),
  `LastName` VARCHAR(255),
  `Position` VARCHAR(30),
  `Designation` VARCHAR(200),
  `ContactNumber` VARCHAR(15),
  `Email` VARCHAR(50),
  `Password` CHAR(64),
  `ProfilePicturePath` VARCHAR(255),
  `IsDeleted` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`EmpID`)
);

CREATE TABLE `vehicle` (
  `RegistrationNo` CHAR(30) NOT NULL,
  `Model` VARCHAR(50),
  `PurchasedYear` DATE,
  `Value` INT,
  `FuelType` VARCHAR(30),
  `InsuranceValue` VARCHAR(50),
  `InsuranceCompany` VARCHAR(100),
  `AssignedOfficer` CHAR(30),
  `State` TINYINT(10),
  `CurrentLocation` VARCHAR(255),
  `NumOfAllocations` INT,
  `IsLeased` TINYINT(1),
  `VehiclePicturePath` VARCHAR(255),
  `IsDeleted` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`RegistrationNo`),
  FOREIGN KEY (AssignedOfficer) REFERENCES employee(EmpID) ON UPDATE CASCADE
);

CREATE TABLE `driver` (
  `DriverID` CHAR(30) NOT NULL,
  `FirstName` VARCHAR(255),
  `LastName` VARCHAR(255),
  `LicenseNumber` VARCHAR(30),
  `LicenseType` VARCHAR(30),
  `LicenseExpirationDay` VARCHAR(50),
  `DateOfAdmission` DATE,
  `ProfilePicturePath` VARCHAR(255),
  `IsDeleted` TINYINT(1) DEFAULT 0,
  `AssignedVehicle` CHAR(30),
  `State` TINYINT,
  `NumOfAllocations` INT,
  `Email` VARCHAR(50),
  PRIMARY KEY (`DriverID`),
  FOREIGN KEY (AssignedVehicle) REFERENCES vehicle(RegistrationNo) ON UPDATE CASCADE
);

CREATE TABLE `leased_vehicle` (
  `RegistrationNo` CHAR(30) NOT NULL,
  `LeasedCompany` VARCHAR(50),
  `LeasedPeriodFrom` VARCHAR(255),
  `LeasedPeriodTo` VARCHAR(30),
  `MonthlyPayment` VARCHAR(30),
  PRIMARY KEY (`RegistrationNo`),
  FOREIGN KEY (RegistrationNo) REFERENCES vehicle(RegistrationNo) ON UPDATE CASCADE
);

CREATE TABLE `request` (
  `RequestID` INT NOT NULL AUTO_INCREMENT,
  `CreatedDate` DATE,
  `State` TINYINT(10),
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
  FOREIGN KEY (RequesterID) REFERENCES employee(EmpID) ON UPDATE CASCADE,
  FOREIGN KEY (ApprovedBy) REFERENCES employee(EmpID) ON UPDATE CASCADE,
  FOREIGN KEY (ScheduledBy) REFERENCES employee(EmpID) ON UPDATE CASCADE,
  FOREIGN KEY (Driver) REFERENCES driver(DriverID) ON UPDATE CASCADE,
  FOREIGN KEY (Vehicle) REFERENCES vehicle(RegistrationNo) ON UPDATE CASCADE
);