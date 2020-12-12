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
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'jo') {
    header("Location: login.php");
    exit();
}
include '../partials/head.php';
require_once '../includes/autoloader.inc.php';
$ui = UI::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$requestsByMe = $employee->getMyRequests(['pending', 'justified', 'approved'], 0);
$ongoingRequests = [];
// $ongoingRequests = $employee->getMyRequests(['scheduled'], 0);
$pastRequests = [];
// $pastRequests = $employee->getMyRequests(['denied', 'expired', 'cancelled', 'completed']);
$requestsToJustify = [];
// $requestsToJustify = $employee->getPendingRequests();
$justifiedRequests = [];
// $justifiedRequests = $employee->getMyJustifiedRequests(['approved', 'justified', 'denied', 'expired', 'cancelled', 'completed']);
$vehicles = [];
$_SESSION['employee'] = $employee;

?>

<body id="page-top">
    <?php
    $ui->setContents([
        new MainNavBar($employee, ['My Requests', 'Awaiting Requests']),
        new Psd(['My Requests' => ['Pending Requests', 'Ongoing Requests', 'History'], 'Awaiting Requests' => ['Justify Requests', 'Justified History']]),
        new MainNavHierarchy(
            ['MyRequests', 'AwaitingRequests'],
            [
                new SecNavBar('MyRequestsSecTab', ['Pending Requests', 'Ongoing Requests', 'History']),
                new SecNavBar('AwaitingRequestsSecTab', ['Justify Requests', 'Justified History'])
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
                    ['JustifyRequests', 'JustifiedHistory'],
                    [
                        new AwaitingRequests($requestsToJustify, 'Justify', 'Justify Requests'),
                        new AwaitingRequests($justifiedRequests, 'Justified', 'Justified History')
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
    include '../partials/popups/jo_popup.php';
    include '../partials/popups/template.php';
    ?>
    <script>
        const requestsByMe = <?php echo json_encode($requestsByMe) ?>;
        const ongoingRequests = <?php echo json_encode($ongoingRequests) ?>;
        const pastRequests = <?php echo json_encode($pastRequests) ?>;
        const requestsToJustify = <?php echo json_encode($requestsToJustify) ?>;
        const justifiedRequests = <?php echo json_encode($justifiedRequests) ?>;
        const vehicles = <?php echo json_encode($vehicles) ?>;
    </script>
    <script src="../js/classes.js"></script>
    <script src="../js/redux.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/jo.js"></script>

</body>

</html>