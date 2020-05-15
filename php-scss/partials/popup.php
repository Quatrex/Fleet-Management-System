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

                <form id="submit-form">

                    <div class="form-group">
                        <input type="text" class="form-control" name="date" placeholder="Date" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="time" placeholder="Time" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="pickup" placeholder="Pick-up Location" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="dropoff" placeholder="Drop-off Location" autocomplete="off">
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
            <h3>Cancle Request</h3>
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
                    <p id="new-date" >DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-time" >HH:MM: AM/PM</p>
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
                    <p>Status</p>
                </div>
                <div class="col-sm-6">
                    <p>Pending</p>
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
                    <p id="time-preview" >HH:MM: AM/PM</p>
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
        </div>
        <div class="popup-footer">
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
                <div  class="col-sm-6">
                    <p id="new-date" >DD-MM-YYYY</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <p>Time</p>
                </div>
                <div  class="col-sm-6">
                    <p id="new-time">HH:MM: AM/PM</p>
                </div>
            </div>

            <div class="row">
                <div  class="col-sm-6">
                    <p>Pick-up Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-pickup">Text</p>
                </div>
            </div>

            <div class="row">
                <div  class="col-sm-6">
                    <p>Drop-off Location</p>
                </div>
                <div class="col-sm-6">
                    <p id="new-dropoff">Text</p>
                </div>
            </div>
            <input type="button" value="Confirm" class="btn btn-primary" id="request-preview-confirm-button">
            <input type="button" value="Edit" class="btn btn-link" id="request-preview-edit-button">

        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>
<!---****************
        END OF REQUEST
        ***************-->
<!--Pop up my profile-->
<div class="popup" id="my-profile">
    <!-- My profile content -->
    <div class="popup-content">

        <div class="popup-header">
            <span class="close" id="my-profile-close">&times;</span>
            <h2>My Profile</h2>
            <hr>
        </div>

        <div class="popup-body">

            <div class="col" style="text-align: center;">
                <div>
                    <img src="images/default-user-image.png" alt="" height="120px" width="120px" class="rounded-circle" style="cursor: pointer; vertical-align: middle; margin-bottom:20px ;">
                </div>

                <p id="user-nam">Name</p>
                <p id="user-occupation">Occupation</p>
                <p id="user-email">Email</p>
                <a href="">Change password</a>

            </div>

        </div>
        <div class="popup-footer">

        </div>
    </div>
</div>