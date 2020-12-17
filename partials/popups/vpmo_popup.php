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
                    <p id="DropLocation-ActiveTripDetailsPopup">Text</p>
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
                    <div class="center" style="text-align: center; ">
                        <img src='../images/vehiclePictures/default-vehicle.png' id="VehiclePicturePath-AddVehicleForm" class="form-image" style="padding:5px; width:25%;text-align: center;">
                    </div>
                    <div class="overlay">
                        <i class="fa fa-camera upload-button" data-input='ChangeVehiclePicture' style="cursor: pointer;"></i>
                        <input type="file" name="Image" id="AddVehicleImage" class="file-upload inputs" data-imageid="VehiclePicturePath-AddVehicleForm" accept="image/png, .jpeg, .jpg, image/gif" />
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="Model">Model</label>
                            <input class="form-control my-3 inputs " placeholder="Vehicle model" type="text" name="Model">
                            <div id="Model-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="RegistrationNo">Registration Number</label>
                            <input class="form-control my-3 inputs" placeholder="Registration Number" type="text" name="RegistrationNo">
                            <div id="RegistrationNo-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="PurchasedYear">Date of purchase</label>
                            <input type="text" name="PurchasedYear" class="form-control my-3 inputs" placeholder="Date of purchase" onfocus="(this.type='date')" max="<?php echo date("Y-m-d"); ?>">
                            <div id="PurchasedYear-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="Value">Price</label>
                            <input name="Value" class="form-control my-3 inputs" placeholder="Price" type="number">
                            <div id="Value-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="FuelType">Fuel Type</label>
                            <input name="FuelType" class="form-control my-3 inputs" placeholder="Fuel type" type="text">
                            <div id="FuelType-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="CurrentLocation">Current Location</label>
                            <input name="CurrentLocation" class="form-control my-3 inputs" placeholder="Current Location" type="text">
                            <div id="CurrentLocation-error" class="text-danger"></div>
                        </div>
                    </div>
                    <h4>Insurance details</h4>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="InsuranceValue">Monthly installment</label>
                            <input name="InsuranceValue" class="form-control my-3 inputs" placeholder="Monthly installment" type="number">
                            <div id="InsuranceValue-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="InsuranceCompany">Insurance company</label>
                            <input name="InsuranceCompany" class="form-control my-3 inputs" placeholder="Insurance company" type="text">
                            <div id="InsuranceCompany-error" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="inline">
                        <p>Leased Vehicle</p>
                        <label class="radio-inline">
                            <input class="inputs" type="radio" id="leased_Yes" name="IsLeased" value="Yes" onclick="document.getElementById('leasing-details').style.display = 'block';">
                            <label for="IsLeased">Yes</label>
                        </label>
                        <label class="radio-inline">
                            <input class="inputs" type="radio" id="leased_No" name="IsLeased" value="No" onclick="document.getElementById('leasing-details').style.display = 'none';">
                            <label for="IsLeased">No</label>
                        </label>
                    </div>
                    <div id="leasing-details">
                        <h4>Leasing details</h4>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="LeasedCompany">Leasing company</label>
                                <input name="LeasedCompany" class="form-control my-3 inputs" placeholder="Leasing company" type="text">
                                <div id="LeasedCompany-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="LeasedPeriodFrom">Lease period (from)</label>
                                <input type="text" name="LeasedPeriodFrom" class="form-control my-3 inputs" placeholder="Lease period (from)" onfocus="(this.type='date')" max="<?php echo date("Y-m-d"); ?>">
                                <div id="LeasedPeriodFrom-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="LeasedPeriodTo">Lease period (to)</label>
                                <input type="text" name="LeasedPeriodTo" class="form-control my-3 inputs" placeholder="Lease period (to)" onfocus="(this.type='date')" min="<?php echo date("Y-m-d"); ?>">
                                <div id="LeasedPeriodTo-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="MonthlyPayment">Monthly installment</label>
                                <input name="MonthlyPayment" class="form-control my-3 inputs" placeholder="Monthly installment" type="number">
                                <div id="MonthlyPayment-error" class="text-danger"></div>
                            </div>
                        </div>
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
        <div class="popup-body" id="selectionVehicleTable">
            <div class="row mx-auto">
                <label class="mr-2">Selected Vehicle:</label> <span>
                    <p id="Vehicle-selectionVehicleTable"></p>
                </span>
            </div>
            <div class="container-fluid search-container">
                <div class="row mt-3 pt-3 ml-3 border">
                    <div class="col-sm-6 mb-3">
                        <div class="input-group">
                            <div class="row w-100">
                                <div class="col-sm-6 pr-0 form-group position-relative">
                                    <input type="text" class="form-control pr-2" id="selectionVehicleTable_SearchInput" placeholder="Search" style="border-radius: 0px!important;">
                                    <span class="form-clear searchTabButton d-none mr-2" id="Cancel_Confirm_button"><i class="material-icons">clear</i></span>

                                </div>
                                <div class="col-sm-3">
                                    <select class="custom-select mr-sm-2" data-field="Search" style="border-radius: 0px!important;">
                                        <option selected>Registration No</option>
                                        <option value="Value">Value</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="button" class="btn btn-primary searchTabButton" id="Search_Confirm_selectionVehicleTable" value="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 ml-2">
                        <div class="row">
                            <div class="sm-8">
                                <div class="row">
                                    <div class="col-sm-2 my-auto mr-1">
                                        <label class="mr-2">Sort</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="custom-select mr-sm-2" data-field="Sort">
                                            <option selected>Registration No</option>
                                            <option value="Value">Value</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ml-2 my-auto">
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Desc_selectionVehicleTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-down-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z" />
                                        <path fill-rule="evenodd" d="M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Asc_selectionVehicleTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-up-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 14a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-1 0v10a.5.5 0 0 0 .5.5z" />
                                        <path fill-rule="evenodd" d="M5.354 5.854a.5.5 0 0 0 0-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L3 4.207l1.646 1.647a.5.5 0 0 0 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-y:scroll;overflow-x:hidden;height: 50%;">
                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark " style="position:relative; width:100%!important;">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Vehicle</th>
                            <th class="th-sm" scope="col">Allocations</th>
                            <th class="th-sm" scope="col">Info</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    </tbody>
                </table>
                <div class="row d-flex justify-content-center"><button class="btn w-100 btn-light load-more mb-3 mr-5 ml-5" id="selectionVehicleTable_LoadMore">Load More</button></div>
            </div>
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
        <div class="popup-body" id="selectionDriverTable">
            <div class="row mx-auto">
                <label class="mr-2">Selected Driver:</label> <span>
                    <p id="Driver-selectionDriverTable"></p>
                </span>
            </div>
            <div class="container-fluid search-container">
                <div class="row mt-3 pt-3 ml-3 border">
                    <div class="col-sm-6 mb-3">
                        <div class="input-group">
                            <div class="row w-100">
                                <div class="col-sm-6 pr-0 form-group position-relative">
                                    <input type="text" class="form-control pr-2" id="selectionDriverTable_SearchInput" placeholder="Search" style="border-radius: 0px!important;">
                                    <span class="form-clear searchTabButton d-none mr-2" id="Cancel_Confirm_button"><i class="material-icons">clear</i></span>

                                </div>
                                <div class="col-sm-3">
                                    <select class="custom-select mr-sm-2" data-field="Search" style="border-radius: 0px!important;">
                                        <option selected>Date Of Trip</option>
                                        <option value="Time Of Trip">Time Of Trip</option>
                                        <option value="Purpose">Purpose</option>
                                        <option value="Drop Location">Drop Location</option>
                                        <option value="Pick Location">Pick Location</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="button" class="btn btn-primary searchTabButton" id="Search_Confirm_selectionDriverTable" value="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 ml-2">
                        <div class="row">
                            <div class="sm-8">
                                <div class="row">
                                    <div class="col-sm-2 my-auto mr-1">
                                        <label class="mr-2">Sort</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="custom-select mr-sm-2" data-field="Sort">
                                            <option selected>Date Of Trip</option>
                                            <option value="Time Of Trip">Time Of Trip</option>
                                            <option value="Purpose">Purpose</option>
                                            <option value="Drop Location">Drop Location</option>
                                            <option value="Pick Location">Pick Location</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ml-2 my-auto">
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Desc_selectionDriverTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-down-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z" />
                                        <path fill-rule="evenodd" d="M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Asc_selectionDriverTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-up-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 14a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-1 0v10a.5.5 0 0 0 .5.5z" />
                                        <path fill-rule="evenodd" d="M5.354 5.854a.5.5 0 0 0 0-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L3 4.207l1.646 1.647a.5.5 0 0 0 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-y:scroll;overflow-x:hidden;height: 50%;">
                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark" style="width:100%!important">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Driver</th>
                            <th class="th-sm" scope="col">AssignedVehicleId</th>
                            <th class="th-sm" scope="col">Assigned Trips</th>
                            <th class="th-sm" scope="col">Trips</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    </tbody>
                </table>
                <div class="row d-flex justify-content-center"><button class="btn w-100 btn-light load-more mb-3 mr-5 ml-5 d-none" id="selectionDriverTable_LoadMore">Load More</button></div>
            </div>
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
                    <p id="DriverName-RequestFinalDetailsPopup">Text</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <p>Vehicle</p>
                </div>
                <div class="col-sm-6">
                    <p id="Model-RequestFinalDetailsPopup">Text</p>
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
            <img src="../images/vehiclePictures/default-vehicle.png" id="VehiclePicturePath-VehicleProfileForm" class="form-image image-fluid mx-auto" style="width:24rem;">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="VehicleProfile_form">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Registration Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border inputs" id="RegistrationNo-VehicleProfileForm" type="text" name="RegistrationNo" disabled>
                                    <input class="form-control py-2 border-right-0 border inputs d-none" id="NewRegistrationNo-VehicleProfileForm" type="text" name="NewRegistrationNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Model</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="Model-VehicleProfileForm" type="text" name="Model" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Purchased Year</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="PurchasedYear-VehicleProfileForm" type="text" name="PurchasedYear" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="Value-VehicleProfileForm" type="text" name="Value" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Fuel Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="FuelType-VehicleProfileForm" type="text" name="FuelType" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Current Location</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="CurrentLocation-VehicleProfileForm" type="text" name="CurrentLocation" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Insurance Company</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="InsuranceCompany-VehicleProfileForm" type="text" name="InsuranceCompany" disabled>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Insurance Value</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="InsuranceValue-VehicleProfileForm" type="text" name="InsuranceValue" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="d-none leasedVehicleData">
                            <div class="form-group row ">
                                <div class="form-group col-md-6">
                                    <label>Leased Company</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="LeasedCompany-VehicleProfileForm" type="text" name="LeasedCompany" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Leased Value</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="MonthlyPayment-VehicleProfileForm" type="text" name="MonthlyPayment" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Leased From</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="LeasedPeriodFrom-VehicleProfileForm" type="text" name="LeasedPeriodFrom" disabled>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Leased To</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" id="LeasedPeriodTo-VehicleProfileForm" type="text" name="LeasedPeriodTo" disabled>
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
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="UpdateVehicle_form" enctype="multipart/form-data">
                        <div class="center" style="text-align: center; ">
                            <img src='../images/vehiclePictures/default-vehicle.png' id="VehiclePicturePath-VehicleProfileEditForm" class="form-image" style="padding:5px; width:50%;text-align: center;">
                        </div>
                        <div class="overlay">
                            <i class="fa fa-camera upload-button" data-input='ChangeVehiclePicture' style="cursor: pointer;"></i>
                            <input type="file" name="Image" id="UpdateVehicleImage" class="file-upload inputs" data-imageid="VehiclePicturePath-VehicleProfileEditForm" accept="image/png, .jpeg, .jpg, image/gif" />
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Registration Number</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border d-none" id="RegistrationNo-VehicleProfileEditForm" type="text" name="RegistrationNo" required>
                                    <input class="form-control inputs py-2 border-right-0 border" id="NewRegistrationNo-VehicleProfileEditForm" type="text" name="NewRegistrationNo" required>
                                    <div id="NewRegistrationNo-error" class="text-danger"></div>
                                    <div id="RegistrationNo-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Model</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="Model-VehicleProfileEditForm" type="text" name="Model" required>
                                    <div id="Model-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Purchased Year</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="PurchasedYear-VehicleProfileEditForm" type="text" name="PurchasedYear">
                                    <div id="PurchasedYear-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="Value-VehicleProfileEditForm" type="text" name="Value">
                                    <div id="Value-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Fuel Type</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="FuelType-VehicleProfileEditForm" type="text" name="FuelType" required>
                                    <div id="FuelType-error" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Current Location</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="CurrentLocation-VehicleProfileEditForm" type="text" name="CurrentLocation">
                                    <div id="CurrentLocation-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label>Insurance Company</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="InsuranceCompany-VehicleProfileEditForm" type="text" name="InsuranceCompany" required>
                                    <div id="InsuranceCompany-error" class="text-danger"></div>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Insurance Value</label>
                                <div class="input-group">
                                    <input class="form-control inputs py-2 border-right-0 border" id="InsuranceValue-VehicleProfileEditForm" type="text" name="InsuranceValue" required>
                                    <div id="InsuranceValue-error" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none leasedVehicleData">
                            <div class="form-group row ">
                                <div class="form-group col-md-6">
                                    <label>Leased Company</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="LeasedCompany-VehicleProfileEditForm" type="text" name="LeasedCompany">
                                        <div id="LeasedCompany-error" class="text-danger"></div>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Leased Value</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="MonthlyPayment-VehicleProfileEditForm" type="text" name="MonthlyPayment">
                                        <div id="MonthlyPayment-error" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>Leased From</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="LeasedPeriodFrom-VehicleProfileEditForm" type="text" name="LeasedPeriodFrom">
                                        <div id="LeasedPeriodFrom-error" class="text-danger"></div>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Leased To</label>
                                    <div class="input-group">
                                        <input class="form-control inputs py-2 border-right-0 border" id="LeasedPeriodTo-VehicleProfileEditForm" type="text" name="LeasedPeriodTo">
                                        <div id="LeasedPeriodTo-error" class="text-danger"></div>
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
<!-- change vehicle picture -->
<!-- <div id="ChangeVehiclePictureForm" class="popup">
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="ChangeVehiclePictureForm_Close">&times;</span>
            <h2>Change Picture</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div class="modal-body">
                <form id="ChangeVehiclePicture_Form" method="post" enctype="multipart/form-data">
                    <strong>Upload Image:</strong> <br><br>
                    <input type="file" name="vehicleImage" id="ChangeVehiclePicture" class="inputs" accept="image/png, .jpeg, .jpg, image/gif" />
                    <input class="inputs" type="hidden" name="Method" value='ChangeVehiclePicture' disabled>
                    <div id="while-uploading"></div>
                    <div class="col" style="text-align: center;">
                        <img id='preview-vehicle-pic' class="form-image VehiclePicture" src="<?php //echo $employee->getField('vehiclePicturePath') != null ? "../images/userVehiclePictures/" . $employee->getField('vehiclePicturePath') : "../images/default-user-image.png"; 
                                                                                                ?>" style="padding:5px; width:50%;"></img>
                    </div>
                    <div id="thumbs" style="padding:5px; width:600p"></div>
                    <input type="button" value="Save" class="btn btn-primary" id="ChangeVehiclePictureForm_Submit">
                    <input type="button" value="Close" class="btn btn-primary" id="ChangeVehiclePictureForm_Cancel">
                </form>
            </div>
        </div>
        <div class="popup-footer">

        </div>
    </div>
