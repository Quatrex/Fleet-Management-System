    <!--Ongoing Table Row click Preview-->
    <div class="popup" id="ongoing-table-details-popup">
        <!-- Request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="ongoing-preview-close">&times;</span>
                <h3>Trip Details</h3>
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

                <input type="button" value="End Trip" class="btn btn-primary" id="ongoing-end-button">
                <input type="button" value="Cancel" class="btn btn-danger" id="ongoing-close-button">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Add Vehicle Popup-->
    <div class="popup" id="vehicle-add-form">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="vehicle-add-form-close">&times;</span>
                <h2>Add Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <div id="submit-form-wrapper">
                    <form id="AddVehicle_form">
                        <input class="form-control my-3" placeholder="Vehicle model" type="text" name="model">
                        <input class="form-control my-3" placeholder="Registration Number" type="text" name="registrationNo">
                        <input type="date" name="purchasedYear" class="form-control my-3" placeholder="Date of purchase">
                        <input name="value" class="form-control my-3" placeholder="Price" type="number">
                        <input name="fuelType" class="form-control my-3" placeholder="Fuel type" type="text">
                        <input name="currentLocation" class="form-control my-3" placeholder="Current Location" type="text">
                        <h4>Insurance details</h4>
                        <input name="insuranceValue" class="form-control my-3" placeholder="Monthly installment" type="number">
                        <input name="insuranceCompany" class="form-control my-3" placeholder="Insurance company" type="text">
                        <div class="inline">
                            <p>Leased Vehicle</p>
                            <label class="radio-inline">
                                <input type="radio" name="isLeased" value="Yes" onclick="document.getElementById('leasing-details').style.display = 'block';">
                                <label for="isLeased">Yes</label>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="isLeased" value="No" onclick="document.getElementById('leasing-details').style.display = 'none';">
                                <label for="isLeased">No</label>
                            </label>
                        </div>
                        <div id="leasing-details">
                            <h4>Leasing details</h4>
                            <input name="leasedCompany" class="form-control my-3" placeholder="Leasing company" type="text">
                            <input type="date" name="leasedPeriodFrom" class="form-control my-3" placeholder="Lease period (from)">
                            <input type="date" name="leasedPeriodTo" class="form-control my-3" placeholder="Lease period (to)">
                            <input name="monthlyPayment" class="form-control my-3" placeholder="Monthly installment" type="number">
                        </div>
                        <input type="button" value="Submit" class="btn btn-success" id="vehicle-add-form-submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Request Assign vehicle-->
    <div class="popup" id="request-assign-preview-popup">
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
                        <p id="vpmo-assign-requester">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Designation</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="vpmo-assign-designation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-date">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-time">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-pickUpLocation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-dropOffLocation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Purpose</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="vpmo-assign-purpose">Text</p>
                    </div>
                </div>

                <input type="button" value="Assign Vehicle" class="btn btn-primary" id="request-details-approve-button">
                <input type="button" value="Close" class="btn btn-danger" id="request-details-decline-button">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Vehicle Selection -->
    <div class="popup" id="select-vehicle-alert">
        <!-- My profile content -->
        <div class="popup-content">

            <div class="popup-header">
                <span class="close" id="vehicle-close">&times;</span>
                <h2>Select Vehicle</h2>
                <hr>
            </div>

            <div class="popup-body" style="max-height: 80vh;">
                <div class="row" style="overflow:wrap;">
                    <div class="col-sm-12 col-md-4">
                        <label>Show<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control form-control-sm" style=" margin-left: 10px;display:inline-block; border: 0 none; width:auto !important">
                                <option value="10">All Vehicles</option>
                                <option value="25">Allocated Vehicles</option>
                                <option value="50">Free Vehicles</option>
                            </select></label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label style="margin: 10px 0px; padding-top: 2px;">Selected:<label id="vehicle-name" style="padding-left:10px"></label></label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" style="display:inline-block; margin-left: 15px; margin-bottom:0.5rem; width:auto!important" placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <div style="height:300px; overflow:auto;">
                    <table class="table table-hover w-auto" style="overflow-y: scroll;" id="selectionVehicleTable">
                        <thead class="thead-dark " style="position:relative">
                            <tr data-toggle="popup" data-id="my-profile" data-target="#my-profile">
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
            </div>
            <div class="popup-footer">
                <hr style="margin-bottom: 0.5rem;">
                <input type="button" value="Go Back" class="btn btn-primary" style="margin-right:10px " id="nothing">
                <input type="button" value="Confirm" class="btn btn-success" id="confirm-vehicle">

            </div>
        </div>
    </div>

    <!--Driver selection-->
    <div class="popup" id="select-driver-alert">
        <!-- My profile content -->
        <div class="popup-content">

            <div class="popup-header">
                <span class="close" id="driver-close">&times;</span>
                <h2>Select driver</h2>
                <hr>
            </div>

            <div class="popup-body" style="max-height: 80vh;">
                <div class="row" style="overflow:wrap;">
                    <div class="col-sm-12 col-md-4">
                        <label>Show<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control form-control-sm" style=" margin-left: 10px;display:inline-block; border: 0 none; width:auto !important">
                                <option value="10">All drivers</option>
                                <option value="25">Allocated drivers</option>
                                <option value="50">Free drivers</option>
                            </select></label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label style="margin: 10px 0px; padding-top: 2px;">Selected:<label id="driver-name" style="padding-left:10px"></label></label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" style="display:inline-block; margin-left: 15px; margin-bottom:0.5rem; width:auto!important" placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <div style="height:300px; overflow:auto;">
                    <table class="table table-hover w-auto" style="overflow-y: scroll;" id="selectionDriverTable">
                        <thead class="thead-dark " style="position:relative">
                            <tr data-toggle="popup" data-id="my-profile" data-target="#my-profile">
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
                                    <th id="driver-<?php echo $i ?>"><?php echo $driver->getField('registrationNo') ?></td>
                                    <td><?php echo $driver->getField('firstName').' '.$driver->getField('lastName') ?></td>
                                    <td><?php echo $driver->getField('purchasedYear') ?></td>
                                    <td>Nothing</td>
                                </tr>
                            <?php $i++;
                            endforeach;; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="popup-footer">
                <hr style="margin-bottom: 0.5rem;">
                <input type="button" value="Go back" class="btn btn-primary" style="margin-right:10px " id="go-back-driver">
                <input type="button" value="Confirm" class="btn btn-success" id="confirm-driver">

            </div>
        </div>
    </div>

    <!--Final-preview-->
    <div class="popup" id="request-final-details-popup">

        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-final-details-close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-date">DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-time">HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p >Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-pickUpLocation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="vpmo-assign-dropOffLocation">Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Driver</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="final-driver-p">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Vehicle</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="final-vehicle-p">Text</p>
                    </div>
                </div>
            </div>
            <div class="d-none">
                <form id="Schedule_form">
                    <input type="hidden" id="requestId-input">
                    <input type="hidden" id="final-vehicle-input">
                    <input type="hidden" id="final-driver-input">
                </form>
            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Vehicle Profile Form-->
    <div class="popup" id="vehicle-profile-form">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="vehicle-profile-form-close">&times;</span>
                <h2>Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form id="VehicleProfile_form">
                            <input class="form-control py-2 border-right-0 border vehicle-registrationNoCopy" type="hidden" name="registrationNo">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Registration Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-registrationNo" type="text" name="registrationNoDisplay" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-model" type="text" name="model" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Purchased Year</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-purchasedYear" type="text" name="purchasedYear" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-price" type="text" name="value" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Fuel Type</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-fuelType" type="text" name="fuelType" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Current Location</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-currentLocation" type="text" name="currentLocation" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Insurance Company</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-insuranceCompany" type="text" name="insuranceCompany" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Insurance Value</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-insuranceValue" type="text" name="insuranceValue" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none leasedVehicleData">
                                <div class="form-group row ">
                                    <div class="form-group col-md-6">
                                        <label>Leased Company</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-leasedCompany" type="text" name="leasedCompany" disabled>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased Value</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-leasedValue" type="text" name="monthlyPayment" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label>Leased From</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-leasedFrom" type="text" name="leasedPeriodFrom" disabled>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Leased To</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-leasedTo" type="text" name="leasedPeriodTo" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <input type="button" value="Edit" class="btn btn-primary" id="vehicle-profile-edit-button">
                        <input type="button" class="btn btn-danger" value="Delete" id="vehicle-delete">

                    </div>


                </div>
            </div>
        </div>

    </div>

    <!--Vehicle Profile Form-->
    <div class="popup" id="vehicle-profile-edit-form">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="vehicle-profile-edit-form-close">&times;</span>
                <h2>Edit Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form id="UpdateVehicle_form">
                            <input class="form-control py-2 border-right-0 border  vehicle-edit vehicle-registrationNoCopy" type="hidden" name="registrationNo">
                            ` <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Registration Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-registrationNo" type="text" name="registrationNoDisplay" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-model" type="text" name="model">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Purchased Year</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-purchasedYear" type="text" name="purchasedYear">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-price" type="text" name="value">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Fuel Type</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-fuelType" type="text" name="fuelType">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Current Location</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-currentLocation" type="text" name="currentLocation">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Insurance Company</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-insuranceCompany" type="text" name="insuranceCompany">

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Insurance Value</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-insuranceValue" type="text" name="insuranceValue">
                                    </div>
                                </div>
                            </div>
                            <div class="d-none leasedVehicleData">
                                <div class="form-group row ">
                                    <div class="form-group col-md-6">
                                        <label>Leased Company</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-leasedCompany" type="text" name="leasedCompany">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>Leased Value</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-leasedValue" type="text" name="monthlyPayment">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="form-group col-md-6">
                                        <label>Leased From</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-leasedFrom" type="text" name="leasedPeriodFrom">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>Leased To</label>
                                        <div class="input-group">
                                            <input class="form-control py-2 border-right-0 border vehicle-edit vehicle-leasedTo" type="text" name="leasedPeriodTo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <span class="d-inline-block" id="edit-confirm-tooltip" data-toggle="tooltip" title="Make changes to enable"><input type="button" class="btn btn-success" value="Confirm" id="confirm-vehicle-profile" disabled></span>
                        <input type="button" value="Cancel" class="btn btn-primary" id="vehicle-profile-edit-cancel-button">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Vehicle Alert-->
    <div class="popup" id="delete-vehicle-alert">
        <!-- Confirm alert content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="confirm-alert-close">&times;</span>
                <h3>Delete Vehicle</h3>
                <hr>
            </div>
            <div class="popup-body">
                <p>Are you sure you want to delete vehicle?</p>
                <input type="button" value="Yes" class="btn btn-danger" id="confirm-vehicle-delete-button">
                <input type="button" value="No" class="btn btn-primary" id="vehicle-delete-cancel-button">
            </div>
        </div>
    </div>