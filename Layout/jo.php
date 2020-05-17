<?php
session_start();
include '../partials/header.php';
require_once '../includes/autoloader.inc.php';
$status = 1;
$requester = new Requester($_SESSION['empid'], $_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['position'], $_SESSION['email'], $_SESSION['username'], "agfd");
$requests = $requester->getPendingRequests($_SESSION['empid'], $status);
//echo json_encode($requests);
$_SESSION['pendingTrips'] = $requests;
$_SESSION['json'] = json_encode($_SESSION['pendingTrips']);
//get pending requests
//get requests to justify
//get cao denied requests
//get pending requests


?>
<!--**********************************
            Content body start
***********************************-->
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
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Justify Requests</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#denied">CAO Denied Requests</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Request Vehicle</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home" role="tabpanel">
                                <h4>Requests To Justify</h4>
                                    <table class="table table-hover" id="justify-request-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($requests as $request) : ?>
                                                <tr>
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->requestID ?></td>
                                                    <td>Pending</td>
                                                    <td><?php echo $request->date ?></td>
                                                    <td><?php echo $request->time ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>


                                </div>
                                <div class="tab-pane fade" id="denied">
                                    <h4>Requests Denied By CAO</h4>
                                    <table class="table table-hover" id="denied-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="request-id" scope="col"></th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($requests as $request) : ?>
                                                <tr>
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->requestID ?></td>
                                                    <td>Pending</td>
                                                    <td><?php echo $request->date ?></td>
                                                    <td><?php echo $request->time ?></td>
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
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($requests as $request) : ?>
                                                <tr>
                                                    <th id="request-<?php echo $i ?>"><?php echo $request->requestID ?></td>
                                                    <td>Pending</td>
                                                    <td><?php echo $request->date ?></td>
                                                    <td><?php echo $request->time ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="contact">
                                    <?php include '../partials/contact.php' ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../partials/popup.php';
include '../partials/footer.php';
?>

<!--**********************************
        Main wrapper end
 ***********************************-->