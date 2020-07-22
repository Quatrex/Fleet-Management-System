<html>
<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\HTMLBuilder;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'jo') {
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
$requestsToJustify = $employee->getPendingRequests();
$justifiedRequests = $employee->getMyJustifiedRequests(['approved', 'justified', 'denied', 'expired', 'cancelled', 'completed']);
$_SESSION['employee'] = $employee;
$_SESSION['requestsByMe'] = $requestsByMe;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
$_SESSION['requestsToJustify'] = $requestsToJustify;
$_SESSION['justifiedRequests'] = $justifiedRequests;

?>

<body>
    <?php
    $uiBuilder
        ->createMainNavBar(['My Requests', 'Awaiting Requests'])
        ->createSecondaryNavBar(['Pending Requests', 'Ongoing Requests', 'History'])
        ->myRequests($requestsByMe, 'Pending', 'Your Pending Requests')
        ->myRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests')
        ->myRequests($pastRequests, 'Past', 'History')
        ->buildSecTabBody(['PendingRequests', 'OngoingRequests', 'History'])
        ->createSecondaryNavBar(['Justify Requests', 'Justified History'])
        ->awaitingRequests($requestsToJustify, 'Justify', 'Justify Requests')
        ->awaitingRequests($justifiedRequests, 'Justified', 'Justified History')
        ->buildSecTabBody(['JustifyRequests', 'JustifiedHistory'])
        ->createMainNavHierachy(['MyRequests', 'AwaitingRequests'])
        ->show();
    ?>


    <?php include '../partials/footer.php'; ?>

    <?php
    include '../partials/popups/common.php';
    include '../partials/popups/jo_popup.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
        const requestsToJustify = <?php echo json_encode(($_SESSION['requestsToJustify'])) ?>;
        const justifiedRequests = <?php echo json_encode(($_SESSION['justifiedRequests'])) ?>;

        sessionStorage.setItem('requestToJustify', requestsToJustify);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/jo.js"></script>

</body>

</html>