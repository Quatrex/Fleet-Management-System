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
                        <input class="form-control inputs" placeholder="Employee ID" type="text" name="EmpID" required>
                        <div id="EmpID-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="First Name" type="text" name="FirstName" required>
                        <div id="FirstName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Last Name" type="text" name="LastName" required>
                        <div id="LastName-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <select class="custom-select inputs" name="Position" id="Position-select" required>
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
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Designation" id="employee-Designation" type="text" name="Designation" required>
                        <div id="Designation-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input type="number" name="ContactNo" class="form-control inputs" placeholder="Contact Number" required>
                        <div id="ContactNo-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="Email" class="form-control inputs" placeholder="Email" type="text" required>
                        <div id="Email-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="Password" class="form-control inputs" placeholder="Password" type="password" required>
                        <div id="Password-error" class="text-danger"></div>

                    </div>
                    <div class="form-group">
                        <input name="ConfirmPassword" class="form-control inputs" placeholder="Confirm Password" type="password" required>
                        <div id="ConfirmPassword-error" class="text-danger"></div>

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
                                <input class="form-control py-2 border-right-0 border inputs" id="empID-EmployeeProfileForm" type="text" name="empID" disabled>
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
                                <input class="form-control py-2 border-right-0 border inputs" id="empID-EmployeeProfileEditForm" type="text" name="NewEmpID" required>
                                <div id="NewEmpID-error" class="text-danger"></div>
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
                        <input class="form-control inputs" placeholder="Driver ID" type="text" name="DriverID" required>
                        <div id="DriverID-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="First Name" type="text" name="FirstName" required>
                        <div id="FirstName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Last Name" type="text" name="LastName" required>
                        <div id="LastName-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Email" type="text" name="Email" required>
                        <div id="Email-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputs" placeholder="Address" type="text" name="Address" required>
                        <div id="Address-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="ContactNo" class="form-control inputs" placeholder="Contact Number" required>
                        <div id="ContactNo-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="DateOfAdmission" class="form-control inputs" placeholder="Date Of Admission" type="date">
                        <div id="DateOfAdmission-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="LicenseNumber" class="form-control inputs" placeholder="License Number" type="text" required>
                        <div id="LicenseNumber-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="LicenseType" class="form-control inputs" placeholder="License Type" type="text" required>
                        <div id="LicenseType-error" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input name="LicenseExpirationDay" class="form-control inputs" placeholder="License Expire Data" type="date">
                        <div id="LicenseExpirationDay-error" class="text-danger"></div>
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
                        <input class="form-control py-2 border-right-0 border inputs" id="DriverID-DriverProfileEditForm" type="hidden" name="NewDriverID">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="DriverID-DriverProfileEditForm" type="text" name="DriverID" required>
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
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Current Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="CurrentPassword-ChangePasswordForm" type="password" name="CurrentPassword" required>
                                    <div id="CurrentPassword-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="NewPassword-ChangePasswordForm" type="password" name="NewPassword" required>
                                    <div id="NewPassword-error" class="text-danger"></div>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm New Password</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="RetypeNewPassword-ChangePasswordForm" type="password" name="RetypeNewPassword" required>
                                    <div id="RetypeNewPassword-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Change" id="ChangePasswordForm_Submit"></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="ChangePasswordForm_Cancel">
                </div>
            </div>
        </div>
    </div>
</div>