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
                        <option  selected>Account Type</option>
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
                        <input class="form-control py-2 border-right-0 border employee-employeeIDCopy" type="hidden" name="empoyeeId">
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
                        <input class="form-control py-2 border-right-0 employee-edit border employee-employeeIDCopy" type="hidden" name="employeeId">
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
                    <input type="button" value="Cancel" class="btn btn-primary" id="Employee-profile-edit-cancel-button">
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
                    <input class="form-control my-3" placeholder="Driver ID" type="text" name="newDriverId">
                    <input class="form-control my-3" placeholder="First Name" type="text" name="firstName">
                    <input class="form-control my-3" placeholder="Last Name" type="text" name="lastName">
                    <input class="form-control my-3" placeholder="Email" type="text" name="email">
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
            <img src="../../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Name" disabled>
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="email@email.com" disabled>
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border" type="text" value="Address" disabled>
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                        <i class="icon far fa-edit"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address 2</label>
                            <div class="input-group">
                                <input class="form-control py-2 border-right-0 border" type="text" value="Name" disabled>
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                        <i class="icon far fa-edit"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Contacts Number" disabled>
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Licennce ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Contacts Number" disabled>
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Licence Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Licence Expiry Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a href="">Change password</a>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-dark" id="driver-profile-confirm">Confirm</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>