<?php
session_start();
require 'func/data.php';
include 'partials/header.php';
$_SESSION['pendingTrips'] = getPendingTrips();
$_SESSION['json'] = json_encode($_SESSION['pendingTrips']);
$_SESSION['user'] = json_encode(getUser());



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
                                                <th class="request-id" scope="col">#</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i =0;
                                            foreach ($_SESSION['pendingTrips'] as $trips) : ?>
                                                <tr>
                                                    <th id ="request-<?php echo $i?>"><?php echo $trips['id'] ?></td>
                                                    <td><?php echo $trips['status'] ?></td>
                                                    <td><?php echo $trips['date'] ?></td>
                                                    <td><?php echo $trips['time'] ?></td>
                                                </tr>
                                            <?php $i++;
                                            endforeach;; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="contact">
                                    <?php include 'partials/contact.php'
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
include 'partials/popup.php';
include 'partials/footer.php';
?>