</div> -->
<!--Delete Vehicle Alertf-->
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
<div class="popup" id="CancelActiveTripPopup">
    <!-- Confirm alert content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="CancelActiveTrip_Close">&times;</span>
            <h3 id="cancel-alert-header">Cancel Trip</h3>
            <hr>
        </div>
        <div class="popup-body">
            <input class="inputs" type="hidden" name="Status" value="Completed" disabled>
            <p id="cancel-alert-message">Are you sure you want to cancel the trip?</p>
            <input type="button" value="Yes" class="btn btn-danger" id="CancelActiveTrip_Confirm">
            <input type="button" value="No" class="btn btn-primary" id="CancelActiveTrip_Cancel">
        </div>
        <div class="popup-footer">
        </div>
    </div>
</div>
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
            <img src="../images/default-user-image.png" class="form-image" id="ProfilePicturePath-DriverProfileForm">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form id="DriverProfile_form">
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>Driver ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="DriverID-DriverProfileForm" type="text" name="DriverID" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="DateOfAdmission-DriverProfileForm" type="date" name="DateOfAdmission" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="FirstName-DriverProfileForm" type="text" name="FirstName" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LastName-DriverProfileForm" type="text" name="LastName" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="AssignedVehicle-DriverProfileForm" type="text" name="AssignedVehicle" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="ContactNo-DriverProfileForm" type="text" name="ContactNo" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="Email-DriverProfileForm" type="text" name="Email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="form-group col-md-4">
                                <label>License ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LicenseNumber-DriverProfileForm" type="text" name="LicenseNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border " id="LicenseType-DriverProfileForm" type="text" name="LicenseType" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expirey Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" id="LicenseExpirationDay-DriverProfileForm" type="text" name="LicenseExpirationDay" disabled>
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
        <div class="popup-body" style="max-height: 80vh;" id="assignVehicleToDriverTable">
            <div class="row mx-auto">
                <label class="mr-2">Assign Vehicle:</label> <span>
                    <p id="AssignedVehicle-assignVehicleToDriverTable"></p>
                </span>
            </div>
            <div class="container-fluid search-container">
                <div class="row mt-3 pt-3 ml-3 border">
                    <div class="col-sm-6 mb-3">
                        <div class="input-group">
                            <div class="row w-100">
                                <div class="col-sm-6 pr-0 form-group position-relative">
                                    <input type="text" class="form-control pr-2" id="assignVehicleToDriverTable_SearchInput" placeholder="Search" style="border-radius: 0px!important;">
                                    <span class="form-clear searchTabButton d-none mr-2" id="Cancel_Confirm_button"><i class="material-icons">clear</i></span>

                                </div>
                                <div class="col-sm-3">
                                    <select class="custom-select mr-sm-2" data-field="Search" style="border-radius: 0px!important;">
                                        <option selected>Registration No</option>
                                        <option value="Value">Value</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="button" class="btn btn-primary searchTabButton" id="Search_Confirm_assignVehicleToDriverTable" value="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 ml-2">
                        <div class="row">
                            <div class="sm-8">
                                <div class="row">
                                    <div class="col-sm-2 my-auto mr-1">
                                        <label class="mr-2">Sort</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="custom-select mr-sm-2" data-field="Sort">
                                            <option selected>Registration No</option>
                                            <option value="Value">Value</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ml-2 my-auto">
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Desc_assignVehicleToDriverTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-down-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z" />
                                        <path fill-rule="evenodd" d="M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Asc_assignVehicleToDriverTable">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-up-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 14a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-1 0v10a.5.5 0 0 0 .5.5z" />
                                        <path fill-rule="evenodd" d="M5.354 5.854a.5.5 0 0 0 0-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L3 4.207l1.646 1.647a.5.5 0 0 0 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-y:scroll;overflow-x:hidden;height: 50%;">

                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark " style="position:relative; width:100%!important;">
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="th-sm" scope="col">Vehicle</th>
                            <th class="th-sm" scope="col">Allocated Trips</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    </tbody>
                </table>
            </div>
            <div class="row d-flex justify-content-center"><button class="btn w-100 btn-light load-more mb-3 mr-5 ml-5" id="assignVehicleToDriverTable_LoadMore">Load More</button></div>
        </div>

        <div class="popup-footer">
            <hr style="margin-bottom: 0.5rem;">
            <input type="button" value="Go Back" class="btn btn-primary" style="margin-right:10px " id="AssignVehicleToDriver_Goback">
            <span class="d-inline-block" id="select-vehicle-tooltip" data-toggle="tooltip" title="Select a vehicle to enable"><input type="button" value="Confirm" class="btn btn-success" id="AssignVehicleToDriver_Confirm"></span>

        </div>
    </div>
