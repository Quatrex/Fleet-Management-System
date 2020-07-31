    <!--Active Trip Table Row click Preview-->
    <div class="popup" id="ActiveTripDetailsPopup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="ActiveTripDetails_Close">&times;</span>
                <h3>Trip Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="RequesterName-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Designation-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DateOfTrip-ActiveTripDetailsPopup">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="TimeOfTrip-ActiveTripDetailsPopup">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="PickLocation-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DropOLocation-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Purpose-ActiveTripDetailsPopup"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Driver</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Driver-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Vehicle</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Vehicle-ActiveTripDetailsPopup">Text</p>
                    </div>
                </div>

                <input type="button" value="Print Slip" class="btn btn-success" id="ActiveTripDetails_PrintSlip" href="../../func/slip.php">
                <input type="button" value="End Trip" class="btn btn-primary" id="ActiveTripDetails_End">
                <input type="button" value="Cancel Request" class="btn btn-danger" id="ActiveTripDetails_Cancel">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Add Vehicle Popup-->
    <div class="popup" id="VehicleAddForm">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="VehicleAddForm_Close">&times;</span>
                <h2>Add Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <div id="submit-form-wrapper">
                    <form id="AddVehicle_form">
                        <input class="form-control my-3 inputs " placeholder="Vehicle model" type="text" name="model">
                        <input class="form-control my-3 inputs" placeholder="Registration Number" type="text" name="registrationNo">
                        <input type="date" name="purchasedYear" class="form-control my-3 inputs" placeholder="Date of purchase">
                        <input name="value" class="form-control my-3 inputs" placeholder="Price" type="number">
                        <input name="fuelType" class="form-control my-3 inputs" placeholder="Fuel type" type="text">
                        <input name="currentLocation" class="form-control my-3 inputs" placeholder="Current Location" type="text">
                        <h4>Insurance details</h4>
                        <input name="insuranceValue" class="form-control my-3 inputs" placeholder="Monthly installment" type="number">
                        <input name="insuranceCompany" class="form-control my-3 inputs" placeholder="Insurance company" type="text">
                        <div class="inline">
                            <p>Leased Vehicle</p>
                            <label class="radio-inline">
                                <input class="inputs" type="radio" name="isLeased" value="Yes" onclick="document.getElementById('leasing-details').style.display = 'block';">
                                <label for="isLeased">Yes</label>
                            </label>
                            <label class="radio-inline">
                                <input class="inputs" type="radio" name="isLeased" value="No" onclick="document.getElementById('leasing-details').style.display = 'none';">
                                <label for="isLeased">No</label>
                            </label>
                        </div>
                        <div id="leasing-details">
                            <h4>Leasing details</h4>
                            <input name="leasedCompany" class="form-control my-3 inputs" placeholder="Leasing company" type="text">
                            <input type="date" name="leasedPeriodFrom" class="form-control my-3 inputs" placeholder="Lease period (from)">
                            <input type="date" name="leasedPeriodTo" class="form-control my-3 inputs" placeholder="Lease period (to)">
                            <input name="monthlyPayment" class="form-control my-3 inputs" placeholder="Monthly installment" type="number">
                        </div>
                        <input type="button" value="Submit" class="btn btn-success" id="VehicleAddForm_Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Request Assign vehicle-->
    <div class="popup" id="RequestAssignPreviewPopup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="RequestAssignPreview_Close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="RequesterName-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Designation-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DateOfTrip-RequestAssignPreviewPopup">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="TimeOfTrip-RequestAssignPreviewPopup">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="PickLocation-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="DropLocation-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Purpose-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>JO Comment</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="JOComment-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>CAO Comment</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="CAOComment-RequestAssignPreviewPopup">Text</p>
                    </div>
                </div>

                <input type="button" value="Assign Vehicle" class="btn btn-primary" id="RequestAssignPreview_Assign">
                <input type="button" value="Cancel" class="btn btn-danger" id="RequestAssignPreview_Cancel">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Vehicle Selection -->
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
                        <p id="Vehicle-selectionVehicleTable"></p>
                    </span>
                </div>
                <table class="table table-hover" style="width:100%" id="selectionVehicleTable">
                    <thead class="thead-dark " style="position:relative; width:100%!important;">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Vehicle</th>
                            <th class="th-sm" scope="col">Assigned Driver</th>
                            <th class="th-sm" scope="col">Passengers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($vehicles as $vehicle) : ?>
                            <tr id="selectionVehicleTable_<?php echo $vehicle->getField('registrationNo') ?>">
                                <th id="vehicle-<?php echo $i ?>"><?php echo $vehicle->getField('registrationNo') ?></td>
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

    <!--Driver selection-->
    <div class="popup" id="SelectDriverAlertPopup">
        <!-- My profile content -->
        <div class="popup-content">

            <div class="popup-header">
                <span class="close" id="SelectDriverAlert_Close">&times;</span>
                <h2>Select driver</h2>
                <hr>
            </div>
            <div class="popup-body" style="max-height: 80vh;">
                <div class="row mx-auto">
                    <label class="mr-2">Selected Driver:</label> <span>
                        <p id="Driver-selectionDriverTable"></p>
                    </span>
                </div>
                <table id="selectionDriverTable" class="table table-hover" style="width:100%">
                    <thead class="thead-dark" style="width:100%!important">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Driver</th>
                            <th class="th-sm" scope="col">Location</th>
                            <th class="th-sm" scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($drivers as $driver) : ?>
                            <tr id="selectionDriverTable_<?php echo $driver->getField('driverId') ?>">
                                <th id="driver-<?php echo $i ?>"><?php echo $driver->getField('driverId') ?></td>
                                <td><?php echo $driver->getField('firstName') . ' ' . $driver->getField('lastName') ?></td>
                                <td><?php echo $driver->getField('purchasedYear') ?></td>
                                <td>Nothing</td>
                            </tr>
                        <?php $i++;
                        endforeach;; ?>
                    </tbody>
                </table>
            </div>
            <div class="popup-footer">
                <hr style="margin-bottom: 0.5rem;">
                <input type="button" value="Go back" class="btn btn-primary" style="margin-right:10px " id="SelectDriverAlert_Goback">
                <span class="d-inline-block" id="select-driver-tooltip" data-toggle="tooltip" title="Select a driver to enable"><input type="button" value="Confirm" class="btn btn-success" id="SelectDriverAlert_Confirm"></span>
            </div>
        </div>
    </div>

    <!--Final-preview-->
    <div class="popup" id="RequestFinalDetailsPopup">

        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="RequestFinalDetails_Close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Requester</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="RequesterName-RequestFinalDetailsPopup">DD-MM-YYYY</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DateOfTrip-RequestFinalDetailsPopup">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="TimeOfTrip-RequestFinalDetailsPopup">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="PickLocation-RequestFinalDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="DropLocation-RequestFinalDetailsPopup">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Driver</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Driver-RequestFinalDetailsPopup">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Vehicle</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="Vehicle-RequestFinalDetailsPopup">Text</p>
                    </div>
                </div>
                <input class="inputs" type="hidden" name="Status" value="Scheduled" disabled>
            </div>
            <div class="popup-footer">
                <input type="button" value="Confirm" class="btn btn-primary" id="RequestFinalDetails_Confirm">
                <input type="button" value="Go back" class="btn btn-danger" id="RequestFinalDetails_Back">

            </div>
        </div>
    </div>

    <!--Vehicle Profile Form-->
    <div class="popup" id="VehicleProfileForm">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="VehicleProfileForm_Close">&times;</span>
                <h2>Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form id="VehicleProfile_form">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Registration Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="registration-VehicleProfileForm" type="text" name="registrationNoDisplay" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="model-VehicleProfileForm" type="text" name="model" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Purchased Year</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="purchasedYear-VehicleProfileForm" type="text" name="purchasedYear" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="value-VehicleProfileForm" type="text" name="value" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Fuel Type</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="fuelType-VehicleProfileForm" type="text" name="fuelType" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Current Location</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="currentLocation-VehicleProfileForm" type="text" name="currentLocation" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Insurance Company</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="insuranceCompany-VehicleProfileForm" type="text" name="insuranceCompany" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Insurance Value</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="insuranceValue-VehicleProfileForm" type="text" name="insuranceValue" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none leasedVehicleData">
                                <div class="form-group row ">
                                    <div class="form-group col-md-6">
                                        <label>Leased Company</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border" id="leasedCompany-VehicleProfileForm" type="text" name="leasedCompany" disabled>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased Value</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border" id="leasedValue-VehicleProfileForm" type="text" name="monthlyPayment" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label>Leased From</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border" id="leasedFrom-VehicleProfileForm" type="text" name="leasedPeriodFrom" disabled>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased To</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border" id="leasedTo-VehicleProfileForm" type="text" name="leasedPeriodTo" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <input type="button" value="Edit" class="btn btn-primary" id="VehicleProfileForm_Edit">
                        <input type="button" class="btn btn-danger" value="Delete" id="VehicleProfileForm_Delete">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Vehicle Edit Profile Form-->
    <div class="popup" id="VehicleProfileEditForm">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="VehicleProfileEditForm_Close">&times;</span>
                <h2>Edit Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form id="UpdateVehicle_form">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Registration Number</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="registration-VehicleProfileEditForm" type="text" name="registrationNoDisplay">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="model-VehicleProfileEditForm" type="text" name="model">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Purchased Year</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="purchasedYear-VehicleProfileEditForm" type="text" name="purchasedYear">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="value-VehicleProfileEditForm" type="text" name="value">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Fuel Type</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="fuelType-VehicleProfileEditForm" type="text" name="fuelType">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Current Location</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="currentLocation-VehicleProfileEditForm" type="text" name="currentLocation">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Insurance Company</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="insuranceCompany-VehicleProfileEditForm" type="text" name="insuranceCompany">

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Insurance Value</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="insuranceValue-VehicleProfileEditForm" type="text" name="insuranceValue">
                                    </div>
                                </div>
                            </div>
                            <div class="d-none leasedVehicleData">
                                <div class="form-group row ">
                                    <div class="form-group col-md-6">
                                        <label>Leased Company</label>
                                        <div class="input-group">
                                            <input class="form-control inputs py-2 border-right-0 border" id="leasedCompany-VehicleProfileEditForm" type="text" name="leasedCompany">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased Value</label>
                                        <div class="input-group">
                                            <input class="form-control inputs py-2 border-right-0 border" id="leasedValue-VehicleProfileEditForm" type="text" name="monthlyPayment">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label>Leased From</label>
                                        <div class="input-group">
                                            <input class="form-control inputs py-2 border-right-0 border" id="leasedFrom-VehicleProfileEditForm" type="text" name="leasedPeriodFrom">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased To</label>
                                        <div class="input-group">
                                            <input class="form-control inputs py-2 border-right-0 border" id="leasedTo-VehicleProfileEditForm" type="text" name="leasedPeriodTo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="VehicleProfileEditForm_Confirm"></span>
                        <input type="button" value="Cancel" class="btn btn-primary" id="VehicleProfileEditForm_Cancel">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Vehicle Alert-->
    <div class="popup" id="DeleteVehicleAlertPopup">
        <!-- Confirm alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="DeleteVehicleAlert_Close">&times;</span>
                <h3>Delete Vehicle</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to delete vehicle?</p>
                <input type="button" value="Yes" class="btn btn-danger" id="DeleteVehicleAlert_Delete">
                <input type="button" value="No" class="btn btn-primary" id="DeleteVehicleAlert_Cancel">
            </div>
        </div>
    </div>
    <!--End Trip Confirm-->
    <div class="popup" id="EndTripConfirmPopup">
        <!-- Confirm alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="EndTripConfirm_Close">&times;</span>
                <h3 id="cancel-alert-header">End Trip</h3>
                <hr>
            </div>
            <div class="popup-body">
                <input class="inputs" type="hidden" name="Status" value="Completed" disabled>
                <p id="cancel-alert-message">Are you sure you want to end the trip?</p>
                <input type="button" value="Yes" class="btn btn-danger" id="EndTripConfirm_Confirm">
                <input type="button" value="No" class="btn btn-primary" id="EndTripConfirm_Cancel">
            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Driver profile Form-->
    <div class="popup" id="DriverProfileForm">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="DriverProfileForm_Close">&times;</span>
                <h2>Driver</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form id="DriverProfile_form">
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label>Driver ID</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="driverId-DriverProfileForm" type="text" name="driverID" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Employed Date</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="employedDate-DriverProfileForm" type="date" name="employedDate" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="firstName-DriverProfileForm" type="text" name="firstName" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="lastName-DriverProfileForm" type="text" name="lastName" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4 mx-auto">
                                <label>Address</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="address-DriverProfileForm" type="text" name="address" disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-4">
                                    <label>Assigned Vehicle</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="assignedVehicleID-DriverProfileForm" type="text" name="assignedVehicleID" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="contactNo-DriverProfileForm" type="text" name="contactNo" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="email-DriverProfileForm" type="text" name="email" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="form-group col-md-4">
                                    <label>License ID</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="licenseID-DriverProfileForm" type="text" name="designation" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>License Type</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border " id="licenseType-DriverProfileForm" type="text" name="contactNo" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>License Expirey Date</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="licenseExpDate-DriverProfileForm" type="text" name="email" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <input type="button" value="Assign Vehicle" class="btn btn-primary" id="DriverProfileForm_AssignVehicle">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Vehicle Selection -->
    <div class="popup" id="AssignVehicleToDriverPopup">
        <!-- My profile content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="AssignVehicleToDriver_Close">&times;</span>
                <h2>Select Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body" style="max-height: 80vh;">
                <div class="row mx-auto">
                    <label class="mr-2">Assign Vehicle:</label> <span>
                        <p id="assignedVehicleID-assignVehicleToDriverTable"></p>
                    </span>
                </div>
                <table class="table table-hover" style="width:100%" id="assignVehicleToDriverTable">
                    <thead class="thead-dark " style="position:relative; width:100%!important;">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Vehicle</th>
                            <th class="th-sm" scope="col">Assigned Driver</th>
                            <th class="th-sm" scope="col">Passengers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($vehicles as $vehicle) : ?>
                            <tr id="assignVehicleToDriverTable_<?php echo $vehicle->getField('registrationNo') ?>">
                                <th id="vehicle-<?php echo $i ?>"><?php echo $vehicle->getField('registrationNo') ?></td>
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
                <input type="button" value="Go Back" class="btn btn-primary" style="margin-right:10px " id="AssignVehicleToDriver_Goback">
                <span class="d-inline-block" id="select-vehicle-tooltip" data-toggle="tooltip" title="Select a vehicle to enable"><input type="button" value="Confirm" class="btn btn-success" id="AssignVehicleToDriver_Confirm"></span>

            </div>
        </div>
    </div>