<!---PopUps-->

<!---******************
        REQUEST
    *************************-->
<!--Popup request form-->
<div class="popup" id="VehicleRequestForm">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="VehicleRequestForm_Close">&times;</span>
            <h2>Vehicle Request Form</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="RequestAdd_form">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="date">Date</label>
                            <input type="text" class="form-control inputs" name="date" id="date-VehicleRequestForm" placeholder="Date" autocomplete="off" required onfocus="(this.type='date')" min="<?php echo date("Y-m-d"); ?>" />
                            <div id="date-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="time">Time</label>
                            <input type="text" class="form-control inputs" name="time" placeholder="Time" id="time-VehicleRequestForm" autocomplete="off" required onfocus="(this.type='time')" />
                            <div id="time-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="pickup">Pickup</label>
                            <input type="text" class="form-control inputs" name="pickup" placeholder="Pick-up Location" id="pickup-VehicleRequestForm" autocomplete="off" required />
                            <div id="pickup-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls ">
                            <label for="dropoff">Dropoff</label>
                            <input type="text" class="form-control inputs" name="dropoff" placeholder="Drop-off Location" id="dropoff-VehicleRequestForm" autocomplete="off" required />
                            <div id="dropoff-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls ">
                            <label for="purpose">Purpose</label>
                            <input type="text" class="form-control inputs" name="purpose" placeholder="Purpose" id="purpose-VehicleRequestForm" autocomplete="off">
                            <div id="purpose-error" class="text-danger"></div>
                        </div>
                    </div>
                    <input type="button" value="Submit" class="btn btn-primary" id="VehicleRequestForm_Submit">
                    <input type="button" value="Close" class="btn btn-primary" id="VehicleRequestForm_Cancel">

                </form>
            </div>
        </div>
        <div class="popup-footer">

        </div>
    </div>
</div>

<!--Cancel Alert-->
<div class="popup" id="CancelRequestAlertPopup" style="z-index:1000;">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="CancelRequestAlert_Close">&times;</span>
            <h3 id="cancel-alert-header">Cancel Request</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p id="cancel-alert-message">Are you sure you want to cancel request</p>
            <input type="button" value="Yes" class="btn btn-danger" id="CancelRequestAlert_Confirm">
            <input type="button" value="No" class="btn btn-primary" id="CancelRequestAlert_Cancel">
        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>

<!--Cancel Added Request Alert-->
<div class="popup" id="CancelAddedRequestAlertPopup" style="z-index:1000;">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="CancelAddedRequestAlert_Close">&times;</span>
            <h3 id="cancel-alert-header">Cancel Request</h3>
            <hr>
        </div>
        <div class="popup-body">
            <p id="cancel-alert-message">Are you sure you want to cancel request</p>
            <input class="inputs" type="hidden" name="Status" value="Cancelled" disabled>
            <input type="button" value="Yes" class="btn btn-danger" id="CancelAddedRequestAlert_Confirm">
            <input type="button" value="No" class="btn btn-primary" id="CancelAddedRequestAlert_Cancel">
        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>

<!--Request Preview for a Ongoing Table-->
<div class="popup" id="OngoingRequestPreviewPopup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="OngoingRequestPreview_Close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">
            <div class="row">
                <div class="col-sm-6">
                    <p>RequestID</p>
                </div>
                <div class="col-sm-6">
                    <p id="RequestId-OngoingRequestPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Status</p>
                </div>
                <div class="col-sm-6">
                    <p id="Status-OngoingRequestPreviewPopup">Pending</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="DateOfTrip-OngoingRequestPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="TimeOfTrip-OngoingRequestPreviewPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="PickLocation-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="DropLocation-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="Purpose-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>JO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="JOComment-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>CAO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="CAOComment-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row scheduled-preview">
                <div class="col-sm-6">
                    <p>Driver</p>
                </div>
                <div class="col-sm-6">
                    <p class="d-inline" id="Driver-OngoingRequestPreviewPopup">Text</p>
                    <button class="btn mb-1 btn-outline-dark" id="Info_Driver_OngoingRequestPreview">More ></button>
                    <!-- <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-info-sign"></span> Default text here</a> -->

                </div>
            </div>
            <div class="row scheduled-preview">
                <div class="col-sm-6">
                    <p>Vehicle</p>
                </div>
                <div class="col-sm-6">
                    <p class="d-inline" id="Vehicle-OngoingRequestPreviewPopup">Text</p>
                    <button class="btn mb-1 btn-outline-dark" id="Info_Vehicle_OngoingRequestPreview">More ></button>
                </div>
            </div>
        </div>
        <!-- <div class="popup-footer">
            <button class="btn btn-danger" id="OngoingRequestPreviewRequestCancel">Cancel Request</button>
        </div> -->
    </div>
</div>
<!--Request Preview for a Pending Table-->
<div class="popup" id="PendingRequestPreviewPopup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="PendingRequestPreview_Close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">
            <div class="row">
                <div class="col-sm-6">
                    <p>RequestID</p>
                </div>
                <div class="col-sm-6">
                    <p id="RequestId-PendingRequestPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Status</p>
                </div>
                <div class="col-sm-6">
                    <p id="Status-PendingRequestPreviewPopup">Pending</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="DateOfTrip-PendingRequestPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="TimeOfTrip-PendingRequestPreviewPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="PickLocation-PendingRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="DropLocation-PendingRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="Purpose-PendingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>JO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="JOComment-PendingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>CAO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="CAOComment-PendingRequestPreviewPopup">Text</p>
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button class="btn btn-danger" id="PendingRequestPreviewRequestCancel">Cancel Request</button>
        </div>
    </div>
