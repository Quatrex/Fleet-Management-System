<!--Popups- employee add form-->
<div class="popup" id="EmployeeAddForm">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="EmployeeAddForm_Close">&times;</span>
            <h2>Add Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="AddEmployee_form">
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Employee ID" type="text" name="newEmployeeId" required>
                        <div id="newEmployeeId-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="First Name" type="text" name="firstName" required>
                        <div id="firstName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Last Name" type="text" name="lastName" required>
                        <div id="lastName-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <select class="custom-select inputs" name="position" id="position-select" required>
                            <option selected>Account Type</option>
                            <option value="Requester">Requester</option>
                            <option value="VPMO">VPMO</option>
                            <option value="JO">JO</option>
                            <option value="CAO">CAO</option>
                            <option value="DCAO">DCAO</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                        <div id="position-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Designation" id="employee-designation" type="text" name="designation" required>
                        <div id="designation-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input type="number" name="contactNo" class="form-control inputs" placeholder="Contact Number" required>
                        <div id="contactNo-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control inputs" placeholder="Email" type="text" required>
                        <div id="email-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="password" class="form-control inputs" placeholder="Password" type="password" required>
                        <div id="password-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="confirmPassword" class="form-control inputs" placeholder="Confirm Password" type="password" required>
                        <div id="confirmPassword-error" class="text-danger"></div>

                    </div>
                    <input type="button" value="Submit" class="btn btn-success" id="EmployeeAddForm_Confirm">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Employee Profile Form-->
<div class="popup" id="EmployeeProfileForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="EmployeeProfileForm_Close">&times;</span>
            <h2>Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image" id="ProfilePicturePath-EmployeeProfileForm">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="EmployeeProfile_form">
                        <div class="form-group-row mb-4">
                            <label>Employee ID</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border inputs" id="empID-EmployeeProfileForm" type="text" name="employeeID" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="FirstName-EmployeeProfileForm" type="text" name="firstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LastName-EmployeeProfileForm" type="text" name="lastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Designation-EmployeeProfileForm" type="text" name="designation" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="ContactNo-EmployeeProfileForm" type="text" name="contactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Email-EmployeeProfileForm" type="text" name="email" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="button" value="Edit" class="btn btn-primary" id="EmployeeProfileForm_Edit">
                    <input type="button" class="btn btn-danger" value="Delete" id="EmployeeProfileForm_Delete">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Employee Edit Profile Form-->
<div class="popup" id="EmployeeProfileEditForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="EmployeeProfileEditForm_Close">&times;</span>
            <h2>Edit Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateEmployee_form">
                        <div class="form-group-row mb-4">
                            <label>Employee ID</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border inputs" id="empID-EmployeeProfileEditForm" type="text" name="empID" required>
                                <div id="empID-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="FirstName-EmployeeProfileEditForm" type="text" name="FirstName" required>
                                    <div id="FirstName-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LastName-EmployeeProfileEditForm" type="text" name="LastName" required>
                                    <div id="LastName-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Designation-EmployeeProfileEditForm" type="text" name="Designation" required>
                                    <div id="Designation-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="ContactNo-EmployeeProfileEditForm" type="text" name="ContactNo" required>
                                    <div id="ContactNo-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Email-EmployeeProfileEditForm" type="text" name="Email" required>
                                    <div id="Email-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="EmployeeProfileEditForm_Confirm" disabled></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="EmployeeProfileEditForm_Cancel">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Delete Employee Alert-->
<div class="popup" id="DeleteEmployeeAlertPopup">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DeleteEmployeeAlert_Close">&times;</span>
            <h3>Delete Employee</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p>Are you sure you want to delete employee?</p>
            <input type="button" value="Yes" class="btn btn-danger" id="DeleteEmployeeAlert_Delete">
            <input type="button" value="No" class="btn btn-primary" id="DeleteEmployeeAlert_Cancel">
        </div>
    </div>
</div>

