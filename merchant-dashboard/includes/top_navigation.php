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
            <a class="navbar-brand" href="dashboard.php">
                <i class="ti-panel"></i> Dashboard
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <!--                            <form class="navbar-form navbar-left navbar-search-form" role="search">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                <input type="text" value="" class="form-control" placeholder="Search...">
                                            </div>
                                        </form>-->

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="create_event_journey.php" class="btn-magnify" >
                        <i class="ti-pencil-alt"></i>
                        <p>Create Event</p>

                    </a>
                </li>
                <li class="dropdown">
                    <a href="reports_1.php" class="btn-magnify">
                        <i class="ti-image"></i>
                        <!--<span class="notification">5</span>-->
                        <p>
                            Analytics
                            <!--                                            <b class="caret"></b>-->
                        </p>
                    </a>
                    <!--                                    <ul class="dropdown-menu">
                                                            <li><a href="#">All Events</a></li>
                                                            <li><a href="#">Test Event - 01</a></li>
                                                            <li><a href="#">Test Event - 02</a></li>
                                                        </ul>-->
                </li>
                <li>
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