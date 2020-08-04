<html>
<?php include '../partials/head.php';

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\HTMLBuilder;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position'])) {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$uiBuilder = HTMLBuilder::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']); //, $_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['position'],$_SESSION['email'],$_SESSION['username'],"agfd");
$_SESSION['employee'] = $employee;
$requests = $employee->getMyRequests(['pending', 'justified', 'approved']);
$ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$_SESSION['requestsByMe'] = $requests;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
?>

<body>

    <?php
    $uiBuilder
        ->createMainNavBar()
        ->createSecondaryNavBar(['Pending Requests', 'Ongoing Requests', 'History'])
        ->myRequests($requests, 'Pending', 'Your Pending Requests')
        ->myRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests')
        ->myRequests($pastRequests, 'Past', 'History')
        ->buildSecTabBody(['PendingRequests', 'OngoingRequests', 'History'])
        ->createMainNavHierachy()
        ->show();
    ?>

    <?php include '../partials/footer.php'; ?>
    <?php include '../partials/popups/template.php'; ?>
    <?php include '../partials/popups/common.php'; ?>
    <script>
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
    </script>
    <script src="../js/redux.js"></script>
    <script src="../js/classes.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/functions.js"></script>
    <script>
        const myWindow = new DOMWindow();
    </script>
</body>

</html>