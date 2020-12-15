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
                    <div class="center" style="text-align: center;">
                        <img src='../images/profilePictures/default-profile.png' id="VehiclePicturePath-VehicleProfileEditForm" class="form-image image-fluid" style="padding:5px; width:20%;text-align: center;">
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="EmpID">Employee ID</label>
                            <input class="form-control inputs" placeholder="Employee ID" type="text" name="EmpID" required>
                            <div id="EmpID-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="FirstName">First Name</label>
                            <input class="form-control inputs" placeholder="First Name" type="text" name="FirstName" required>
                            <div id="FirstName-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="LastName">Last Name</label>
                            <input class="form-control inputs" placeholder="Last Name" type="text" name="LastName" required>
                            <div id="LastName-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="custom-select inputs" name="Position" id="Position-select" aria-placeholder="----Select Role----" required>
                            <option selected>Account Type</option>
                            <option value="Requester">Requester</option>
                            <option value="VPMO">VPMO</option>
                            <option value="JO">JO</option>
                            <option value="CAO">CAO</option>
                            <option value="DCAO">DCAO</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                        <div id="Position-error" class="text-danger"></div>

                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="Designation">Designation</label>
                            <input class="form-control inputs" placeholder="Designation" id="employee-Designation" type="text" name="Designation" required>
                            <div id="Designation-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="ContactNo">Contact Number</label>
                            <input type="number" name="ContactNo" class="form-control inputs" placeholder="Contact Number" required maxlength="10">
                            <div id="ContactNo-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="Email">Email</label>
                            <input name="Email" class="form-control inputs" placeholder="Email" type="text" required>
                            <div id="Email-error" class="text-danger"></div>
                        </div>
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
                                <input class="form-control py-2 border-right-0 border inputs" id="empID-EmployeeProfileForm" type="text" name="EmpID" disabled>
                                <input class="form-control py-2 border-right-0 border inputs d-none" id="NewempID-EmployeeProfileForm" type="text" name="NewEmpID" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="FirstName-EmployeeProfileForm" type="text" name="FirstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LastName-EmployeeProfileForm" type="text" name="LastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Designation-EmployeeProfileForm" type="text" name="Designation" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="ContactNo-EmployeeProfileForm" type="text" name="ContactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Email-EmployeeProfileForm" type="text" name="Email" disabled>
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
            <img src="../images/default-user-image.png" class="form-image image-fluid" id="ProfilePicturePath-EmployeeProfileEditForm">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateEmployee_form">
                        <div class="form-group-row mb-4">
                            <label>Employee ID</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border inputs" id="NewempID-EmployeeProfileEditForm" type="text" name="NewEmpID" required>
                                <input class="form-control py-2 border-right-0 border inputs d-none" id="EmpID-EmployeeProfileEditForm" type="text" name="EmpID" required>
                                <div id="NewEmpID-error" class="text-danger"></div>
                                <div id="EmpID-error" class="text-danger"></div>
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
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="DriverID">Driver ID</label>
                            <input class="form-control inputs" placeholder="Driver ID" type="text" name="DriverID" required>
                            <div id="DriverID-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="FirstName">First Name</label>
                            <input class="form-control inputs" placeholder="First Name" type="text" name="FirstName" required>
                            <div id="FirstName-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="LastName">Last Name</label>
                            <input class="form-control inputs" placeholder="Last Name" type="text" name="LastName" required>
                            <div id="LastName-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="Email">Email</label>
                            <input class="form-control inputs" placeholder="Email" type="text" name="Email" required>
                            <div id="Email-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="ContactNo">Contact Number</label>
                            <input type="tel" minlength="10" maxlength="10" name="ContactNo" class="form-control inputs" placeholder="Contact Number" required>
                            <div id="ContactNo-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="DateOfAdmission">Date of Admission</label>
                            <input name="DateOfAdmission" class="form-control inputs" placeholder="Date Of Admission" type="text" onfocus="(this.type='date')" max="<?php echo date("Y-m-d"); ?>">
                            <div id="DateOfAdmission-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="LicenseNumber">License Number</label>
                            <input name="LicenseNumber" class="form-control inputs" placeholder="License Number" type="text" required>
                            <div id="LicenseNumber-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="LicenseType">License Type</label>
                            <input name="LicenseType" class="form-control inputs" placeholder="License Type" type="text" required>
                            <div id="LicenseType-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="LicenseExpirationDay">License Expiration Day</label>
                            <input name="LicenseExpirationDay" class="form-control inputs" placeholder="License Expire Day" type="text" onfocus="(this.type='date')" min="<?php echo date("Y-m-d"); ?>">
                            <div id="LicenseExpirationDay-error" class="text-danger"></div>
                        </div>
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
            <img src="../images/default-user-image.png" class="form-image image-fluid" id="ProfilePicturePath-DriverProfileForm">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="DriverProfile_form">
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="DriverID-DriverProfileForm" type="text" name="DriverID" disabled>
                                    <input class="form-control py-2 border-right-0 border d-none" id="NewDriverID-DriverProfileForm" type="text" name="NewDriverID" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="DateOfAdmission-DriverProfileForm" type="date" name="DateOfAdmission" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="FirstName-DriverProfileForm" type="text" name="FirstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LastName-DriverProfileForm" type="text" name="LastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4 mx-auto">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border" id="Address-DriverProfileForm" type="text" name="Address" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="AssignedVehicle-DriverProfileForm" type="text" name="AssignedVehicle" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="ContactNo-DriverProfileForm" type="text" name="ContactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="Email-DriverProfileForm" type="text" name="Email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LicenseNumber-DriverProfileForm" type="text" name="LicenseNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border " id="LicenseType-DriverProfileForm" type="text" name="LicenseType" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LicenseExpirationDay-DriverProfileForm" type="text" name="LicenseExpirationDay" disabled>
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
                            <img src='../images/default-user-image.png' id="DriverPicturePath-DriverProfileEditForm" class="form-image image-fluid" style="padding:5px;text-align: center;">
                        </div>
                        <div class="overlay">
                            <i class="fa fa-camera upload-button" data-input='ChangeDriverPicture' style="cursor: pointer;"></i>
                            <input type="file" name="Image" id="ChangeDriverPicture" class="file-upload" data-imageid="DriverPicturePath-DriverProfileEditForm" accept="image/png, .jpeg, .jpg, image/gif" />
                        </div>
                        <div class="form-group row mb-4">
                            <input class="form-control py-2 border-right-0 border inputs" id="NewDriverID-DriverProfileEditForm" type="hidden" name="NewDriverID">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="DriverID-DriverProfileEditForm" type="text" name="DriverID" required>
                                    <div id="NewDriverID-error" class="text-danger"></div>
                                    <div id="DriverID-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="DateOfAdmission-DriverProfileEditForm" type="date" name="DateOfAdmission">
                                    <div id="DateOfAdmission-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="FirstName-DriverProfileEditForm" type="text" name="FirstName" required>
                                    <div id="FirstName-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LastName-DriverProfileEditForm" type="text" name="LastName" required>
                                    <div id="LastName-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4 mx-auto">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border inputs" id="Address-DriverProfileEditForm" type="text" name="Address">
                                <div id="Address-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="AssignedVehicle-DriverProfileEditForm" type="text" name="AssignedVehicle">
                                    <div id="AssignedVehicle-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="ContactNo-DriverProfileEditForm" type="text" name="ContactNo" required>
                                    <div id="ContactNo-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="Email-DriverProfileEditForm" type="text" name="Email">
                                    <div id="Email-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LicenseNumber-DriverProfileEditForm" type="text" name="LicenseNumber" required>
                                    <div id="LicenseNumber-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LicenseType-DriverProfileEditForm" type="text" name="LicenseType">
                                    <div id="LicenseType-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="LicenseExpirationDay-DriverProfileEditForm" type="text" name="LicenseExpirationDate">
                                    <div id="LicenseExpirationDay-error" class="text-danger"></div>
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

