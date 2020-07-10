<html>
<?php include '../partials/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include '../partials/header.php'; ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fleet Mangement System</h4>
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#requests">Request</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#employees">Employee</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drivers">Driver</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#trip">Trip</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="requests" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4>Your Pending Requests</h4>
                                            <table class="table table-hover" id="requestTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>18.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>08.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>13.10</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="employees" role="tabpanel">
                                            <input type="button" value="Add Employee" class="btn btn-primary" id="add-employee-button">
                                            <h4>Employees</h4>
                                            <table id="employeeTable" class="table table-hover table-bordered" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="drivers" role="tabpanel">
                                            <input type="button" value="Add Driver" class="btn btn-primary" id="add-driver-button">
                                            <h4>Drivers</h4>
                                            <table id="allDriverTable" class="table table-hover table-bordered" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                       <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Donna Snider</td>
                                                        <td>Customer Support</td>
                                                        <td>New York</td>
                                                        <td>27</td>
                                                        <td>2011/01/25</td>
                                                        <td>$112,000</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="trip" role="tabpanel">
                                            <h4>Ongoing Trips</h4>
                                            <table class="table table-hover" id="ongoingTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>18.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>08.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>13.10</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="tab-pane fade" id="contact">
                                            <?php include '../partials/contact.php' ?>
                                        </div>
                                        <!--End of Contact-->>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../partials/footer.php'; ?>
    </div>
    <?php
    include '../partials/popups/common.php';
    include '../partials/popups/admin_popup.php';
    ?>
    <script>
        const pendingRequests = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToJustify'])) ?>;
        sessionStorage.setItem('requestsToApprove', requestsToApprove);
        sessionStorage.setItem('requestsByMe', pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>

</body>

</html>