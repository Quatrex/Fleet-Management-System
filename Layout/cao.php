<html>
<?php

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\UI;
use UI\HTMLBodyComponent\MainNavBar;
use UI\HTMLBodyComponent\Psd;
use UI\HTMLBodyComponent\SecNavBar;
use UI\HTMLBodyComponent\MyRequests;
use UI\HTMLBodyComponent\AwaitingRequests;
use UI\HTMLBodyComponent\SecTabBody;
use UI\HTMLBodyComponent\MainNavHierarchy;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'cao') {
    header("Location: login.php");
    exit();
}
include '../partials/head.php';
require_once '../includes/autoloader.inc.php';
$ui = UI::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved'], 0);
$ongoingRequests = [];
// $ongoingRequests = $employee->getMyRequests(['scheduled']);
$pastRequests = [];
// $pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$requestsToApprove = [];
// $requestsToApprove = $employee->getJustifiedRequests();
$approvedRequests = [];
// $approvedRequests = $employee->getMyApprovedRequests(['approved', 'denied', 'expired', 'cancelled', 'completed']);
$_SESSION['employee'] = $employee;
?>

<body id="page-top">
    <?php
    $ui->setContents([
        new MainNavBar($employee, ['My Requests', 'Awaiting Requests']),
        new Psd(['My Requests' => ['Pending Requests', 'Ongoing Requests', 'History'], 'Awaiting Requests' =>['Approve Requests', 'Approved History']]),
        new MainNavHierarchy(
            ['MyRequests', 'AwaitingRequests'],
            [
                new SecNavBar('MyRequestsSecTab', ['Pending Requests', 'Ongoing Requests', 'History']),
                new SecNavBar('AwaitingRequestsSecTab', ['Approve Requests', 'Approved History'])
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
                    ['ApproveRequests', 'ApprovedHistory'],
                    [
                        new AwaitingRequests($requestsToApprove, 'Approve', 'Approve Requests'),
                        new AwaitingRequests($approvedRequests, 'Approved', 'Approved History')
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