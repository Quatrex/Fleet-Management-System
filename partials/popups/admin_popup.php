<!--Popups- driver add form-->
<!--Popups- employee add form-->
<div class="popup" id="employee-add-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="employee-add-form-close">&times;</span>
            <h2>Add Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="contact" action="" method="post">
                    <fieldset>
                        <input placeholder="Employee Name" type="text" tabindex="1" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Position">
                    </fieldset>
                    <fieldset>
                        <input type="number" placeholder="Contact Number">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Address" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Email" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Password" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Confirm Password" type="text" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" class="btn-success" id="employee-add-form-confirm" data-submit="...Sending">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Popups- driver add form-->
<div class="popup" id="driver-add-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="driver-add-form-close">&times;</span>
            <h2>Add Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <div id="submit-form-wrapper">
                <form id="contact" action="" method="post">
                    <fieldset>
                        <input placeholder="Name" type="text" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Address" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Email" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input type="number" placeholder="Contact Number">
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Employed Date">
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Licence ID">
                    </fieldset>

                    <fieldset>
                        <input placeholder="Licence Type" type="text" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Licence Expire Date" type="text" required>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" class="btn-success" id="driver-add-form-confirm" data-submit="...Sending">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Ongoing Table Row click Preview-->
<div class="popup" id="ongoing-details-popup">
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

<!--Employee Form-->
<div class="popup" id="employee-profile-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="employee-profile-form-close">&times;</span>
            <h2>Employee</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
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
                                <label>Email</label>
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


                        <button type="submit" class="btn btn-dark" id="employee-profile-confirm">Confirm</button>
                    </form>
                </div>


            </div>
        </div>
    </div>

</div>

<!--Driver add Form-->
<div class="popup" id="driver-profile-form">
    <!-- Request Form content -->
    <div class="popup-content">
        <div class="popup-header">
            <span class="close" id="driver-profile-form-close">&times;</span>
            <h2>Driver</h2>
            <hr>
        </div>
        <div class="popup-body">
            <img src="../../images/default-user-image.png" class="form-image">
            <div id="submit-form-wrapper">
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
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
                                <label>Email</label>
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
                            <div class="form-group col-md-4">
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
                            <div class="form-group col-md-4">
                                <label>Employed Date</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" id="example-search-input" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Assigned Vehicle</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" id="example-search-input" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Licennce ID</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Contacts Number" id="example-search-input" disabled>
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                            <i class="icon far fa-edit"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Licence Type</label>
                                <div class="input-group">
                                    <input class="form-control py-2 border-right-0 border" type="text" value="Position" id="example-search-input" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Licence Expiry Date</label>
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


                        <button type="submit" class="btn btn-dark" id="driver-profile-confirm">Confirm</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>