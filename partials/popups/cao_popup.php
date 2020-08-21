    <!--Approve Table Row click Preview-->
    <div class="popup" id="RequestApprovePreviewPopup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="RequestApprovePreview_Close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="RequesterName-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Designation-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DateOfTrip-RequestApprovePreviewPopup">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="TimeOfTrip-RequestApprovePreviewPopup">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="PickLocation-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DropLocation-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Purpose-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>JO Comment</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="JOComment-RequestApprovePreviewPopup">Text</p>
                    </div>
                </div>

                <input type="button" value="Approve Request" class="btn btn-primary" id="RequestApprovePreview_Approve">
                <input type="button" value="Decline" class="btn btn-danger" id="RequestApprovePreview_Decline">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Approve Confirm alert-->
    <div class="popup" id="ApproveRequestAlertPopup">
        <!-- Approve alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="ApproveRequestAlert_Close">&times;</span>
                <h3>Do you wish to proceed?</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to approve the request?</p>
                <form id='CAOApprove_form'>
                    <input class="inputs" type="hidden" name="Status" value="Approved" disabled>
                    <textarea class="form-control inputs" id="CAOComment" name="CAOComment" placeholder="Comments" rows="4"></textarea>
                </form>
            </div>
            <div class="popup-footer">
                <input type="button" value="Approve Request" class="btn btn-success" id="ApproveRequestAlert_Approve">
                <input type="button" value="Cancel" class="btn btn-light" id="ApproveRequestAlert_Cancel">
            </div>
        </div>
    </div>

    <!--Decline Confirm alert-->
    <div class="popup" id="DenyRequestAlertPopup">
        <!-- Decline alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="DenyRequestAlert_Close">&times;</span>
                <h3>Do you wish to process?</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to decline the request?</p>
                <form id='CAODeny_form'>
                    <input class="inputs" type="hidden" name="Status" value="Denied" disabled>
                    <textarea class="form-control" name="CAOComment" placeholder="Comments" rows="4"></textarea>
                </form>
            </div>
            <div class="popup-footer">

                <input type="button" value="Decline Request" class="btn btn-danger" id="DenyRequestAlert_Decline">
                <input type="button" value="Cancel" class="btn btn-light" id="DenyRequestAlert_Cancel">
            </div>
        </div>
    </div>