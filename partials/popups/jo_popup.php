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
                        <input type="text" class="form-control inputs" id="JOSelectedVehicle-JustifyRequestAlertPopup" name="JOSelectedVehicle" placeholder="Select Vehicle (Optional)" disabled>
                        <div class="input-group-append">
                            <input type="button" class="btn btn-outline-secondary" id="JustifyRequestAlert_SelectVehicle" value="Choose">
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
            <div class="popup-body" style="max-height: 80vh;" id="selectionVehicleTable">
                <div class="row mx-auto">
                    <label class="mr-2">Selected Vehicle:</label> <span>
                        <p id="JOSelectedVehicle-selectionVehicleTable"></p>
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
                                        <input type="button" class="btn btn-primary searchTabButton" id="Search_Confirm_" value="Search">
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
                                    <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Desc_">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-sort-down-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z" />
                                            <path fill-rule="evenodd" d="M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn btn-outline-dark searchTabButton" id="Asc_">
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
                <div>
                    <table class="table table-hover" style="width:100%">
                        <thead class="thead-dark " style="position:relative; width:100%!important;">
                            <tr>
                                <th class="" scope="col">#</th>
                                <th class="th-sm" scope="col">Vehicle</th>
                                <th class="th-sm" scope="col">Assigned Driver</th>
                                <th class="th-sm" scope="col">Passengers</th>
                            </tr>
                        </thead>
                        <tbody id="selectionVehicleTable" class="card-body">
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