<div class="popup" id="UserProfilePopup">
    <!-- User Profile content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="UserProfilePopup_Close">&times;</span>
            <h2>My Profile</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div>
                <div class="center" style="text-align: center; ">
                    <img src="<?php echo $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png"; ?>" class="form-image ProfilePicture UserProfilePicture" style="padding:5px; width:600p;text-align: center; cursor:pointer" id="ChangeProfilePictureButton">
                </div>
                <!-- <div class="row">
                    <div class="small-12 medium-2 large-2 columns">
                        <div class="circle">
                            <img src="<?php //echo $employee->getField('profilePicturePath') != null ? "../images/userProfilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png"; 
                                        ?>" class="form-image ProfilePicture" id="change-profile-picture-button">
                        </div>
                        <div class="p-image">
                            <i class="fa fa-camera upload-button"></i>
                            <input class="file-upload" type="file" accept="image/*" />
                        </div>
                    </div>
                </div> -->
                <!-- <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-link" id="change-profile-picture-button">Change Profile Picture</button>
                    </div>
                </div> -->
            </div>
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border UserFirstName UserLastName" type="text" value='<?php echo $employee->getfield('firstName') . ' ' . $employee->getfield('lastName'); ?>' disabled>
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border UserEmail" type="text" value="<?php echo $employee->getfield('email'); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border UserContactNo" type="text" value="Contacts Number" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border UserDesignation" type="text" value="<?php echo $employee->getfield('designation'); ?>" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a id="UserPasswordChange" style="cursor:pointer; color:royalblue">Change password</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- change profile picture -->
<div id="ChangeProfilePictureForm" class="popup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="ChangeProfilePictureForm_Close">&times;</span>
            <h2>Change Profile Picture</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div class="modal-body">
                <form id="ChangeProfilePicture_Form" method="post" enctype="multipart/form-data">
                    <strong>Upload Image:</strong> <br><br>
                    <input type="file" name="Image" id="ChangeProfilePicture" class="inputs file-upload" data-imageid="preview-profile-pic" accept="image/png, .jpeg, .jpg, image/gif" />
                    <input class="inputs" type="hidden" name="Method" value='ChangeProfilePicture' disabled>
                    <div class="col" style="text-align: center;">
                        <img id='preview-profile-pic' class="form-image ProfilePicture UserProfilePicture" src="<?php echo $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png"; ?>" style="padding:5px; width:50%;"></img>
                    </div>
                    <input type="button" value="Save" class="btn btn-primary" id="ChangeProfilePictureForm_Submit">
                    <input type="button" value="Close" class="btn btn-primary" id="ChangeProfilePictureForm_Cancel">
                </form>
            </div>
        </div>
        <div class="popup-footer">

        </div>
    </div>
