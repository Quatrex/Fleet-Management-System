<html>
<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\HTMLBuilder;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'cao') {
    header("Location: login.php");
    exit();
}
include '../partials/head.php';
require_once '../includes/autoloader.inc.php';
$uiBuilder = HTMLBuilder::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved']);
$ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$requestsToApprove = $employee->getJustifiedRequests();
$approvedRequests = $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed']);
$_SESSION['employee'] = $employee;
?>

<body>
    <?php
    $uiBuilder
        ->createMainNavBar($employee,['My Requests', 'Awaiting Requests'])
        ->createSecondaryNavBar(['Pending Requests', 'Ongoing Requests', 'History'])
        ->myRequests($requestsByMe, 'Pending', 'Your Pending Requests')
        ->myRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests')
        ->myRequests($pastRequests, 'Past', 'History')
        ->buildSecTabBody(['PendingRequests', 'OngoingRequests', 'History'])
        ->createSecondaryNavBar(['Approve Requests', 'Approved History'])
        ->awaitingRequests($requestsToApprove, 'Approve', 'Approve Requests')
        ->awaitingRequests($approvedRequests, 'Approved', 'Approved History')
        ->buildSecTabBody(['ApproveRequests', 'ApprovedHistory'])
        ->createMainNavHierachy(['MyRequests', 'AwaitingRequests'])
        ->show();
    ?>


    <?php include '../partials/footer.php'; ?>

    <?php
    include '../partials/popups/common.php';
    include '../partials/popups/cao_popup.php';
    include '../partials/popups/template.php';
    ?>
    <script>
        const requestsByMe = <?php echo json_encode($requestsByMe) ?>;
        const ongoingRequests = <?php echo json_encode($ongoingRequests) ?>;
        const pastRequests = <?php echo json_encode($pastRequests) ?>;
        const requestsToApprove = <?php echo json_encode($requestsToApprove) ?>;
        const approvedRequests = <?php echo json_encode($approvedRequests) ?>;

    </script>
    <script src="../js/classes.js"></script>
    <script src="../js/redux.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>
    <script src="../js/functions.js"></script>

</body>

</html>