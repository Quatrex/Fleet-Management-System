    <!--Approve Table Row click Preview-->
    <div class="popup" id="request-approve-preview-popup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-approve-preview-close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-requester">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-designation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-date">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-time">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-pick">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-drop">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="approve-preview-purpose">Text</p>
                    </div>
                </div>

                <input type="button" value="Approve Request" class="btn btn-primary" id="request-details-approve-button">
                <input type="button" value="Decline" class="btn btn-danger" id="request-details-decline-button">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Approve Confirm alert-->
    <div class="popup" id="approve-request-alert">
        <!-- Approve alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="confirm-alert-close-approve">&times;</span>
                <h3>Do you wish to process?</h3>
                <hr>
            </div>
            <div class="popup-body">

                <p>Are you sure you want to approve the request?</p>
                <form id='CAOApprove_form'>
                    <textarea class="form-control" id="approve-comment" name="approve-comment" placeholder="Comments" rows="4"></textarea>
                    <input type="hidden" name="approve-requestID" id="approve-requestID" />
                </form>


            </div>
            <div class="popup-footer">

                <input type="button" value="Approve Request" class="btn btn-success" id="approve-alert-approve-button">
                <input type="button" value="Cancel" class="btn btn-light" id="approve-alert-cancel-button">
            </div>
        </div>
    </div>

    <!--Decline Confirm alert-->
    <div class="popup" id="decline-request-alert">
        <!-- Decline alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="confirm-alert-close-decline">&times;</span>
                <h3>Do you wish to process?</h3>
                <hr>
            </div>
            <div class="popup-body">

                <p>Are you sure you want to decline the request?</p>
                <form id='CAODeny_form'>
                    <textarea class="form-control" name="CAO-deny-comment" placeholder="Comments" rows="4"></textarea>
                    <input type="hidden" name="CAOdeny-requestID" id="CAOdeny-requestID" />
                </form>


            </div>
            <div class="popup-footer">

                <input type="button" value="Decline Request" class="btn btn-danger" id="decline-alert-decline-button">
                <input type="button" value="Cancel" class="btn btn-light" id="decline-alert-cancel-button">
            </div>
        </div>
    </div>