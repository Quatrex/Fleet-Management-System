<html>
<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'cao') {
    header("Location: login.php");
    exit();
}
include '../partials/head.php';
require_once '../includes/autoloader.inc.php';
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved']);
$ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$requestsToApprove = $employee->getJustifiedRequests();
$approvedRequests = $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed']);
$_SESSION['employee'] = $employee;
$_SESSION['requestsByMe'] = $requestsByMe;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
$_SESSION['requestsToApprove'] = $requestsToApprove;
$_SESSION['approvedRequests'] = $approvedRequests;
?>

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
    <div class="tab-content">

        <!-- My Requests Tab-->
        <div class="tab-pane fade active show" id="MyRequests" role="tabpanel">
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
                            <h3 class="card-header bg-dark text-white">Your Pending Requests</h3>
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
                                                <tr id="requestTable_<?php echo $request->getField('requestID') ?>">
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
                                                <tr id="requestTable_<?php echo $request->getField('requestID') ?>">
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
                                                <tr id="requestTable_<?php echo $request->getField('requestID') ?>">
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
        <div class="tab-pane fade" id="AwaitingRequests" role="tabpanel">

            <!--Secondary Nav Bar-->
            <div class="secondary-nav-bar">
                <nav class="pt-3 mb-3">
                    <div class="nav nav-pills  justify-content-start ml-5">
                        <a class="nav-item nav-link active hvrcenter" data-toggle="tab" href="#approveRequests">Justify Requests</a>
                        <a class="nav-item nav-link hvrcenter" data-toggle="tab" href="#approvedHistory">History</a>
                    </div>
                </nav>
            </div>
            <!--Secondary Nav Bar End-->

            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="approveRequests" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">Approve Requests</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="approveRequestTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Requester Name</th>
                                                <th scope="col">Purpose</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- TODO: have to change requester id to name -->
                                            <?php
                                            $i = 0;
                                            foreach ($requestsToApprove as $request) : ?>
                                                <tr id="approveRequestTable_<?php echo $request->getField('requestID') ?>">
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                    <td><?php echo ($request->getField('requester'))->getField('firstName') . ' ' . ($request->getField('requester'))->getField('lastName') ?></td>
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
                    <div class="tab-pane fade" id="approvedHistory" role="tabpanel">
                        <div class="card">
                            <h3 class="card-header bg-dark text-white">History</h3>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover" id="approvedHistoryTable">
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
                                            foreach ($approvedRequests as $request) : ?>
                                                <tr id="approvedHistoryTable<?php echo $request->getField('requestID') ?>">
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

    </div>
    <!--Main Nav Hierarchy End-->

    <?php include '../partials/footer.php'; ?>

    <?php
    include '../partials/popups/common.php';
    include '../partials/popups/cao_popup.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToApprove'])) ?>;
        const approvedRequests = <?php echo json_encode(($_SESSION['approvedRequests'])) ?>;

        sessionStorage.setItem('requestsToApprove', requestsToApprove);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>

</body>

</html>