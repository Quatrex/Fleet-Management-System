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
$_SESSION['employee'] = $employee;
$requestsToApprove = $employee->getJustifiedRequests();
$_SESSION['requestsToApprove'] = $requestsToApprove;

$requestsByMe = $employee->getMyRequests('pending');
$_SESSION['requestsByMe'] = $requestsByMe;
?>

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
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Approve Requests</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Request Vehicle</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <h4>Pending Requests to Approve</h4>
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
                                                            <th id="requestraw-<?php echo $i ?>"><?php echo $request->getField('requestID') ?></td>
                                                            <td><?php echo ($request->getField('requester'))->getField('firstName').' '.($request->getField('requester'))->getField('lastName') ?></td>
                                                            <td><?php echo $request->getField('purpose') ?></td>
                                                            <td><?php echo $request->getField('dateOfTrip') ?></td>
                                                            <td><?php echo $request->getField('timeOfTrip') ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4>Your Pending Requests</h4>
                                            <table class="table table-hover" id="requestTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th class="request-id" scope="col"></th>
                                                        <th scope="col">Purpose</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
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
    include '../partials/popups/common.php';
    include '../partials/popups/cao_popup.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const pendingRequests = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToApprove'])) ?>;
        sessionStorage.setItem('requestsToApprove', requestsToApprove);
        sessionStorage.setItem('requestsByMe', pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>

</body>

</html>