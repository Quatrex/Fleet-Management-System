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

                    <div class="form-group">
                        <input type="date" class="form-control inputs" name="date" placeholder="Date" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="time" class="form-control inputs" name="time" placeholder="Time" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control inputs" name="pickup" placeholder="Pick-up Location" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control inputs" name="dropoff" placeholder="Drop-off Location" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control inputs" name="purpose" placeholder="Purpose" autocomplete="off">
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
                    <p id="Driver-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>
            <div class="row scheduled-preview">
                <div class="col-sm-6">
                    <p>Vehicle</p>
                </div>
                <div class="col-sm-6">
                    <p id="Vehicle-OngoingRequestPreviewPopup">Text</p>
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button class="btn btn-danger" id="OngoingRequestPreviewRequestCancel">Cancel Request</button>
        </div>
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

<!-- on submit success snackbar -->
<div class="snackbar" id="request-added-success-snackbar">Request Added Successfully</div>

<!---****************
        END OF REQUEST
        ***************-->


<div class="popup" id="user-profile">
    <!-- User Profile content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="user-profile-form-close">&times;</span>
            <h2>My Profile</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div>
                <div class="center" style="text-align: center; ">
                    <img src="../images/default-user-image.png" class="form-image" style="padding:5px; width:600p;text-align: center; cursor:pointer" id="change-profile-picture-button">
                </div>
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
                                    <input class="form-control py-2 border-right-0 border" type="text" value='<?php echo $employee->getfield('firstName') . ' ' . $employee->getfield('lastName'); ?>' disabled>
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
                                    <input class="form-control py-2 border-right-0 border" type="text" value="<?php echo $employee->getfield('email'); ?>" disabled>
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
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label>Position</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="<?php echo $employee->getfield('position'); ?>" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a id="change-password-button" style="cursor:pointer; color:royalblue">Change password</a>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-dark" id="user-profile-confirm">Confirm</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<div id="change-profile-picture-popup" class="popup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="change-profile-picture-popup-close">&times;</span>
            <h2>Change Profile Picture</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div class="modal-body">
                <form id="crop-image" method="post" enctype="multipart/form-data" action="change_pic.php">
                    <strong>Upload Image:</strong> <br><br>
                    <input type="file" name="profile-pic" id="profile-pic" />
                    <!-- <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="1" />
                    <input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
                    <input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
                    <input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
                    <input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
                    <input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
                    <input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
                    <input type="hidden" name="action" value="" id="action" />
                    <input type="hidden" name="image-name" value="" id="image-name" /> -->
                    <div id="while-uploading"></div>
                    <div class="col" style="text-align: center;">
                        <img id='preview-profile-pic' class="form-image" src="../images/default-user-image.png" style="padding:5px; width:50%;"></img>
                    </div>
                    <div id="thumbs" style="padding:5px; width:600p"></div>
                </form>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn btn-default" id="change-profile-picture-popup-close-button">Close</button>
            <button type="button" id="save-crop" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

<!--Change my password popup-->
<div class="popup" id="change-password">
    <!-- change password content -->
    <div class="popup-content">

        <div class="popup-header">
            <span class="close" id="change-password-close">&times;</span>
            <h2 id="change-password-header">Enter Your Password</h2>
            <hr>
        </div>

        <div class="popup-body" id="change-password-body">

            <div class="col" style="text-align: center;">
                <!--Form-password-->
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <div id="password-input">
                                <input type="password" name="current-password" class="form-control" id="current-password-input" placeholder="Enter your current password..." required autocomplete="off">
                            </div>
                            <div id="password-error" style="color:red; text-align:left"></div>
                        </div>
                    </div>
                </div>
                <div style="text-align: right;">
                    <input type="button" value="Cancel" class="btn btn-link" id="change-password-cancel-button">
                    <button type="button" class="btn btn-primary " name="password-submit" id="check-my-password-button">Next</button>
                </div>
            </div>

        </div>
        <div class="popup-footer">

        </div>
    </div>
</div>

<!-- Alert after ajax call -->
<div id="alert-ajax" style="display:none; width:100%; position:absolute; top:0; z-index:2000;">
    <div id="alertdiv" class="alert  mx-auto mt-3 text-center" role="alert" style="width:60%; height:50px">
        <p id="alert-message" style=" font-weight:500;font-size: initial;"></p>

    </div>
</div>


<div id="overlay">
    <div class="cv-spinner">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div>