</div>

<!--Assigned Request selection-->
<div class="popup" id="AssignedRequestToDriverPopup">
    <!-- My profile content -->
    <div class="popup-content">

        <div class="popup-header row mb-4">
            <div class="col-10">
                <h2>Assigned Request</h2>
            </div>
            <div class="col-2">
                <button class="btn btn-light py-1 px-3" style="float:right;font-size:1.5rem" onclick="document.getElementById('AssignedRequestToDriverPopup').style.display = 'none';">&times;</button>
            </div>
            <hr>
        </div>
        <div class="popup-body" id="assignedRequestToDriverContainer">
            <div style="overflow-y:auto;overflow-x:hidden;height: 50%;">
                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark" style="width:100%!important">
                        <tr>
                            <th class="th-sm" scope="col">Date</th>
                            <th class="th-sm" scope="col">Time</th>
                            <th class="th-sm" scope="col">Pickup</th>
                            <th class="th-sm" scope="col">Dropoff</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row d-flex justify-content-center d-none"><button class="btn w-100 btn-light load-more mb-3 mr-5 ml-5" id="assignedRequestToDriverContainer_LoadMore">Load More</button></div> -->
        <div class="popup-footer">
            <hr style="margin-bottom: 0.5rem;">
        </div>
    </div>
