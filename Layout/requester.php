<?php
use Employee\Requester;

session_start();
if (!isset($_SESSION['empid'])) die('ACCESS DENIED');
include '../partials/header.php';
require_once '../includes/autoloader.inc.php';
$status = 1;
$requester = Requester::getObject($_SESSION['empid']); //, $_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['position'],$_SESSION['email'],$_SESSION['username'],"agfd");
$_SESSION['requester'] = $requester;
$requests = $requester->getMyPendingRequests();
// echo json_encode($requests);
$_SESSION['pendingTrips'] = $requests;
$_SESSION['json'] = json_encode($_SESSION['pendingTrips']);



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
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Requests</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home" role="tabpanel">
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
                                                    <td><?php echo $request->dateOfTrip ?></td>
                                                    <td><?php echo $request->timeOfTrip ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="contact">
                                    <?php include '../partials/contact.php'
                                    ?>
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