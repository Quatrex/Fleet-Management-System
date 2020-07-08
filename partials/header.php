<div class="header">
    <div class="header-content clearfix">
        <div class="header-left">
            <img src="../images/national-logo.png">

        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="dropdown">
                        <div class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" data-toggle="dropdown">
                            <div class="user-img c-pointer position-relative">
                                <span class="activity"></span>
                                <img src="../images/default-user-image.png" height="40" width="40" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="dropdown-menu profile-dropdown" style="box-shadow: 0px 1px 17px 2px rgba(0,0,0,0.78);;">
                                <div class="dropdown-content" style="text-align: center; margin: 20px 33px;">
                                    <img src="../images/default-user-image.png" style="height:100px;width:100px;align-items: center;">

                                    <div class="container">
                                        <p></p>
                                        <p class="name-profile-dd" style="text-align: center;"><?php echo $employee->getfield('firstName') . ' ' . $employee->getfield('lastName'); ?> </p>
                                        <p class="name-profile-dd" style="text-align: center;"><?php echo $employee->getfield('position'); ?></p>
                                        <p class="mail-profile-dd" style="text-align: center;"><?php echo $employee->getfield('email'); ?></p>
                                        <p></p>
                                        <button class="edit-account-btn" id="edit-account-info-btn">Edit account info</button>
                                    </div>
                                </div>
                                <div class="footer-profile">
                                    <button class="sign-out"><a href="../func/logout.php">Sign out</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="icons"><a href="../func/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>