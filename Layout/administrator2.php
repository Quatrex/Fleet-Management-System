<html>
<?php include '../partials/head.php';

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\HTMLBuilder;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'admin') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$uiBuilder = HTMLBuilder::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$_SESSION['employee'] = $employee;
$employees = $employee->getAllPriviledgedEmployees();
$_SESSION['employees'] = $employees;
$drivers = $employee->getAllDrivers();
$_SESSION['drivers'] = $drivers;


?>

<body>
    <?php
    $uiBuilder
        ->createMainNavBar([])
        ->createSecondaryNavBar(['Employees', 'Drivers'])
        ->employees($employees)
        ->drivers($drivers)
        ->buildSecTabBody(['Employees', 'Drivers'])
        ->createMainNavHierachy([])
        ->show();
    ?>
    <?php
    include '../partials/footer.php';
    include '../partials/popups/admin_popup.php';
    ?>
    <script>
        const empID = <?php echo json_encode(($_SESSION['empid'])) ?>;
        const employees = <?php echo json_encode(($_SESSION['employees'])) ?>;
        const drivers = <?php echo json_encode(($_SESSION['drivers'])) ?>;
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/admin.js"></script>
</body>

</html>