<!DOCTYPE html>
<html>

<head>
    <meta charset="uft-8">
    <title>Sign in</title>

    <!-- OG meta tags -->
    <meta property="og:site_name" content="Fleet Management System">
    <meta property="og:title" content="Fleet Management System">
    <meta property="og:description" content="Fleet Management System">
    <!--<meta property="og:image" itemprop="image" content="/images/complex-logo.jpg">-->
    <meta property="og:type" content="website">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link href="../css/style_authentication.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!--Header-->
    <div class="container-sm mt-3">
        <div class="row">
            <div class="col-sm-2">
                <div class="bg-transparent">
                    <img src="../images/national-logo.png" class="mx-auto d-block" id="national-logo">
                </div>
            </div>
            <div class="col-sm-10 mt-3 text-center">
                <p>විදේශ කටයුතු අමාත්‍යාංශය ශ්‍රී ලංකාව</p>
                <p>Ministry of Foreign Affairs Sri Lanka</p>
                <p>வெளிநாட்டு அலுவல்கள் அமைச்சு இலங்கை</p>
            </div>
        </div>
    </div>


    <!--Login Card-->
    <div class="container-sm">
        <div class="card card-register mx-auto mt-5 bg-transparent w-50">
            <div class="card-body login">
                <!--Login title-->
                <h2 class="card-title">Sign in</h2>

                <!-- <form action="authenticate.php" method="post" onsubmit="return validatelogin()" name="vform"> -->
                <form method="post" name="vform">
                    <div id="message"></div>
                    <!--Form-Username-->
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md" id="username_div">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" id="username-input" placeholder="Username..." required autocomplete="off">
                                <div id="name-error" style="color:red"></div>
                            </div>
                        </div>
                    </div>
                    <!--Form-password-->
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md" id="password_div">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" id="password-input" placeholder="Enter password..." required autocomplete="off">
                                <div id="password-error" style="color:red"></div>
                                <!--Forgot Password?-->
                                <div class="float-right">
                                    <a class="d-block small mt-3" href="forgot-password.html">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Remember password-->
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember-pasword"> Remember
                                Password</label>
                        </div>
                    </div>
                    <!--Log in button-->
                    <div style="text-align: right;">
                        <button type="button" class="btn btn-primary " name="login-submit" id="login-button">Log in</button>
                    </div>

                </form>

                <div class="clearfix">
                    <!--Doesn't have an account?-->
                    <div class="text-center">
                        <a class="d-block small mt-3" href="signup.html">Doesn't have an account?</a>
                    </div>
                </div>
                <!--<div class="text-center">
                    <a class="d-block small mt-3" href="signup.html">Doesn't have an account?</a>
                    <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
                </div>-->
            </div>
        </div>
    </div>
    <script src="validator.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>