<!--Popups- driver add form-->
<div class="popup" id="DriverAddForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DriverAddForm_Close">&times;</span>
            <h2>Add Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="AddDriver_form">
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Driver ID" type="text" name="driverId" required>
                        <div id="driverId-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="First Name" type="text" name="firstName" required>
                        <div id="firstName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Last Name" type="text" name="lastName" required>
                        <div id="lastName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Email" type="text" name="email" required>
                        <div id="email-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Address" type="text" name="address" required>
                        <div id="address-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="contactNo" class="form-control inputs" placeholder="Contact Number" required>
                        <div id="contactNo-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="employedDate" class="form-control inputs" placeholder="Employed Date" type="date">
                        <div id="employedDate-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="licenseNo" class="form-control inputs" placeholder="License Number" type="text" required>
                        <div id="licenseNo-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="licenseType" class="form-control inputs" placeholder="License Type" type="text" required>
                        <div id="licenseType-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="licenseExpireDate" class="form-control inputs" placeholder="License Expire Data" type="date">
                        <div id="licenseExpireDate-error" class="text-danger"></div>
                    </div>
                    <input type="button" value="Submit" class="btn btn-success" id="DriverAddForm_Confirm">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Driver profile Form-->
<div class="popup" id="DriverProfileForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DriverProfileForm_Close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="DriverProfile_form">
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="driverId-DriverProfileForm" type="text" name="DriverID" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="employedDate-DriverProfileForm" type="date" name="DateOfAdmission" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="firstName-DriverProfileForm" type="text" name="FirstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="lastName-DriverProfileForm" type="text" name="LastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4 mx-auto">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border" id="address-DriverProfileForm" type="text" name="Address" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="assignedVehicleID-DriverProfileForm" type="text" name="AssignedVehicle" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="contactNo-DriverProfileForm" type="text" name="ContactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="email-DriverProfileForm" type="text" name="Email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="licenseID-DriverProfileForm" type="text" name="LicenseNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border " id="licenseType-DriverProfileForm" type="text" name="LicenseType" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="licenseExpDate-DriverProfileForm" type="text" name="LicenseExpirationDay" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="button" value="Edit" class="btn btn-primary" id="DriverProfileForm_Edit">
                    <input type="button" value="Delete" class="btn btn-danger" id="DriverProfileForm_Delete">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Driver profile Form-->
<div class="popup" id="DriverProfileEditForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DriverProfileEditForm_Close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateDriver_form">
                        <div class="center" style="text-align: center; ">
                            <img src='../images/default-user-image.png' id="driverImagePath-DriverProfileEditForm" class="form-image" style="padding:5px; width:50%;text-align: center;">
                        </div>
                        <div class="overlay">
                            <i class="fa fa-camera upload-button" data-input='ChangeDriverPicture' style="cursor: pointer;"></i>
                            <input type="file" name="Image" id="ChangeDriverPicture" class="file-upload" data-imageid="driverImagePath-DriverProfileEditForm" accept="image/png, .jpeg, .jpg, image/gif" />
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="driverId-DriverProfileEditForm" type="text" name="DriverID" required>
                                    <div id="driverID-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="employedDate-DriverProfileEditForm" type="date" name="DateOfAdmission">
                                    <div id="employedDate-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="firstName-DriverProfileEditForm" type="text" name="FirstName" required>
                                    <div id="firstName-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="lastName-DriverProfileEditForm" type="text" name="LastName" required>
                                    <div id="lastName-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4 mx-auto">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border inputs" id="address-DriverProfileEditForm" type="text" name="Address">
                                <div id="address-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="assignedVehicleID-DriverProfileEditForm" type="text" name="AssignedVehicle">
                                    <div id="assignedVehicleID-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="contactNo-DriverProfileEditForm" type="text" name="ContactNo" required>
                                    <div id="contactNo-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="email-DriverProfileEditForm" type="text" name="Email">
                                    <div id="email-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="licenseID-DriverProfileEditForm" type="text" name="licenseID" required>
                                    <div id="licenseID-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="licenseType-DriverProfileEditForm" type="text" name="LicenseType">
                                    <div id="licenseType-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="licenseExpDate-DriverProfileEditForm" type="text" name="LicenseExpirationDate">
                                    <div id="licenseExpDate-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="DriverProfileEditForm_Confirm"></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="DriverProfileEditForm_Cancel">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Delete Driver Alert-->
<div class="popup" id="DeleteDriverAlertPopup">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DeleteDriverAlert_Close">&times;</span>
            <h3>Delete Driver</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p>Are you sure you want to delete driver?</p>
            <input type="button" value="Yes" class="btn btn-danger" id="DeleteDriverAlert_Delete">
            <input type="button" value="No" class="btn btn-primary" id="DeleteDriverAlert_Cancel">
        </div>
    </div>
</div>