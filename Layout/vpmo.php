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
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved'],0);
// $ongoingRequests = $employee->getMyRequests(['scheduled']);
$ongoingRequests = [];
// $pastRequests = $employee->getRequests('completed');
$pastRequests = [];
// $vehicles = $employee->getVehicles();
$vehicles = [];
// $requestsToAssign = $employee->getRequests('approved');
$requestsToAssign = [];
// $drivers = $employee->getDrivers();
$drivers = [];
// $scheduledRequests = $employee->getRequests('scheduled');
$scheduledRequests = [];
// $scheduledHistoryRequests = $employee->getRequests('completed');
$scheduledHistoryRequests = [];
// array_merge($scheduledHistoryRe  quests,$employee->getRequests('cancelled'));
// print_r($scheduledHistoryRequests);
$_SESSION['employee'] = $employee;
?>
<html>
<?php include '../partials/head.php'; ?>

<body>
    <?php
    $uiBuilder
        ->createMainNavBar($employee,['My Requests', 'Awaiting Requests', 'Database'])
        ->createSecondaryNavBar('MyRequestsSecTab',['Pending Requests', 'Ongoing Requests', 'History'])
        ->myRequests($requestsByMe, 'Pending', 'Pending Requests')
        ->myRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests')
        ->myRequests($pastRequests, 'Past', 'History')
        ->buildSecTabBody(['PendingRequests', 'OngoingRequests', 'History'])
        ->createSecondaryNavBar('AwaitingRequestsSecTab',['Assign Requests', 'Ongoing Trips', 'Scheduled History'])
        ->awaitingRequests($requestsToAssign, 'Assign', 'Assign Requests')
        ->awaitingRequests($scheduledRequests, 'Ongoing', 'Ongoing Trips')
        ->awaitingRequests($scheduledHistoryRequests, 'Scheduled', 'Scheduled History')
        ->buildSecTabBody(['AssignRequests', 'OngoingTrips', 'ScheduledHistory'])
        ->createSecondaryNavBar('DatabaseSecTab',['Vehicles', 'Drivers'])
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
    include '../partials/popups/template.php';
    ?>
    <script>
        const vehicles = <?php echo json_encode($vehicles) ?>;
        const drivers = <?php echo json_encode($drivers) ?>;
        const requestsByMe = <?php echo json_encode($requestsByMe) ?>;
        const ongoingRequests = <?php echo json_encode($ongoingRequests) ?>;
        const pastRequests = <?php echo json_encode($pastRequests) ?>;
        const requestsToAssign = <?php echo json_encode($requestsToAssign) ?>;
        const scheduledRequests = <?php echo json_encode($scheduledRequests) ?>;
        const scheduledHistoryRequests = <?php echo json_encode($scheduledHistoryRequests) ?>;
    </script>
    <script src="../js/redux.js"></script>
    <script src="../js/classes.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/vpmo.js"></script>
    <script src="../js/functions.js"></script>

</body>

</html>