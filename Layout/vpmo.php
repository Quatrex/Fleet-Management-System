<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'vpmo') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved']);
$ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$vehicles = $employee->getVehicles();
$requestsToAssign = $employee->getRequests('approved');
$drivers = $employee->getDrivers();
$scheduledRequests = $employee->getRequests('scheduled');
$_SESSION['employee'] = $employee;
$_SESSION['requestsByMe'] = $requestsByMe;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
$_SESSION['requestsToAssign'] = $requestsToAssign;
$_SESSION['vehicles'] = $vehicles;
$_SESSION['drivers'] = $drivers;
$_SESSION['scheduledRequests'] = $scheduledRequests;
?>
<html>
<?php include '../partials/head.php'; ?>

<body>
       <!-- Main Nav Bar -->
       <nav class="main-nav navbar navbar-expand-md navbar-dark py-0">
        <a class="navbar-brand mr-auto" href="#"><img src="../images/national-logo.png" class="logo img-fluid"></a>
        <button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse tab-info navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item hvrcenter active" data-toggle="MyRequests">
                    <a class="nav-link">My Requests</a>
                </li>
                <li class="nav-item hvrcenter mr-2" data-toggle="AwaitingRequests">
                    <a class="nav-link">Awaiting Requests</a>
                </li>
                <li class="nav-item hvrcenter mr-2" data-toggle="Database">
                    <a class="nav-link">Database</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../images/default-user-image.png" class="rounded-circle user-image mt-2" style="height:35px;"> </a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary profile-dropdown" aria-labelledby="navbarDropdownMenuLink-55" style="position:absolute">
                        <div class="user-dropdown dropdown-content">
                            <img src="../images/default-user-image.png">
                            <div class="container">
                                <p></p>
                                <p class="name-profile-dd">
                                </p>
                                <p class="name-profile-dd">
                                </p>
                                <p class="mail-profile-dd">
                                </p>
                                <p></p>
                                <button type="button" class="btn btn-light mx-auto my-2" id="edit-account-info-btn">Edit account info</button>
                            </div>
                        </div>
                        <div class="footer-profile">
                            <a type="button" class="btn btn-light" href="../func/logout.php">Sign out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Main Nav Bar End-->


    <!--Main Nav Hierarchy -->
    <div class="tab-content main-tab-pane" id="pills-tabContent">

        <!-- My Requests Tab-->
        <div class="main-tabs tab-pane fade active show" id="MyRequests" role="tabpanel">
            <!--Secondary Nav Bar-->
            <div class="secondary-nav-bar">
                <nav class="pt-3 mb-3">
                    <div class="nav nav-pills justify-content-start ml-5">
                        <a class="nav-item nav-link active hvrcenter" data-toggle="tab" href="#pendingRequests">Pending Requests</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#ongoingRequests">Ongoing Requests</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#history">History</a>
                    </div>
                </nav>
            </div>
            <!--Secondary Nav Bar End-->
            <div class="container-fluid">
                <input type="button" value="New Request" class="btn btn-primary rounded shadow p-3 mb-4" id="request-vehicle-button">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="pendingRequests" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header text-white" style="background-color:#1c313a;">Your Pending Requests</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="pendingRequestTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Pickup</th>
                                                <th scope="col">Dropoff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($requestsByMe as $request) : ?>
                                                <tr id="pendingRequestTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td>Pending</td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                    <td><?php echo $request->getField('pickLocation') ?></td>
                                                    <td><?php echo $request->getField('dropLocation') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ongoingRequests" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">Ongoing Requests</h3>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover" id="ongoingRequestTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Pickup</th>
                                                <th scope="col">Dropoff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($ongoingRequests as $request) : ?>
                                                <tr id="ongoingRequestTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td>Pending</td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                    <td><?php echo $request->getField('pickLocation') ?></td>
                                                    <td><?php echo $request->getField('dropLocation') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">History</h3>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover" id="requestHistoryTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Pickup</th>
                                                <th scope="col">Dropoff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($pastRequests as $request) : ?>
                                                <tr id="requestHistoryTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                    <td><?php echo $request->getField('pickLocation') ?></td>
                                                    <td><?php echo $request->getField('dropLocation') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--My Requests Tab End-->

        <!--Awaiting Requests Tab-->
        <div class="main-tabs tab-pane fade" id="AwaitingRequests" role="tabpanel">

            <!--Secondary Nav Bar-->
            <div class="secondary-nav-bar">
                <nav class="pt-3 mb-3">
                    <div class="nav nav-pills justify-content-start ml-5">
                        <a class="nav-item nav-link active hvrcenter" data-toggle="tab" href="#assignRequests">Assign Requests</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#ongoingTrips">Ongoing Trips</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#scheduledHistory">History</a>
                    </div>
                </nav>
            </div>
            <!--Secondary Nav Bar End-->

            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="assignRequests" role="tabpanel">
                        <div class="card mt-5">
                            <h3 class="card-header bg-dark text-white">Assign Requests</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="assignRequestTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Requester Name</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- TODO: have to change requester id to name -->
                                            <?php
                                            $i = 0;
                                            foreach ($requestsToAssign as $request) : ?>
                                                <tr id="assignRequestTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo ($request->getField('requester'))->getField('firstName') . ' ' . ($request->getField('requester'))->getField('lastName') ?></td>
                                                    <td><?php echo ($request->getField('requester'))->getField('position') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ongoingTrips" role="tabpanel">
                        <div class="card mt-5">
                            <h3 class="card-header bg-dark text-white">Ongoing Trips</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="ongoingTripTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Pickup</th>
                                                <th scope="col">Dropoff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($scheduledRequests as $request) : ?>
                                                <tr id="ongoingTripTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                    <td><?php echo $request->getField('pickLocation') ?></td>
                                                    <td><?php echo $request->getField('dropLocation') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="scheduledHistory" role="tabpanel">
                        <div class="card mt-5">
                            <h3 class="card-header bg-dark text-white">History</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="scheduledHistoryTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Pickup</th>
                                                <th scope="col">Dropoff</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($scheduledRequests as $request) : ?>
                                                <tr id="scheduledHistoryTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo $request->getField('purpose') ?></td>
                                                    <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                    <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                    <td><?php echo $request->getField('pickLocation') ?></td>
                                                    <td><?php echo $request->getField('dropLocation') ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--Awaiting Requests Tab End-->

        <!--Database Tab -->
        <div class="main-tabs tab-pane fade" id="Database" role="tabpanel">

            <div class="secondary-nav-bar">
                <nav class="pt-3 mb-3">
                    <div class="nav nav-pills justify-content-start ml-5">
                        <a class="nav-item nav-link active hvrcenter" data-toggle="tab" href="#vehicleTab">Vehicles</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#driverTab">Drivers</a>
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="vehicleTab" role="tabpanel">
                        <input type="button" value="Add Vehicle" class="btn btn-primary mb-4" id="add-vehicle-button">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">Vehicles</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="vehicleTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Model</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Driver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($vehicles as $vehicle) : ?>
                                                <tr id="vehicleTable_<?php echo $vehicle->getField('registrationNo') ?>">
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
                        </div>
                    </div>
                    <div class="tab-pane fade" id="driverTab" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">Drivers</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="driverTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Assigned Vehicle</th>
                                                <th>Contact Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($drivers as $driver) : ?>
                                                <tr id="driverTable_<?php echo $driver->getField('driverId') ?>">
                                                    <th id="driver-<?php echo $i ?>"><?php echo $driver->getField('driverId') ?></td>
                                                    <td><?php echo $driver->getField('firstName') . ' ' . $driver->getField('lastName') ?></td>
                                                    <td><?php echo $driver->getField('assignedVehicleId') ?></td>
                                                    <td><?php echo "Empty" ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Database Tab End-->

    </div>
    <!--Main Nav Hierarchy End-->

    <?php include '../partials/footer.php'; ?>
    <?php
    include '../partials/popups/vpmo_popup.php';
    include '../partials/popups/common.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const vehicles = <?php echo json_encode(($_SESSION['vehicles'])) ?>;
        const drivers = <?php echo json_encode(($_SESSION['drivers'])) ?>;
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
        const requestsToAssign = <?php echo json_encode(($_SESSION['requestsToAssign'])) ?>;
        const scheduledRequests = <?php echo json_encode(($_SESSION['scheduledRequests'])) ?>;

    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>

</body>

</html>