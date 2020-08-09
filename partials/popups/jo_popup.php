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
    <div class="popup " id="JustifyRequestAlertPopup">
        <!-- Justify alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="JustifyRequestAlert_Close">&times;</span>
                <h3>Do you wish to proceed?</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to justify the request?</p>
                <form id='JOJustify_form'>
                    <input class="inputs" type="hidden" name="Status" value="Justified" disabled>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control inputs" id ="JOSelectedVehicle-JustifyRequestAlertPopup" name="JOSelectedVehicle" placeholder="Select Vehicle (Optional)" disabled>
                        <div class="input-group-append">
                            <input type="button" class="btn btn-outline-secondary"  id="JustifyRequestAlert_SelectVehicle" value="Choose">
                        </div>
                    </div>
                    <textarea class="form-control inputs" name="JOComment" placeholder="Comments" rows="4"></textarea>
                </form>
            </div>
            <div class="popup-footer mt-3">
                <input type="button" value="Justify Request" class="btn btn-success mr-2" id="JustifyRequestAlert_Justify">
                <input type="button" value="Cancel" class="btn btn-light" id="JustifyRequestAlert_Cancel">
            </div>
        </div>
    </div>

    <div class="popup" id="SelectVehicleAlertPopup">
        <!-- My profile content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="SelectVehicleAlert_Close">&times;</span>
                <h2>Select Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body" style="max-height: 80vh;">
                <div class="row mx-auto">
                    <label class="mr-2">Selected Vehicle:</label> <span>
                        <p id="JOSelectedVehicle-selectionVehicleTable"></p>
                    </span>
                </div>
                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark " style="position:relative; width:100%!important;">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Vehicle</th>
                            <th class="th-sm" scope="col">Assigned Driver</th>
                            <th class="th-sm" scope="col">Passengers</th>
                        </tr>
                    </thead>
                    <tbody id="selectionVehicleTable">
                        <?php
                        $i = 0;
                        foreach ($vehicles as $vehicle) : ?>
                            <tr id="selectionVehicleTable_<?php echo $vehicle->getField('registrationNo') ?>">
                                <th id="vehicle-<?php echo $i ?>"><?php echo $vehicle->getField('registrationNo') ?></th>
                                <td><?php echo $vehicle->getField('model') ?></td>
                                <td><?php echo $vehicle->getField('purchasedYear') ?></td>
                                <td>Nothing</td>
                            </tr>
                        <?php $i++;
                        endforeach;; ?>
                    </tbody>
                </table>
            </div>

            <div class="popup-footer">
                <hr style="margin-bottom: 0.5rem;">
                <input type="button" value="Go Back" class="btn btn-primary" style="margin-right:10px " id="SelectVehicleAlert_Goback">
                <span class="d-inline-block" id="select-vehicle-tooltip" data-toggle="tooltip" title="Select a vehicle to enable"><input type="button" value="Confirm" class="btn btn-success" id="SelectVehicleAlert_Confirm"></span>

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
                <form id='JODeny_form'>
                    <input class="inputs" type="hidden" name="Status" value="Justified" disabled>
                    <textarea class="form-control inputs" name="JOComment" placeholder="Comments" rows="4"></textarea>
                </form>
            </div>
            <div class="popup-footer">
                <input type="button" value="Decline Request" class="btn btn-danger" id="DeclineRequestAlert_Decline">
                <input type="button" value="Cancel" class="btn btn-light" id="DeclineRequestAlert_Cancel">
            </div>
        </div>
    </div>