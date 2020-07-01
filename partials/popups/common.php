<!---PopUps-->

<!---******************
        REQUEST
    *************************-->
<!--Popup request form-->
<div class="popup" id="vehicle-request-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="vehicle-request-form-close">&times;</span>
            <h2>Vehicle Request Form</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">

                <form id="RequestAdd_form">

                    <div class="form-group">
                        <input type="date" class="form-control" name="date" placeholder="Date" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="time" class="form-control" name="time" placeholder="Time" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="pickup" placeholder="Pick-up Location" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="dropoff" placeholder="Drop-off Location" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="purpose" placeholder="Purpose" autocomplete="off">
                    </div>

                    <input type="button" value="Submit" class="btn btn-primary" id="request-form-submit-button">
                    <input type="button" value="Close" class="btn btn-primary" id="request-form-close-button">

                </form>
            </div>
        </div>
        <div class="popup-footer">

        </div>
    </div>
</div>

<!--Cancel Alert-->
<div class="popup" id="cancel-request-alert">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="confirm-alert-close">&times;</span>
            <h3>Cancel Request</h3>
            <hr>
        </div>
        <div class="popup-body">

            <p>Are you sure you want to cancle request</p>

            <input type="button" value="No" class="btn btn-primary" id="confirm-alert-no-button">
            <input type="button" value="Yes" class="btn btn-danger" id="confirm-alert-yes-button">

        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>

<!--request details content in a new Request-->
<div class="popup" id="request-details-popup">

    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="request-details-close">&times;</span>
            <h3>Request Details</h3>
            <hr>
        </div>
        <div class="popup-body">

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-date">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-time">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-pickup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-dropoff">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-purpose">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Status</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-request-status">Sending</p>
                </div>
            </div>

            <input type="button" value="Exit" class="btn btn-link" id="request-details-exit-button">
        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>

<!--Request Preview for a Table-->
<div class="popup" id="request-preview-popup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="request-preview-close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">
            <form>
                <input type="hidden" name="requestID" id="request-preview-ID" />
            </form>
            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="date-preview">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="date-preview">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="time-preview">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="pickup-preview">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="drop-preview">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="purpose-preview">Text</p>
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button class="btn btn-danger" id="request-cancel">Cancel Request</button>
        </div>
    </div>
</div>

<div class="popup" id="new-request-preview-popup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="new-request-preview-close">&times;</span>
            <h3>Preview</h3>
            <hr>
        </div>
        <div class="popup-body">

            <div class="row">
                <div class="col-sm-6">
                    <p>Date</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-date">DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-time">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-pickup">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-dropoff">Text</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Purpose</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-purpose">Text</p>
                </div>
            </div>
            <input type="button" value="Confirm" class="btn btn-primary" id="request-preview-confirm-button">
            <input type="button" value="Edit" class="btn btn-link" id="request-preview-edit-button">

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
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="user-profile-form-close">&times;</span>
            <h2>User</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../images/default-user-image.png" class="form-image">
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
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" disabled>
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
<div id="alert-ajax" style="display:none; width:100%; position:absolute; top:0; z-index:2000;">
    <div id="alertdiv" class="alert  mx-auto mt-3 text-center" role="alert" style="width:60%; height:50px">
        <p id="alert-message" style=" font-weight:500;font-size: initial;"></p>

    </div>
</div>


<div>

</div>