</div>

<!--Change my password popup-->
<div class="popup" id="ChangePasswordForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="ChangePasswordForm_Close">&times;</span>
            <h2>Change Password</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="ChangePassword_form">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="CurrentPassword">Current Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs" id="CurrentPassword-ChangePasswordForm" type="password" name="CurrentPassword" placeholder="Your Current Password" required>
                                    <div id="CurrentPassword-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="NewPassword">New Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs " id="NewPassword-ChangePasswordForm" type="password" name="NewPassword" placeholder="Your New Password" required>
                                    <span class="fa fa-fw fa-eye field-icon toggle-password" data-pass="NewPassword-ChangePasswordForm"></span>
                                    <div id="NewPassword-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="RetypeNewPassword">Confirm New Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs" id="RetypeNewPassword-ChangePasswordForm" type="password" name="RetypeNewPassword" placeholder="Confirm New Password" required>
                                    <!-- <span class="fa fa-fw fa-eye field-icon toggle-password" data-pass="RetypeNewPassword-ChangePasswordForm"></span> -->
                                    <div id="RetypeNewPassword-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="NewPasswordinfo form-group">
                            <h6>Password must include:</h6>
                            <ul style="margin-left: 20px;">
                                <li data-criterion="length" class="valid">At least <strong>8 Characters</strong></li>
                                <li data-criterion="capital" class="valid">At least <strong>one capital letter</strong></li>
                                <li data-criterion="number" class="valid">At least <strong>one number</strong></li>
                                <li data-criterion="special" class="valid">At least <strong>one special character (!@#$%^&*)</strong></li>
                                <li data-criterion="letter" class="valid">No spaces</li>
                            </ul>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Change" id="ChangePasswordForm_Submit"></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="ChangePasswordForm_Cancel">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert after ajax call -->
<div id="alert-ajax-success" class="" style="display:none; width:100%; position:absolute; top:0; z-index:2000;">
    <div class="d-flex" style="justify-content:center;">
        <div class="alert alert-success mt-5 row" style="width:80%;min-height:4rem;" role="alert">
            <div class="col-10 d-flex message" style="align-items:center;justify-content:center;">
                This is a success alert—check it out!
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>

</div>

<div id="alert-ajax-failure" class="" style="display:none; width:100%; position:absolute; top:0; z-index:2000;">
    <div class="d-flex" style="justify-content:center;">
        <div class="alert alert-danger mt-5 row" style="width:80%;min-height:4rem;" role="alert">
            <div class="col-10 d-flex message" style="align-items:center;justify-content:center;">
                This is a failure alert—check it out!
            </div>
            <div class="col-2">
                <button class="close" id="Close-failure" style="line-height:33px;">&times;</button>
            </div>
        </div>
    </div>
</div>


<div id="OfflineDisplay" class="mx-auto mt-1" style="display:none; width:70%; position:fixed; top:0; z-index:2000;left:0;right:0;text-align:center;">
    <div class="alert alert-danger" role="alert">
        Internet Connection Offline <span class="ml-1"><svg height="20" width="20" class="blinking">
                <circle cx="10" cy="8" r="7" fill="red" />
                Sorry, your browser does not support inline SVG.
            </svg> </span>
    </div>
</div>

<div id="OnlineDisplay" class="mx-auto mt-1" style="display:none; width:70%; position:fixed; top:0; z-index:2000;left:0;right:0;text-align:center;">
    <div class="alert alert-success" role="alert">
        Connection Established<span class="ml-1"><svg height="20" width="20">
                <circle cx="10" cy="8" r="7" fill="green" />
                Sorry, your browser does not support inline SVG.
            </svg> </span>
    </div>
</div>