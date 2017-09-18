<div class="sidebar" data-background-color="brown" data-active-color="danger">
            <!--
                            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
                            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
                -->
            <div class="logo text-center" style="background: #87CB16;
  background: -moz-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #87CB16), color-stop(100%, rgba(109, 192, 48, 0.7)));
  background: -webkit-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -o-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -ms-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: linear-gradient(to bottom, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background-size: 150% 150%;">
                <a href="../index.php" class="db-logo text-center">
                    <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" />
                </a>
            </div>
            <div class="logo logo-mini" style="background: #87CB16;
  background: -moz-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #87CB16), color-stop(100%, rgba(109, 192, 48, 0.7)));
  background: -webkit-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -o-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: -ms-linear-gradient(top, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background: linear-gradient(to bottom, #87CB16 0%, rgba(109, 192, 48, 0.7) 100%);
  background-size: 150% 150%;">
                <a href="#!" class="simple-text">
                    <img src="assets/img/fav1.png" alt="Ticketchai Logo" />
                </a>
            </div>
                <?php //if($_SESSION['USER_DASHBOARD_USER_IMG'] == 1){echo  $_SESSION['USER_DASHBOARD_USER_IMG'];}else{echo 'default-avatar.png';}?>
                <?php//if(empty($_SESSION['USER_DASHBOARD_USER_IMG'])){echo 'default-avatar.png';}else{   echo  $_SESSION['USER_DASHBOARD_USER_IMG'];}?>
            <div class="sidebar-wrapper">
                <div class="user">
                    <a href="user_profile_image.php">
                        <div class="photo">
                            <span>
<!--                            <img src="../upload/user_images/<?php // echo  $_SESSION['USER_DASHBOARD_USER_IMG'];?>" />-->
                                <img src="../upload/user_images/<?php echo $defimage;?> ">
                            </span>
                        </div>
                    </a>
                    <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                           
                                <?php echo $login_user_name; ?>
                                <b class="caret"></b>
                            </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li><a href="user_profile.php">My Profile</a></li>
                                <li><a href="edit_profile.php">Edit Profile</a></li>
                                <li><a href="editPassword.php">Change Password</a></li>
                            <li><a href="user_profile_image.php">Change Profile Image</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="pe-7s-display1 bold"></i>
                            <p>DASHBORD
                            </p>
                        </a>

                    </li>
                    <li>
                        <a  href="user_order.php">
                            <i class="fa fa-first-order "></i>
                            <p>Order History
                            </p>
                        </a>
                    </li>
                    <li>
                        <a  href="paid_order.php">
                            <i class="fa fa-credit-card-alt"></i>
                            <p> Paid Order
                            </p>
                        </a>
                    </li>
                    <li>
                        <a  href="pandding_order.php">
                            <i class="fa fa-refresh"></i>
                            <p>Pending Order
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="user_wishlist.php">
                            <i class="pe-7s-graph2 bold"></i>
                            <p>My Wishlist
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="user_address.php">
                            <i class="pe-7s-map-marker bold"></i>
                            <p>Edit Address
                            </p>
                        </a>
                    </li>
                    


                </ul>
            </div>
        </div>