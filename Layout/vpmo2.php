<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\HTMLBuilder;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'vpmo') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$uiBuilder = HTMLBuilder::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved']);
$ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = $employee->getRequests('completed');
$vehicles = $employee->getVehicles();
$requestsToAssign = $employee->getRequests('approved');
$drivers = $employee->getDrivers();
$scheduledRequests = $employee->getRequests('scheduled');
$_SESSION['employee'] = $employee;
$_SESSION['requestsByMe'] = $requestsByMe;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
$_SESSION['requestsToAssign'] = $requestsToAssign;
$_SESSION['vehicles'] = $vehicles;
$_SESSION['drivers'] = $drivers;
$_SESSION['scheduledRequests'] = $scheduledRequests;
?>
<html>
<?php include '../partials/head.php'; ?>

<body>
    <?php
    $uiBuilder
        ->createMainNavBar(['My Requests', 'Awaiting Requests', 'Database'])
        ->createSecondaryNavBar(['Pending Requests', 'Ongoing Requests', 'History'])
        ->myRequests($requestsByMe, 'Pending', 'Your Pending Requests')
        ->myRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests')
        ->myRequests($pastRequests, 'Past', 'History')
        ->buildSecTabBody(['PendingRequests', 'OngoingRequests', 'History'])
        ->createSecondaryNavBar(['Assign Requests', 'Ongoing Trips', 'Scheduled History'])
        ->awaitingRequests($requestsToAssign, 'Assign', 'Assign Requests')
        ->awaitingRequests($scheduledRequests, 'Ongoing', 'Ongoing Trips')
        ->awaitingRequests($pastRequests, 'Scheduled', 'Scheduled History')
        ->buildSecTabBody(['AssignRequests', 'OngoingTrips', 'ScheduledHistory'])
        ->createSecondaryNavBar(['Vehicles', 'Drivers'])
        ->vehicles($vehicles)
        ->drivers($drivers)
        ->buildSecTabBody(['Vehicles', 'Drivers'])
        ->createMainNavHierachy(['MyRequests', 'AwaitingRequests', 'Database'])
        ->show();
    ?>


    <?php include '../partials/footer.php'; ?>
    <?php
    include '../partials/popups/vpmo_popup.php';
    include '../partials/popups/common.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const vehicles = <?php echo json_encode(($_SESSION['vehicles'])) ?>;
        const drivers = <?php echo json_encode(($_SESSION['drivers'])) ?>;
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
        const requestsToAssign = <?php echo json_encode(($_SESSION['requestsToAssign'])) ?>;
        const scheduledRequests = <?php echo json_encode(($_SESSION['scheduledRequests'])) ?>;
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>

</body>

</html>