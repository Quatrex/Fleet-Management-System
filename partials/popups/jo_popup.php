    <!--Denied Table request preview-->
    <div class="popup" id="request-denied-table-preview-popup">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-denied-preview-close">&times;</span>
                <h3>Preview</h3>
                <hr>
            </div>
            <div class="popup-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p>DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p>HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Status</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Justify Table Row click Preview-->
    <div class="popup" id="request-justify-table-preview-popup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-justify-preview-close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p>DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p>HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Status</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <input type="button" value="Approve Request" class="btn btn-primary" id="request-details-approve-button">
                <input type="button" value="Decline" class="btn btn-danger" id="request-details-decline-button">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>
    <!--Content After Clicking Justify in Request Details-->
    <div class="popup" id="justify-request-alert">
        <!-- Justify alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="confirm-alert-close-approve">&times;</span>
                <h3>Do you wish to procees?</h3>
                <hr>
            </div>
            <div class="popup-body">

                <p>Are you sure you want to justify the request?</p>
                <textarea placeholder="Comments" rows="4"></textarea>
            </div>
            <div class="popup-footer">

                <input type="button" value="Justify Request" class="btn btn-success" id="justify-alert-justify-button">
                <input type="button" value="Cancel" class="btn btn-light" id="justify-alert-cancel-button">
            </div>
        </div>
    </div>

    <!--Decline Confirm alert-->
    <div class="popup" id="cancel-request-alert-justify">
        <!-- Decline alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="confirm-alert-close-decline">&times;</span>
                <h3>Do you wish to process?</h3>
                <hr>
            </div>
            <div class="popup-body">

                <p>Are you sure you want to decline the request?</p>
                <textarea placeholder="Comments" rows="4"></textarea>
            </div>
            <div class="popup-footer">

                <input type="button" value="Decline Request" class="btn btn-danger" id="decline-alert-decline-button">
                <input type="button" value="Cancel" class="btn btn-light" id="decline-alert-cancel-button">
            </div>
        </div>
    </div>
