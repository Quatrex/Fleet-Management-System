<html>
<?php include '../partials/head.php';

use Employee\Factory\Privileged\PrivilegedEmployeeFactory;
use UI\UI;
use UI\HTMLBodyComponent\MainNavBar;
use UI\HTMLBodyComponent\Psd;
use UI\HTMLBodyComponent\SecNavBar;
use UI\HTMLBodyComponent\Employees;
use UI\HTMLBodyComponent\Drivers;
use UI\HTMLBodyComponent\SecTabBody;
use UI\HTMLBodyComponent\MainNavHierarchy;

session_start();
if (!isset($_SESSION['empid']) or !isset($_SESSION['position']) or $_SESSION['position'] != 'admin') {
    header("Location: login.php");
    exit();
}
require_once '../includes/autoloader.inc.php';
$ui = UI::getInstance();
$employee = PrivilegedEmployeeFactory::makeEmployee($_SESSION['empid']);
$_SESSION['employee'] = $employee;
$employees = $employee->getAllPriviledgedEmployees();
// $drivers = $employee->getAllDrivers();
$drivers = [];


?>

<body id="page-top">
    <?php
    $ui->setContents([
        new MainNavBar($employee),
        new Psd([ 'Admin' => ['Employees', 'Drivers']]),
        new MainNavHierarchy(
            ['Database'],
            [
                new SecNavBar('AdminSecTab', ['Employees', 'Drivers'])
            ],
            [
                new SecTabBody(
                    ['Employees', 'Drivers'],
                    [
                        new Employees($employees),
                        new Drivers($drivers)
                    ]
                )
            ]
        )
    ]);
    $ui->create();
    $ui->show();
    ?>
    <?php
    include '../partials/footer.php';
    include '../partials/popups/admin_popup.php';
    include '../partials/popups/template.php';
    ?>
    <script>
        const employees = <?php echo json_encode($employees) ?>;
        console.log(employees);
        const drivers = <?php echo json_encode($drivers) ?>;
    </script>
    <script>
        $('.menu-toggle').click(function() {
            $(".psd").toggleClass("psd-animate");
            // $("#psd").slideUp();
            console.log("Clicked");


        });
        $('#close-button').click(function() {
            $(".psd").toggleClass("psd-animate");


        });
    </script>
    <script src="../js/classes.js"></script>
    <script src="../js/redux.js"></script>
    <script src="../js/eventlisteners/admin.js"></script>
</body>

</html>