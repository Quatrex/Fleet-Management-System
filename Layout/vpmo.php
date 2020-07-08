<?php

use Employee\VPMO;

session_start();
if (!isset($_SESSION['empid'])) die('ACCESS DENIED');
require_once '../includes/autoloader.inc.php';
$vpmo = VPMO::getObject($_SESSION['empid']);
$_SESSION['vpmo'] = $vpmo;
$requests = $vpmo->getMyRequestsByState('pending');
$_SESSION['pendingTrips'] = $requests;
$vehicles = $vpmo->getVehicles();
//$requestsToAssign = //code to get the requestsToAssign
//$_SESSION['requestsToAssign'] = $requestsToAssign;
//$vehicles = //code to get all the vehicles;
$_SESSION['vehicles'] = $vehicles;

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
                                                <thead class="thead-dark">
                                                    <tr data-toggle="popup" id="header-table" data-id="my-profile" data-target="#my-profile">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Request Id</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

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
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($trips as $trip) : ?>
                                                        <tr id="ongoingTable_<?php echo $request->getField('requestID') ?>">
                                                            <th id="trip-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                            <td><?php echo $request->getField('purpose') ?></td>
                                                            <td>Scheduled</td>
                                                            <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                            <td><?php echo $request->getField('timeOfTrip') ?></td>
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
        const pendingRequests = <?php echo json_encode(($_SESSION['pendingTrips'])) ?>;
        const vehicles = <?php echo json_encode(($_SESSION['vehicles'])) ?>;
        console.log(vehicles);

        //sessionStorage.setItem('requestsToApprove', requestsToApprove);
        sessionStorage.setItem('requestsByMe', pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>

</body>

</html>