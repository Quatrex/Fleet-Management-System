<html>
<?php include '../partials/head.php';

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\UI;
use UI\HTMLBodyComponent\MainNavBar;
use UI\HTMLBodyComponent\Psd;
use UI\HTMLBodyComponent\SecNavBar;
use UI\HTMLBodyComponent\MyRequests;
use UI\HTMLBodyComponent\SecTabBody;
use UI\HTMLBodyComponent\MainNavHierarchy;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position'])) {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$ui = UI::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']); //, $_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['position'],$_SESSION['email'],$_SESSION['username'],"agfd");
$_SESSION['employee'] = $employee;
$requests = $employee->getMyRequests(['pending', 'justified', 'approved'], 0);
// $ongoingRequests = $employee->getMyRequests(['scheduled']);
$ongoingRequests = [];
// $pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$pastRequests = [];
$_SESSION['requestsByMe'] = $requests;
$_SESSION['ongoingRequests'] = $ongoingRequests;
$_SESSION['pastRequests'] = $pastRequests;
?>

<body id="page-top">

    <?php
    $ui->setContents([
        new MainNavBar($employee),
        new Psd(['My Requests' => ['Pending Requests', 'Ongoing Requests', 'History']]),
        new MainNavHierarchy(
            ['MyRequests'],
            [
                new SecNavBar('MyRequestsSecTab', ['Pending Requests', 'Ongoing Requests', 'History'])
            ],
            [
                new SecTabBody(
                    ['PendingRequests', 'OngoingRequests', 'History'],
                    [
                        new MyRequests($requests, 'Pending', 'Pending Requests'),
                        new MyRequests($ongoingRequests, 'Ongoing', 'Ongoing Requests'),
                        new MyRequests($pastRequests, 'Past', 'Past Requests')
                    ]
                )
            ]
        )
    ]);
    $ui->create();
    $ui->show();
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

</body>

</html>