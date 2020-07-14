<!--Popups- employee add form-->
<div class="popup" id="employee-add-form">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="employee-add-form-close">&times;</span>
            <h2>Add Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="AddEmployee_form">
                    <input class="form-control my-3" placeholder="Employee ID" type="text" name="newEmployeeId">
                    <input class="form-control my-3" placeholder="First Name" type="text" name="firstName">
                    <input class="form-control my-3" placeholder="Last Name" type="text" name="lastName">
                    <select class="custom-select" name="position" id="position-select">
                        <option selected>Account Type</option>
                        <option value="Requester">Requester</option>
                        <option value="VPMO">VPMO</option>
                        <option value="JO">JO</option>
                        <option value="CAO">CAO</option>
                        <option value="DCAO">DCAO</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                    <input class="form-control my-3" placeholder="Designation" id="employee-designation" type="text" name="designation">
                    <input type="number" name="contactNo" class="form-control my-3" placeholder="Contact Number">
                    <input name="email" class="form-control my-3" placeholder="Email" type="text">
                    <input name="password" class="form-control my-3" placeholder="Password" type="password">
                    <input name="confirmPassword" class="form-control my-3" placeholder="Confirm Password" type="password">
                    <input type="button" value="Submit" class="btn btn-success" id="employee-add-form-confirm">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Employee Profile Form-->
<div class="popup" id="employee-profile-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="employee-profile-form-close">&times;</span>
            <h2>Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="EmployeeProfile_form">
                        <input class="form-control py-2 border-right-0 border employee-employeeIDCopy" type="hidden" name="empoyeeIDCopy">
                        <div class="form-group-row mb-4">
                            <label>Employee ID</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border employee-employeeID" type="text" name="employeeID" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-firstName" type="text" name="firstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-lastName" type="text" name="lastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-designation" type="text" name="designation" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-contactNo" type="text" name="contactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-email" type="text" name="email" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="button" value="Edit" class="btn btn-primary" id="employee-profile-edit-button">
                    <input type="button" class="btn btn-danger" value="Delete" id="employee-delete">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Employee Edit Profile Form-->
<div class="popup" id="employee-profile-edit-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="employee-profile-edit-form-close">&times;</span>
            <h2>Edit Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateEmployee_form">
                        <input class="form-control py-2 border-right-0  border employee-employeeIDCopy" type="hidden" name="employeeIDCopy">
                        <div class="form-group-row mb-4">
                            <label>Employee ID</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 employee-edit border employee-employeeID" type="text" name="employeeID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 employee-edit border employee-firstName" type="text" name="firstName">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 employee-edit border employee-lastName" type="text" name="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Designation</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 employee-edit border employee-designation" type="text" name="designation">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 employee-edit border employee-contactNo" type="text" name="contactNo">
                                </div>
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border employee-edit employee-email" type="text" name="email">
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="confirm-employee-profile" disabled></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="employee-profile-edit-cancel-button">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Delete Employee Alert-->
<div class="popup" id="delete-employee-alert">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="confirm-alert-close">&times;</span>
            <h3>Delete Employee</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p>Are you sure you want to delete employee?</p>
            <input type="button" value="Yes" class="btn btn-danger" id="confirm-employee-delete-button">
            <input type="button" value="No" class="btn btn-primary" id="employee-delete-cancel-button">
        </div>
    </div>
</div>

<!--Popups- driver add form-->
<div class="popup" id="driver-add-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="driver-add-form-close">&times;</span>
            <h2>Add Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="AddDriver_form">
                    <input class="form-control my-3" placeholder="Driver ID" type="text" name="driverId">
                    <input class="form-control my-3" placeholder="First Name" type="text" name="firstName">
                    <input class="form-control my-3" placeholder="Last Name" type="text" name="lastName">
                    <input class="form-control my-3" placeholder="Email" type="text" name="email">
                    <input class="form-control my-3" placeholder="Address" type="text" name="address">
                    <input type="number" name="contactNo" class="form-control my-3" placeholder="Contact Number">
                    <input name="employedDate" class="form-control my-3" placeholder="Employed Date" type="date">
                    <input name="licenseNo" class="form-control my-3" placeholder="License Number" type="text">
                    <input name="licenseType" class="form-control my-3" placeholder="License Type" type="text">
                    <input name="licenseExpireDate" class="form-control my-3" placeholder="License Expire Data" type="date">
                    <input type="button" value="Submit" class="btn btn-success" id="driver-add-form-confirm">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Driver profile Form-->
<div class="popup" id="driver-profile-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="driver-profile-form-close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="DriverProfile_form">
                        <input class="form-control py-2 border-right-0 border driver-driverIDCopy" type="hidden" name="driverIDCopy">
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-driverID" type="text" name="driverID" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-employedDate" type="date" name="employedDate" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-firstName" type="text" name="firstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-lastName" type="text" name="lastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4 mx-auto">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border driver-address" type="text" name="address" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-assignedVehicleID" type="text" name="assignedVehicleID" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-contactNo" type="text" name="contactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-email" type="text" name="email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-licenseID" type="text" name="designation" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-licenseType" type="text" name="contactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border driver-licenseExpDate" type="text" name="email" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <input type="button" value="Edit" class="btn btn-primary" id="driver-profile-edit-button">
                    <input type="button" class="btn btn-danger" value="Delete" id="driver-delete">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Driver profile Form-->
<div class="popup" id="driver-profile-edit-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="driver-profile-edit-form-close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateDriver_form">
                        <input class="form-control py-2 border-right-0 border driver-driverIDCopy" type="hidden" name="driverIDCopy">
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-driverID" type="text" name="driverID">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-employedDate" type="date" name="employedDate">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-firstName" type="text" name="firstName">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-lastName" type="text" name="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mx-autorow mb-4">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 driver-edit border driver-address" type="text" name="address">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-assignedVehicleID" type="text" name="assignedVehicleID">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-contactNo" type="text" name="contactNo">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-email" type="text" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-licenseID" type="text" name="designation">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-licenseType" type="text" name="contactNo">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 driver-edit border driver-licenseExpDate" type="text" name="email">
                                </div>
                            </div>
                        </div>
                    </form>
                    <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="confirm-driver-profile" disabled></span>
                    <input type="button" value="Cancel" class="btn btn-primary" id="driver-profile-edit-cancel-button">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Delete Driver Alert-->
<div class="popup" id="delete-driver-alert">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="confirm-alert-close">&times;</span>
            <h3>Delete Driver</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p>Are you sure you want to delete driver?</p>
            <input type="button" value="Yes" class="btn btn-danger" id="confirm-driver-delete-button">
            <input type="button" value="No" class="btn btn-primary" id="driver-delete-cancel-button">
        </div>
    </div>
</div>