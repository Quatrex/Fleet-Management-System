
<?php
require_once 'config.php';

if (isset($_POST['submit-request'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $purpose = $_POST['purpose'];
    $requesterID = 1;

    if (empty($date)  || empty($time) || empty($pickup) || empty($dropoff)) {
        
    } else {

        $sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID) VALUES(?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        } else {
            mysqli_stmt_bind_param($stmt, "ssssi", $date, $time, $dropoff, $pickup, $requesterID);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Fleet Mangement System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x12" href="images/national-logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <link href="css/style.css" rel="stylesheet">


</head>

<body>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">


                <div class="header-left">
                    <img src="images/national-logo.png">

                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">2</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">2</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Request Approved</h6>
                                                    <span class="notification-text">5 hours ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Request Denied</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </li>

                        <li class="icons">
                            <div class="user-img c-pointer position-relative">
                                <span class="activity active"></span>
                                <img src="images/default-user-image.png" height="40" width="40" alt="">
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--- End of Header-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Request</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fleet Mangement System</h4>
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Requests</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">New Request</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <div class="p-t-15">
                                                <h4>Your Pending Requests</h4>
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Pending</td>
                                                            <td>2020/04/10</td>
                                                            <td>18.10</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Pending</td>
                                                            <td>2020/04/10</td>
                                                            <td>08.10</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>Pending</td>
                                                            <td>2020/04/10</td>
                                                            <td>13.10</td>
                                                        </tr>

                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="p-t-15">
                                                <h4>New Request</h4>
                                                <form id="submit-form"  method="post" >

                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="date" placeholder="Date" autocomplete="off">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="time" class="form-control" name="time" placeholder="Time" autocomplete="off">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="pickup" placeholder="Pick-up Location" autocomplete="off">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="dropoff" placeholder="Drop-off Location" autocomplete="off">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="purpose" placeholder="Purpose" autocomplete="off">
                                                    </div>

                                                    <input name="submit-request" formaction="index.php" type="submit" value="Submit" class="btn btn-primary" id="request-form-submit-button"> <!-- add/override formaction for each of the buttons instead of action to the form-->
                                                    <input type="button" value="Close" class="btn btn-primary" id="request-form-close-button">

                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact">
                                            <div class="p-t-15">
                                                <!--Start of Cards-->
                                                <div class="container-fluid">
                                                    <!-- End Row -->
                                                    <div class="row">
                                                        <div class="col-12 m-b-30">
                                                            <h4 class="d-inline">Officers In Charge</h4>
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-3">
                                                                    <div class="card">
                                                                        <img class="img-fluid" src="images/default-user-image.png" alt="">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Justifying Officer</h5>
                                                                            <p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little bit longer.</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Col -->
                                                                <div class="col-md-6 col-lg-3">
                                                                    <div class="card">
                                                                        <img class="img-fluid" src="images/default-user-image.png" alt="">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">CAO</h5>
                                                                            <p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little bit longer.</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Col -->
                                                                <div class="col-md-6 col-lg-3">
                                                                    <div class="card">
                                                                        <img class="img-fluid" src="images/default-user-image.png" alt="">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">DCAO</h5>
                                                                            <p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little bit longer.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Col -->
                                                                <div class="col-md-6 col-lg-3">
                                                                    <div class="card">
                                                                        <img class="img-fluid" src="images/default-user-image.png" alt="">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Vehicle Pool Management Officer</h5>
                                                                            <p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little bit longer.</p>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Col -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Row -->
                                                </div>
                                                <!---End Of Cards-->
                                            </div>
                                        </div>
                                        <!--End of Contact-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--**********************************
            Footer start
            
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quatrex</a> 2020</p>
            </div>
        </div>

    </div>
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!---PopUps-->
    <!--Pop up my profile-->
    <div class="popup" id="my-profile">
        <!-- My profile content -->
        <div class="popup-content">

            <div class="popup-header">
                <span class="close" id="my-profile-close">&times;</span>
                <h2>My Profile</h2>
                <hr>
            </div>

            <div class="popup-body">

                <div class="col" style="text-align: center;">
                    <div>
                        <img src="images/default-user-image.png" alt="" height="120px" width="120px" class="rounded-circle" style="cursor: pointer; vertical-align: middle; margin-bottom:20px ;">
                    </div>

                    <p>Name</p>
                    <p>Occupation</p>
                    <p>Email</p>
                    <a href="">Change password</a>

                </div>

            </div>
            <div class="popup-footer">

            </div>
        </div>
    </div>
    <div class="popup" id="request-preview-popup">
        <!-- Request preview content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-preview-close">&times;</span>
                <h3>Preview</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p>DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p>HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>
                <input type="button" value="Confirm" class="btn btn-primary" id="request-preview-confirm-button">
                <input type="button" value="Edit" class="btn btn-link" id="request-preview-edit-button">

            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>
    <div class="popup" id="request-details-popup">
        <!--request details content -->
        <div class="popup-content">
            <div class="popup-header">
                <span class="close" id="request-details-close">&times;</span>
                <h3>Request Details</h3>
                <hr>
            </div>
            <div class="popup-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p>Date</p>
                    </div>
                    <div class="col-sm-6">
                        <p>DD-MM-YYYY</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Time</p>
                    </div>
                    <div class="col-sm-6">
                        <p>HH:MM: AM/PM</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Pick-up Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Drop-off Location</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p>Status</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Text</p>
                    </div>
                </div>

                <input type="button" value="Exit" class="btn btn-link" id="request-details-exit-button">
            </div>
            <div class="popup-footer">
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <script src="js/act.js"></script>
    <script src="js/common.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>

</html>