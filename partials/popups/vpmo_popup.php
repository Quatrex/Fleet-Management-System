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
                    <form id="new-vehicle-form">
                        <input class="form-control my-3" placeholder="Vehicle model" type="text"  name="model" >
                        <input class="form-control my-3" placeholder="Registration Number" type="text"  name="registrationNo" >
                        <input type="date" name="purchasedYear" class="form-control my-3" placeholder="Date of purchase" >
                        <input name="value" class="form-control my-3" placeholder="Price" type="number" >
                        <input name="fuelType" class="form-control my-3" placeholder="Fuel type" type="text" >
                        <input name="currentLocation" class="form-control my-3" placeholder="Current Location" type="text" >
                        <h4>Insurance details</h4>
                        <input name="insuranceValue" class="form-control my-3" placeholder="Monthly installment" type="number" >
                        <input name="insuranceCompany" class="form-control my-3" placeholder="Insurance company" type="text" >
                        <h4>Leasing details (Fill in for a leased vehicle)</h4>
                        <input name="leasingCompany" class="form-control my-3" placeholder="Leasing company" type="text" >
                        <input type="date" name="leasePeriod" class="form-control my-3" placeholder="Lease period (from)" >
                        <input type="date" name="" class="form-control my-3" placeholder="Lease period (to)">
                        <input name="monthlyInstallment" class="form-control my-3" placeholder="Monthly installment" type="number" >
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
                        <label>Show<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                class="form-control form-control-sm"
                                style=" margin-left: 10px;display:inline-block; border: 0 none; width:auto !important">
                                <option value="10">All Vehicles</option>
                                <option value="25">Allocated Vehicles</option>
                                <option value="50">Free Vehicles</option>
                            </select></label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label style="margin: 10px 0px; padding-top: 2px;">Selected:<label id="vehicle-name"
                                    style="padding-left:10px"></label></label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm"
                                    style="display:inline-block; margin-left: 15px; margin-bottom:0.5rem; width:auto!important"
                                    placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <div style="height:300px; overflow:auto;">
                    <table class="table table-hover w-auto" style="overflow-y: scroll;" id="vehicle-table">
                        <thead class="thead-dark " style="position:relative">
                            <tr data-toggle="popup" data-id="my-profile" data-target="#my-profile">
                                <th class="" scope="col">#</th>
                                <th class="th-sm" scope="col">Vehicle</th>
                                <th class="th-sm" scope="col">Assigned Driver</th>
                                <th class="th-sm" scope="col">Passengers</th>
                                <th class="th-sm" scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td><i class="fa fa-info" aria-hidden="true"></i></td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Correct</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                                <td>18.10</td>
                            </tr>

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
                        <label>Show<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                class="form-control form-control-sm"
                                style=" margin-left: 10px;display:inline-block; border: 0 none; width:auto !important">
                                <option value="10">All drivers</option>
                                <option value="25">Allocated drivers</option>
                                <option value="50">Free drivers</option>
                            </select></label>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label style="margin: 10px 0px; padding-top: 2px;">Selected:<label id="driver-name"
                                    style="padding-left:10px"></label></label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="DataTables_Table_0_filter" style="display: inline-block;" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm"
                                    style="display:inline-block; margin-left: 15px; margin-bottom:0.5rem; width:auto!important"
                                    placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>
                <div style="height:300px; overflow:auto;">
                    <table class="table table-hover w-auto" style="overflow-y: scroll;" id="driver-table">
                        <thead class="thead-dark " style="position:relative">
                            <tr data-toggle="popup" data-id="my-profile" data-target="#my-profile">
                                <th class="" scope="col">#</th>
                                <th class="th-sm" scope="col">Driver</th>
                                <th class="th-sm" scope="col">Location</th>
                                <th class="th-sm" scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>

                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>

                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>

                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>

                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>
                            <tr data-pop="1">
                                <th scope="row">1</th>
                                <td>Pending</td>
                                <td>2020/04/10</td>
                                <td>18.10</td>
                            </tr>

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
                        <p>Driver</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="final-driver">Text</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Vehicle</p>
                    </div>
                    <div class="col-sm-6">
                        <p id="final-vehicle">Text</p>
                    </div>
                </div>
            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>

    <!--Employee Form-->
    <div class="popup" id="car-profile-form">
        <!-- Request Form content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="car-profile-form-close">&times;</span>
                <h2>Vehicle</h2>
                <hr>
            </div>
            <div class="popup-body">
                <img src="../images/default-user-image.png" class="form-image">
                <div id="submit-form-wrapper">
                    <div class="basic-form">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Model</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" type="text" value="Name" id="example-search-input" disabled>
                                        <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                    </div>

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Registration Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" type="text" value="email@email.com" id="example-search-input" disabled>
                                        <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Address" id="example-search-input" disabled>
                                    <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                        <i class="icon far fa-edit"></i>
                                    </button>
                                </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Name" id="example-search-input" disabled>
                                    <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                        <i class="icon far fa-edit"></i>
                                    </button>
                                </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Contact Number</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" type="text" value="Contacts Number" id="example-search-input" disabled>
                                        <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Position</label>
                                    <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" type="text" value="Position" id="example-search-input" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a href="">Change password</a>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-dark" id="confirm-vehicle-profile">Confirm</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </div>

