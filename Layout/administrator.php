<html>
<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'admin') {
    header("Location: login.php");
    exit();
}
include '../partials/head.php';
require_once '../includes/autoloader.inc.php';
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$_SESSION['employee'] = $employee;
$employees = $employee->getAllPriviledgedEmployees();
$_SESSION['employees'] = $employees;
$drivers = $employee->getAllDrivers();
$_SESSION['drivers'] = $drivers;
?>

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
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#requests">Request</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#employees">Employee</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drivers">Driver</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="requests" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4>Your Pending Requests</h4>
                                            <table class="table table-hover" id="requestTable">
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
                                        <div class="tab-pane fade" id="employees" role="tabpanel">
                                            <input type="button" value="Add Employee" class="btn btn-primary" id="add-employee-button">
                                            <h4>Employees</h4>
                                            <table id="employeeTable" class="table table-hover table-bordered" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($employees as $employee) : ?>
                                                        <tr id="employeeTable_<?php echo $employee->getField('empID') ?>">
                                                            <th id="employee-<?php echo $i ?>"><?php echo $employee->getField('empID') ?></td>
                                                            <td><?php echo $employee->getField('firstName') . ' ' . $employee->getField('lastName') ?></td>
                                                            <td><?php echo $employee->getField('position') ?></td>
                                                            <td><?php echo $employee->getField('email') ?></td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach;; ?>
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="drivers" role="tabpanel">
                                            <input type="button" value="Add Driver" class="btn btn-primary" id="add-driver-button">
                                            <h4>Drivers</h4>
                                            <table id="driverTable" class="table table-hover table-bordered" style="width:100%">
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
    include '../partials/popups/admin_popup.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const employees = <?php echo json_encode(($_SESSION['employees'])) ?>;
        const drivers = <?php echo json_encode(($_SESSION['drivers'])) ?>;
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/admin.js"></script>

</body>

</html>