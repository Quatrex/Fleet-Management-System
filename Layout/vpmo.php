<?php

use Employee\VPMO;

session_start();
if (!isset($_SESSION['empid'])) die('ACCESS DENIED');
require_once '../includes/autoloader.inc.php';
$status = 1;
$vpmo = VPMO::getObject($_SESSION['empid']); //, $_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['position'],$_SESSION['email'],$_SESSION['username'],"agfd");
$_SESSION['vpmo'] = $vpmo;
$requests = $vpmo->getMyRequestsByState('pending');
// echo json_encode($requests);
$_SESSION['pendingTrips'] = $requests;
$_SESSION['requestsToAssign'] = "Nothing";
$_SESSION['json'] = json_encode($_SESSION['pendingTrips']);
// echo $_SESSION['empid'];


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
                                            <table class="table table-hover" id="approve-request-table">
                                                <thead class="thead-dark">
                                                    <tr data-toggle="popup" id="header-table" data-id="my-profile" data-target="#my-profile">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Request Id</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-pop="1">
                                                        <th scope="row">1</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>18.10</td>
                                                    </tr>

                                                    <tr data-pop="2">
                                                        <th scope="row">2</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>08.10</td>
                                                    </tr>
                                                    <tr data-pop="3">
                                                        <th scope="row">3</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>13.10</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">

                                            <h4 class="card-name">Your Pending Requests</h4>
                                            <table class="table table-hover" id="request-table">
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
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="vehicleManagement" role="tabpanel">
                                            <input type="button" value="Add Vehicle" class="btn btn-primary" id="add-vehicle-button">
                                            <h4 class="card-name">Vehicles</h4>
                                            <table class="table table-hover" id="all-vehicle-table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Model</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Driver</th>
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

                                        <div class="tab-pane fade" id="tripEnd" role="tabpanel">
                                            <h4 class="card-name">Ongoing Trips</h4>
                                            <table class="table table-hover" id="ongoing-table">
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
    include '../partials/popups/vpmo_popup.php';
    include '../partials/popups/common.php';
    ?>
    <script>
        const pendingRequests = <?php echo json_encode(($_SESSION['pendingTrips'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToAssign'])) ?>;
        sessionStorage.setItem('requestsToApprove', requestsToApprove);
        sessionStorage.setItem('requestsByMe', pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>

</body>

</html>