</div>
<!--Request Preview for a Request History Table-->
<div class="popup" id="RequestHistoryPreviewPopup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="RequestHistoryPreview_Close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">
            <div class="row">
                <div class="col-sm-6">
                    <p>RequestID</p>
                </div>
                <div class="col-sm-6">
                    <p id="RequestId-RequestHistoryPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Status</p>
                </div>
                <div class="col-sm-6">
                    <p id="Status-RequestHistoryPreviewPopup">Pending</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="DateOfTrip-RequestHistoryPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="TimeOfTrip-RequestHistoryPreviewPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="PickLocation-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="DropLocation-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="Purpose-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>JO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="JOComment-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>CAO Comment</p>
                </div>
                <div class="col-sm-6">
                    <p id="CAOComment-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row scheduled-preview">
                <div class="col-sm-6">
                    <p>Driver</p>
                </div>
                <div class="col-sm-6">
                    <p id="Driver-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row scheduled-preview">
                <div class="col-sm-6">
                    <p>Vehicle</p>
                </div>
                <div class="col-sm-6">
                    <p id="Vehicle-RequestHistoryPreviewPopup">Text</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup" id="NewRequestPreviewPopup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="NewRequestPreview_Close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="date-NewRequestPreviewPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="time-NewRequestPreviewPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="pickup-NewRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="dropoff-NewRequestPreviewPopup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="purpose-NewRequestPreviewPopup">Text</p>
                </div>
            </div>
            <input type="button" value="Confirm" class="btn btn-primary" id="NewRequestPreview_Confirm">
            <input type="button" value="Edit" class="btn btn-link" id="NewRequestPreview_Edit">

        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>

<!--Driver profile Form-->
<div class="popup" id="DriverDetailPopup">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="DriverDetailPopup_Close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" id="ProfilePicturePath-DriverDetailPopup" class="form-image image-fluid">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <p>First Name</p>
                </div>
                <div class="col-sm-6">
                    <p id="FirstName-DriverDetailPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Last Name</p>
                </div>
                <div class="col-sm-6">
                    <p id="LastName-DriverDetailPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Contact Number</p>
                </div>
                <div class="col-sm-6">
                    <p id="ContactNo-DriverDetailPopup">Text</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!--Vehicle Profile Form-->
<div class="popup" id="VehicleDetailPopup">
    <!-- Request Popup content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="VehicleDetailPopup_Close">&times;</span>
            <h2>Vehicle</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image image-fluid" id="VehiclePicturePath-VehicleDetailPopup">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <p>Registration Number</p>
                </div>
                <div class="col-sm-6">
                    <p id="RegistrationNo-VehicleDetailPopup">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Model</p>
                </div>
                <div class="col-sm-6">
                    <p id="Model-VehicleDetailPopup">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purchased Year</p>
                </div>
                <div class="col-sm-6">
                    <p id="PurchasedYear-VehicleDetailPopup">Text</p>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- on submit success snackbar -->
<div class="snackbar" id="request-added-success-snackbar">Request Added Successfully</div>

<!---****************
        END OF REQUEST
        ***************-->


<!---****************
        START OF USER DETAILS
        ***************-->
<!-- user profile details -->
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
                    <img src="<?php echo $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png"; ?>" class="form-image ProfilePicture UserProfilePicture" style="padding:5px; width:600p;text-align: center; cursor:pointer" id="UserProfilePictureChange">
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
<div id="alert-ajax-success" class="" style="display:none; width:100%; position:fixed; top:0; z-index:2000;font-weight:600;opacity:0.95">
    <div class="d-flex" style="justify-content:center;">
        <div class="alert alert-success mt-5 row" style="width:80%;min-height:4rem;" role="alert">
            <div class="col-2 d-flex" style="justify-content:flex-end;padding-right:0;"><i class="fas fa-thumbs-up" style="font-size:1.5rem;"></i></div>
            <div class="col-10 d-flex message" style="align-items:center;justify-content:felx-start;">
                This is a success alert—check it out!
            </div>
        </div>
    </div>

</div>

<div id="alert-ajax-failure" class="" style="display:none; width:100%; position:fixed; top:0; z-index:2000;font-weight:600;opacity:0.95">
    <div class="d-flex" style="justify-content:center;">
        <div class="alert alert-danger mt-5 row" style="width:80%;min-height:4rem;" role="alert">
            <div class="col-2 d-flex" style="justify-content:flex-end;padding-right:0;"><i class="fas fa-exclamation-triangle mt-2" style="font-size:1.5rem;"></i></div>
            <div class="col-8 d-flex message" style="align-items:center;justify-content:felx-start;">
                This is a failure alert—check it out!
            </div>
            <div class="col-2">
                <button class="close" id="Close-failure" style="line-height:33px;" onclick='document.getElementById("alert-ajax-failure").style.display = "none"'>&times;</button>
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


<div id="overlay">
    <div class="cv-spinner">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div>

<!-- <div id="overlay2" style="z-index:2000;position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
    background: rgba(0,0,0,0.6);">
    <div class="cv-spinner">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div> -->

<div class="bouncybox spinner-grow text-info" role="status" style="z-index:1000;display:none;">
    <span class="sr-only">Loading...</span>
</div>