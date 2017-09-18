<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href=javascript:void(0)">
                            <i class="ti-user"></i> Customer Panel | Customer Logged : <code><?php echo $_SESSION['USER_DASHBOARD_USER_FULLNAME']; ?></code> | User Login IP : <code><?php echo $_SERVER['REMOTE_ADDR']; ?></code>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">

                       

                        <ul class="nav navbar-nav navbar-right">
                            
                            <li>
                                <!--<a href="<?php // echo $cms->filename(); ?>?logout" class="btn-magnify">-->
                                <a href="<?php echo $cms->filename(); ?>?logout" class="btn-magnify">
                                    <i class="ti-power-off"></i>
                                    <p>
                                        Sign Out
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