</div>
<div class="popup" id="AssignedRequestToVehiclePopup">
    <!-- My profile content -->
    <div class="popup-content">
        <div class="popup-header row mb-4">
            <div class="col-10">
                <h2>Assigned Request</h2>
            </div>
            <div class="col-2">
                <button class="btn btn-light py-1 px-3" style="float:right;font-size:1.5rem" onclick="document.getElementById('AssignedRequestToVehiclePopup').style.display = 'none';">&times;</button>
            </div>
            <hr>
        </div>
        <div class="popup-body" id="assignedRequestToVehicleContainer">
            <div style="overflow-y:auto;overflow-x:hidden;height: 50%;">
                <table class="table table-hover" style="width:100%">
                    <thead class="thead-dark" style="width:100%!important">
                        <tr>
                            <th class="th-sm" scope="col">Date</th>
                            <th class="th-sm" scope="col">Time</th>
                            <th class="th-sm" scope="col">Pickup</th>
                            <th class="th-sm" scope="col">Dropoff</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row d-flex justify-content-center d-none"><button class="btn w-100 btn-light load-more mb-3 mr-5 ml-5" id="assignedRequestToVehicleContainer_LoadMore">Load More</button></div> -->

        <div class="popup-footer">
            <hr style="margin-bottom: 0.5rem;">
        </div>
    </div>
</div>