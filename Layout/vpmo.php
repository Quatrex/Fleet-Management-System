<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'vpmo') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requests = $employee->getMyRequestsByState('pending');
$vehicles = $employee->getVehicles();
$requestsToAssign = $employee->getApprovedRequests();
$drivers = $employee->getDrivers();
$scheduledRequests = $employee->getScheduledRequests();
$_SESSION['employee'] = $employee;
$_SESSION['pendingTrips'] = $requests;
$_SESSION['requestsToAssign'] = $requestsToAssign;
$_SESSION['vehicles'] = $vehicles;
$_SESSION['drivers'] = $drivers;
$_SESSION['scheduledRequests'] = $scheduledRequests;
?>
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
                                    <ul class="nav nav-tabs mb-3" role="tablist" id="tabs-to-show">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Assign</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Request</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vehicleManagement">Vehicles</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tripEnd">Trips</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <h4 class="card-name">Assign a Vehicle</h4>
                                            <table class="table table-hover" id="approveRequestTable">
                                                </tbody>
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th class="request-id" scope="col"></th>
                                                        <th scope="col">Requester Name</th>
                                                        <th scope="col">Purpose</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- TODO: have to change requester id to name -->
                                                    <?php
                                                    $i = 0;
                                                    foreach ($requestsToAssign as $request) : ?>
                                                        <tr id="approveRequestTable_<?php echo $request->getField('requestID') ?>">
                                                            <th id="requestraw-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                            <td><?php echo ($request->getField('requester'))->getField('firstName').' '.($request->getField('requester'))->getField('lastName') ?></td>
                                                            <td><?php echo $request->getField('purpose') ?></td>
                                                            <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4 class="card-name">Your Pending Requests</h4>
                                            <table class="table table-hover" id="requestTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Purpose</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($requests as $request) : ?>
                                                        <tr id="requestTable_<?php echo $request->getField('requestID') ?>">
                                                            <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                            <td><?php echo $request->getField('purpose') ?></td>
                                                            <td>Pending</td>
                                                            <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                            <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="vehicleManagement" role="tabpanel">
                                            <input type="button" value="Add Vehicle" class="btn btn-primary" id="add-vehicle-button">
                                            <h4 class="card-name">Vehicles</h4>
                                            <table class="table table-hover" id="VehicleTable">
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

                                        <div class="tab-pane fade" id="tripEnd" role="tabpanel">
                                            <h4 class="card-name">Ongoing Trips</h4>
                                            <table class="table table-hover" id="ongoingTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Requester</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($scheduledRequests as $scheduledRequest) : ?>
                                                        <tr id="ongoingTable_<?php echo $scheduledRequest->getField('requestID') ?>">
                                                            <th id="trip-<?php echo $i ?>"><?php echo $scheduledRequest->getField('requestID') ?></td>
                                                            <td><?php echo ($scheduledRequest->getField('requester'))->getField('firstName').' '.($scheduledRequest->getField('requester'))->getField('lastName') ?></td>
                                                            <td><?php echo $scheduledRequest->getField('dateOfTrip') ?></td>
                                                            <td><?php echo $scheduledRequest->getField('timeOfTrip') ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
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
    include '../partials/popups/vpmo_popup.php';
    include '../partials/popups/common.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const requestsByMe = <?php echo json_encode(($_SESSION['pendingTrips'])) ?>;
        const vehicles = <?php echo json_encode(($_SESSION['vehicles'])) ?>;
        const requestsToAssign = <?php echo json_encode(($_SESSION['requestsToAssign'])) ?>;
        //sessionStorage.setItem('requestsToApprove', requestsToApprove);
        console.log(requestsToAssign);
        
        sessionStorage.setItem('requestsByMe', requestsByMe);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>

</body>

</html>