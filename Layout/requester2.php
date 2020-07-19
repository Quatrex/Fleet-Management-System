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
    <!-- Main Nav Bar -->
    <?php
    $uiBuilder->createMainNavBar(['My Requests', 'Awaiting Requests']);
    ?>
    <!-- Main Nav Bar End-->

    <!--Secondary Nav Bar-->
    <?php
    $uiBuilder->createSecondaryNavBar(['Pending Requests', 'Ongoing Requests','History']);
    ?>
    <!--Secondary Nav Bar End-->

    <!-- Body Start -->
    <div class="container-fluid">
        <input type="button" value="New Request" class="btn btn-primary rounded shadow p-3 mb-4" id="request-vehicle-button">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="pendingRequests" role="tabpanel">
                <div class="card">
                    <h3 class="card-header bg-dark text-white">Your Pending Requests</h3>
                    <div class="card-body" id='my-pending-requests-card'>
                        <?php
                        $uiBuilder->myRequests($requests);
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ongoingRequests" role="tabpanel">
                <div class="card">
                    <h3 class="card-header bg-dark text-white">Ongoing Requests</h3>
                    <div class="card-body">
                        <?php
                        $uiBuilder->myRequests($ongoingRequests, 'Ongoing');
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="history" role="tabpanel">
                <div class="card">
                    <h3 class="card-header bg-dark text-white">History</h3>
                    <div class="card-body">
                        <?php
                        $uiBuilder->myRequests($pastRequests, 'Past');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body Start -->

    <?php include '../partials/footer.php'; ?>
    <?php include '../partials/popups/common.php'; ?>
    <script>
        const requestsByMe = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const ongoingRequests = <?php echo json_encode(($_SESSION['ongoingRequests'])) ?>;
        const pastRequests = <?php echo json_encode(($_SESSION['pastRequests'])) ?>;
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        sessionStorage.setItem('requestsByMe', requestsByMe);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
</body>

</html>