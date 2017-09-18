<!-- Navbar -->
<?php
@session_start();
//include '././DBconnection/auth.php';
@$_SESSION['USER_DASHBOARD_USER_ID'];
@$user_name = $_SESSION['USER_DASHBOARD_USER_FULLNAME'];
?>
<nav id="common-nav" class="navbar navbar-fixed-top navbar-default" style="margin-bottom:0px;" >
    <script type="text/javascript">
        var baseUrl = '<?php echo $cms->siteUrl(); ?>';</script>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php">
                <div class="logo-container">
                    <div class="logo">
                        <img src="<?php echo $cms->baseUrl('assets/img/white-shadow-logo.png'); ?>" alt="Ticketchai Logo" rel="tooltip" title="<b>Ticketchai.com</b>" data-placement="bottom" data-html="true"/>
                    </div>
                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-index" >
            <ul id="common-nav-ul" class="nav navbar-nav navbar-right">


                <!--!!!!!!!!!!!!!!!!!!   Search  !!!!!!!!!!!!!!!!!!-->
                <li class="text-center hidden-sm">
                    <a href="#!" id="nav-search-btn"><i class="fa fa-search" aria-hidden="true">&nbsp;</i> Search Events</a>
                    <div id="nav-search-field" class="form-group" style="display: none;">

                        <input id="searchInput" name="control" type="text" class="form-control control" placeholder="Search For An Event" ng-model="EventHint" ng-change="searchEvent()">
                        <span class="floating-f-p">
                            <a href="#!"  id="nav-search-close" ><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                        </span>

                    </div>
                    <div id="rslt-div" class="list-group show_hide" style="box-shadow: none;">
                        <ul class="" style="background:#88C659 !important; width:100%; height:auto; color:black; clear: both; border: 1px solid #ffffff; " id="results">
                            <li ng-repeat="x in s = (searchResult| filter: EventHint | limitTo:7 |  orderBy: DESC)" ng-if="EventHint.length > 2">
                                <a href="checkout1.php?id={{x.event_id}}" class="list-group-item" style="margin-bottom: -5px !important;">
                                    <span>{{x.event_title.length > '25' ? (x.event_title | limitTo:20) + '..' : x.event_title}}</span>
                                </a>
                            </li>
                            <li  ng-if="EventHint.length < 3">
                                <a href="javascript:void(0);" class="list-group-item" style="max-width: 185px;">
                                    <span>Please Wait</span>
                                    <img src="<?php echo $cms->baseUrl("assets/img/small.gif "); ?>" alt="Loading ..." />
                                </a>
                            </li>

                            <li ng-if="s.length === 0">
                                <a href="javascript:void(0);" class="list-group-item" style="max-width: 185px;">
                                    <span>No Event Found As {{EventHint}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>  
                <!--!!!!!!!!!!!!!!!!!!   Search  !!!!!!!!!!!!!!!!!!-->


                <!--                <li class="text-center single-nav" ng-repeat="x in element| limitTo:5">
                                    <a href="{{x.category_title| lowercase}}.php?page_id={{x.category_id}}" >{{x.category_title}}</a>
                                </li>
                
                                <li class="dropdown text-center">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li ng-repeat="x in element.slice(5)"><a href="{{x.category_title| lowercase}}.php?page_id={{x.category_id}}">{{x.category_title}}</a></li>
                                    </ul>
                                </li>-->

                <li class="text-center single-nav" ng-repeat="x in element| limitTo:5">
                    <a href="category.php?cat_id={{x.category_id}};&cat_title={{x.category_title| lowercase}}"><i class="{{x.category_icon}} icon-2x nav-icon"></i> {{x.category_title}}</a>
                </li>
                <li class="dropdown text-center" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="more">More <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li ng-repeat="x in element.slice(5)" class="text-center"><a class="text-center" href="category.php?cat_id={{x.category_id}};&cat_title={{x.category_title| lowercase}}">{{x.category_title}}</a></li>
                    </ul>
                </li>                

                <li class="text-center hidden-sm">
                    <?php
                    if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {
                        echo "<a href='user_dashboard/dashboard.php'><i class='fa fa-dashcube' aria-hidden='true'></i>  $user_name</a>";
                    }
                    ?>
                    <!-- <a href="signin.php"><i class="fa fa-lock" aria-hidden="true"></i> Log In</a> -->
                </li>
                <li class="text-center single-nav hidden-sm">
                    <a href="<?php echo $cms->baseUrl(" ../merchant-dashboard/login.php?ref='ok'"); ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> Create event</a>
                </li>
                <li class="text-center hidden-sm">
                    <?php
                    $pageName = $cms->filename();
                    if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {
                        echo "<a href='$pageName?signout'><i class='fa fa-power-off'></i> Log Out </a>";
                    } else {
                        echo " <a href='signin.php' ><i class='icon-lock'></i> Log In </a> ";
                    }
                    ?>
                </li>


            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

