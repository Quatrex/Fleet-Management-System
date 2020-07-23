    <!--Justify Table Row click Preview-->
    <div class="popup" id="RequestJustifyPreviewPopup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="RequestJustifyPreview_Close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="RequesterName-RequestJustifyPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Designation-RequestJustifyPreviewPopup">Hadanna ona meka</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DateOfTrip-RequestJustifyPreviewPopup">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="TimeOfTrip-RequestJustifyPreviewPopup">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="PickLocation-RequestJustifyPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DropLocation-RequestJustifyPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Purpose-RequestJustifyPreviewPopup">Text</p>
                    </div>
                </div>

                <input type="button" value="Justify Request" class="btn btn-primary" id="RequestJustifyPreview_Approve">
                <input type="button" value="Decline" class="btn btn-danger" id="RequestJustifyPreview_Decline">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Content After Clicking Justify in Request Details-->
    <div class="popup" id="JustifyRequestAlertPopup">
        <!-- Justify alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="JustifyRequestAlert_Close">&times;</span>
                <h3>Do you wish to proceed?</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to justify the request?</p>
                <textarea class="form-control inputs" name="JOComment" placeholder="Comments" rows="4"></textarea>
            </div>
            <div class="popup-footer">

                <input type="button" value="Cancel" class="btn btn-light" id="JustifyRequestAlert_Cancel">
                <input type="button" value="Justify Request" class="btn btn-success" id="JustifyRequestAlert_Justify">
            </div>
        </div>
    </div>

    <!--Decline Confirm alert-->
    <div class="popup" id="DeclineRequestAlertPopup">
        <!-- Decline alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="DeclineRequestAlert_Close">&times;</span>
                <h3>Do you wish to process?</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to decline the request?</p>
                <textarea class="form-control inputs" name="JOComment" placeholder="Comments" rows="4"></textarea>
            </div>
            <div class="popup-footer">
                <input type="button" value="Decline Request" class="btn btn-danger" id="DeclineRequestAlert_Decline">
                <input type="button" value="Cancel" class="btn btn-light" id="DeclineRequestAlert_Cancel">
            </div>
        </div>
    </div>


