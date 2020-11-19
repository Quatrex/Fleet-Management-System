<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\UI;
use UI\HTMLBodyComponent\MainNavBar;
use UI\HTMLBodyComponent\Psd;
use UI\HTMLBodyComponent\SecNavBar;
use UI\HTMLBodyComponent\MyRequests;
use UI\HTMLBodyComponent\AwaitingRequests;
use UI\HTMLBodyComponent\Vehicles;
use UI\HTMLBodyComponent\Drivers;
use UI\HTMLBodyComponent\SecTabBody;
use UI\HTMLBodyComponent\MainNavHierarchy;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'vpmo') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$ui = UI::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved'], 0);
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

<body id="page-top">
    <?php
    $ui->setContents([
        new MainNavBar($employee, ['My Requests', 'Awaiting Requests', 'Database']),
        new Psd(['My Requests' => ['Pending Requests', 'Ongoing Requests', 'History'], 'Awaiting Requests' => ['Assign Requests', 'Ongoing Trips', 'Scheduled History'], 'Database' => ['Vehicles', 'Drivers']]),
        new MainNavHierarchy(
            ['MyRequests', 'AwaitingRequests', 'Database'],
            [
                new SecNavBar('MyRequestsSecTab', ['Pending Requests', 'Ongoing Requests', 'History']),
                new SecNavBar('AwaitingRequestsSecTab', ['Assign Requests', 'Ongoing Trips', 'Scheduled History']),
                new SecNavBar('DatabaseSecTab', ['Vehicles', 'Drivers'])
            ],
            [
                new SecTabBody(
                    ['PendingRequests', 'OngoingRequests', 'History'],
                    [
                        new MyRequests($requestsByMe, 'Pending', 'Pending Requests'),
                        new MyRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests'),
                        new MyRequests($pastRequests, 'Past', 'Past Requests')
                    ]
                ),
                new SecTabBody(
                    ['AssignRequests', 'OngoingTrips', 'ScheduledHistory'],
                    [
                        new AwaitingRequests($requestsToAssign, 'Assign', 'Assign Requests'),
                        new AwaitingRequests($scheduledRequests, 'Ongoing', 'Ongoing Trips'),
                        new AwaitingRequests($scheduledHistoryRequests, 'Scheduled', 'Scheduled History')
                    ]
                ),
                new SecTabBody(
                    ['Vehicles', 'Drivers'],
                    [
                        new Vehicles($vehicles),
                        new Drivers($drivers)
                    ]
                )
            ]
        )
    ]);
    $ui->create();
    $ui->show();
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