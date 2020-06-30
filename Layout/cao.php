<html>
<?php include '../partials/head.php';

use Employee\CAO;

session_start();
if (!isset($_SESSION['empid'])) die('ACCESS DENIED');
require_once '../includes/autoloader.inc.php';
$cao = CAO::getObject($_SESSION['empid']);
$_SESSION['employee'] = $cao;
$requestsToApprove = $cao->getJustifiedRequests();
$_SESSION['requestsToApprove'] = $requestsToApprove;

$requestsByMe = $cao->getMyRequestsByState('pending');
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
                                            <table class="table table-hover" id="approve-request-table">
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
                                                    foreach ($requestsToApprove as $request) : ?>
                                                        <tr id="request-raw<?php echo $i ?>">
                                                            <th id="request-<?php echo $i ?>"><?php echo $request->requestID ?></td>
                                                            <td><?php echo $request->requesterID ?></td>
                                                            <td><?php echo $request->purpose ?></td>
                                                            <td><?php echo $request->dateOfTrip ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4>Your Pending Requests</h4>
                                            <table class="table table-hover" id="request-table">
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
                                                        <tr>
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
        const pendingRequests = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToJustify'])) ?>;
        sessionStorage.setItem('requestsToApprove',requestsToApprove);
        sessionStorage.setItem('requestsByMe',pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>

</body>

</html>