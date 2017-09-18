<?php
include '../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

/* Getting order information from database */
$arrOrder = array();
$sqlOrders = "SELECT order_id,order_status,order_number,order_total_amount,order_discount_amount,order_shipment_charge,order_created  FROM `orders` "
        . "LEFT JOIN order_events ON `order_events`.OE_order_id = orders.order_id "
        . "LEFT JOIN events ON `order_events`.OE_event_id = events.event_id ";
if ($adminEventPermission == "created") {
    $sqlOrders .= "WHERE event_created_by=$adminID ";
} elseif ($adminEventPermission == "selected") {
    if ($adminEventID != "") {
        $sqlOrders .= "WHERE event_id IN ($adminEventID) ";
    } else {
        $sqlOrders .= "WHERE event_id IN (0) ";
    }
}
$sqlOrders .= "GROUP BY orders.order_id "
        . "ORDER BY orders.order_id DESC";
$resultOrders = mysqli_query($con, $sqlOrders);
if ($resultOrders) {
    while ($resultOrdersObj = mysqli_fetch_object($resultOrders)) {
        if ($resultOrdersObj->order_status == "booking" || $resultOrdersObj->order_status == "approved") {
            $arrOrder["booking"][] = $resultOrdersObj;
        } elseif ($resultOrdersObj->order_status == "delivered" || $resultOrdersObj->order_status == "paid" || $resultOrdersObj->order_status == "closed") {
            $arrOrder["complete"][] = $resultOrdersObj;
        }
    }
} else {
    if (DEBUG) {
        echo "resultOrders error: " . mysqli_error($con);
    }
}
/* Getting order information from database */



/* Getting user information from database */

$countUsers = 0;
$sqlUsers = "SELECT COUNT(user_id) AS totalUser"
        . " FROM users WHERE user_status='active' AND user_verification='yes'";
$resultUsers = mysqli_query($con, $sqlUsers);
if ($resultUsers) {
    $resultUsersObj = mysqli_fetch_object($resultUsers);
    if (isset($resultUsersObj->totalUser)) {
        $countUsers = $resultUsersObj->totalUser;
    }
} else {
    if (DEBUG) {
        echo "resultUsers error: " . mysqli_error($con);
    }
}

/* Getting user information from database */

// User information
$userArray = array();
$sqlUserInformation = "SELECT user_email,CONCAT(user_first_name,' ',user_last_name) AS username"
        . " FROM users WHERE user_status='active' AND user_verification='yes' ORDER BY user_id DESC LIMIT 0,30 ";
$resultUserInformation = mysqli_query($con, $sqlUserInformation);
if ($resultUserInformation) {
    while ($userInformationObj = mysqli_fetch_object($resultUserInformation)) {
        $userArray[] = $userInformationObj;
    }
} else {
    if (DEBUG) {
        echo "resultUserInformation error: " . mysqli_error($con);
    }
}

/* Getting active event information from database */
$countEvents = 0;
$arrayEventName = array();
$sqlEvents = "SELECT event_id,event_title FROM events WHERE event_status='active' AND event_is_featured='yes' ";
if ($adminEventPermission == "created") {
    $sqlEvents .= "AND event_created_by=$adminID ";
} elseif ($adminEventPermission == "selected") {
    if ($adminEventID != "") {
        $sqlEvents .= "AND event_id IN ($adminEventID) ";
    } else {
        $sqlEvents .= "AND event_id IN (0) ";
    }
}
$resultEvents = mysqli_query($con, $sqlEvents);
if ($resultEvents) {
    while ($resultEventsObj = mysqli_fetch_object($resultEvents)) {
        $arrayEventName[] = $resultEventsObj;
    }
    $countEvents = count($arrayEventName);
} else {
    if (DEBUG) {
        echo "resultEvents error: " . mysqli_error($con);
    }
}

/* Getting active event information from database */


/* Getting active event information from database */
$eventOverDate = "";
$overEventArray = array();
$today = date("Y-m-d");

$adtype=getSession('admin_type');
$adid=getSession('admin_id');
$adevtid=getSession('admin_event_id');
if($adtype==1)
{
$sqlGetDateOverEvent = "SELECT event_venues.venue_id,event_venues.venue_event_id,"
        . "event_venues.venue_start_date,event_venues.venue_end_date,"
        . "events.event_id,events.event_title,events.event_status,events.event_is_featured"
        . " FROM event_venues"
        . " LEFT JOIN events ON event_venues.venue_event_id = events.event_id"
        . " WHERE events.event_status = 'active' AND events.event_is_featured = 'yes' AND (event_venues.venue_start_date < '$today' AND event_venues.venue_end_date = '0000-00-00')";
}
else 
{
  $sqlGetDateOverEvent = "SELECT event_venues.venue_id,event_venues.venue_event_id,"
        . "event_venues.venue_start_date,event_venues.venue_end_date,"
        . "events.event_id,events.event_title,events.event_status,events.event_is_featured"
        . " FROM event_venues"
        . " LEFT JOIN events ON event_venues.venue_event_id = events.event_id"
        . " WHERE events.event_id='".$adevtid."'";  
}
$resultGetDateOverEvent = mysqli_query($con, $sqlGetDateOverEvent);
$countOverEvent = mysqli_num_rows($resultGetDateOverEvent);
if ($resultGetDateOverEvent) {
    while ($resultGetDateOverEventObj = mysqli_fetch_object($resultGetDateOverEvent)) {
        $overEventArray[] = $resultGetDateOverEventObj;
    }
} else {
    if (DEBUG) {
        echo "resultGetDateOverEvent error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><!-- <![endif]-->
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <?php include basePath('admin/header_script.php'); ?>	
    </head>
    <body class="">

        <?php include basePath('admin/header.php'); ?>

        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Dashboard</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="panel-3d animated" style="visibility: visible;">
                            <?php 
                            
                            if($adtype==1)
                                {
                            ?>
                            <div class="front">
                                <div class="widget text-center">
                                    <div class="widget-body padding-none">
                                        <div>
                                            <div class="innerAll bg-inverse">
                                                <p class="lead text-white strong margin-none"><i class="icon-graph-up-1 animated fadeInDown" style="visibility: visible;"></i><br><?php echo $countUsers; ?> Users</p>
                                            </div>
                                            <div class="innerAll">
                                                <button class="btn btn-inverse">View Statistics</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="back">
                                <div class="widget widget-inverse widget-scroll" data-scroll-height="165px">
                                    <div class="widget-head">
                                        <button class="btn btn-xs btn-default pull-right"><i class="fa fa-times"></i></button>
                                        <h4 class="heading">Statistics</h4>
                                    </div>
                                    <div class="widget-body padding-none">
                                        <div tabindex="5002" style="height: 165px; overflow: hidden; outline: none;">
                                            <?php if (count($userArray) > 0): ?>    
                                                <?php foreach ($userArray AS $user): ?>
                                                    <div class="media innerAll half margin-none">
                                                        <div class="media-body ">
                                                            <i class="fa fa-leaf"></i>&nbsp;<?php echo $user->username; ?>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <em><?php echo $user->user_email; ?></em>
                                                    </div>
                                                    <hr class="margin-none">
                                                <?php endforeach; ?>
                                            <?php endif; ?>    
                                            <a href="<?php echo baseUrl('admin/customer/user_list.php'); ?>" style="margin-left: 180px;">View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="ascrail2000" class="nicescroll-rails" style="width: 7px; z-index: 800; cursor: default; position: absolute; top: 41px; left: 237px; height: 165px; opacity: 0;">
                                    <div style="position: relative; top: 0px; float: right; width: 5px; height: 102px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div>
                                </div>
                                <div id="ascrail2000-hr" class="nicescroll-rails" style="height: 7px; z-index: 800; top: 199px; left: 1px; position: absolute; cursor: default; display: none; width: 236px; opacity: 0;">
                                    <div style="position: relative; top: 0px; height: 5px; width: 243px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div>
                                </div>
                            </div>
                            
                            <?php }else{ ?>
                            <div class="front">
                                <div class="widget text-center">
                                    <div class="widget-body padding-none">
                                        <div>
                                            <div class="innerAll bg-inverse">
                                                <p class="lead text-white strong margin-none"><i class="icon-ship-wheel animated fadeInDown" style="visibility: visible;"></i><br><?php echo "Your ID: ".$adid; ?></p>
                                            </div>
                                            <div class="innerAll">
                                                <?php echo "Last Login IP: ".$_SERVER['REMOTE_ADDR']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-6">

                        <?php
                        $countComplete = 0;
                        $totalPrice = 0;
                        if (isset($arrOrder['complete'])) {
                            $countComplete = count($arrOrder['complete']);
                            foreach ($arrOrder['complete'] AS $CompleteOrder) {
                                $totalPrice += ($CompleteOrder->order_total_amount + $CompleteOrder->order_shipment_charge) - $CompleteOrder->order_discount_amount;
                            }
                        }
                        ?>
                        <div class="panel-3d animated" style="visibility: visible;">
                            <div class="front">

                                <div class="widget text-center">
                                    <div class="widget-body padding-none">
                                        <div>
                                            <div class="innerAll bg-default">
                                                <p class="lead strong margin-none"><i class="icon-add-to-cart animated fadeInDown" style="visibility: visible;"></i><br><?php echo $countComplete; ?> Orders</p>
                                            </div>
                                            <div class="innerAll">
                                                <button class="btn btn-default">View Orders</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="back">
                                <div class="widget widget-inverse widget-scroll" data-scroll-height="165px">
                                    <div class="widget-head">
                                        <button class="btn btn-xs btn-default pull-right"><i class="fa fa-times"></i></button>
                                        <h4 class="heading">Orders</h4>
                                    </div>
                                    <div class="widget-body padding-none">
                                        <div tabindex="5001" style="height: 165px; overflow: hidden; outline: none;">
                                            <div class="box-generic border-none text-center">
                                                <p class="margin-none">Orders Total</p>
                                                <p><strong class="text-large text-primary"><?php echo $config['CURRENCY_SIGN']; ?> <?php echo $totalPrice; ?></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ascrail2001" class="nicescroll-rails" style="width: 7px; z-index: 800; cursor: default; position: absolute; top: 41px; left: 237px; height: 165px; display: none;"><div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div><div id="ascrail2001-hr" class="nicescroll-rails" style="height: 7px; z-index: 800; top: 199px; left: 1px; position: absolute; cursor: default; display: none;"><div style="position: relative; top: 0px; height: 5px; width: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">

                        <?php
                        $countBooking = 0;
                        $totalPrice = 0;
                        if (isset($arrOrder['booking'])) {
                            $countBooking = count($arrOrder['booking']);
                            foreach ($arrOrder['booking'] AS $BookingOrder) {
                                $totalPrice += number_format(($BookingOrder->order_total_amount + $BookingOrder->order_shipment_charge) - $BookingOrder->order_discount_amount, 2);
                            }
                        }
                        ?>

                        <div class="panel-3d animated" style="visibility: visible;">
                            <div class="front">

                                <div class="widget text-center">
                                    <div class="widget-body padding-none">
                                        <div>
                                            <div class="innerAll bg-success">
                                                <p class="lead strong margin-none text-white"><i class="icon-note-pad animated fadeInDown" style="visibility: visible;"></i><br><?php echo $countBooking; ?> Bookings</p>
                                            </div>
                                            <div class="innerAll">
                                                <button class="btn btn-success">View Bookings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="back">
                                <div class="widget widget-inverse widget-scroll" data-scroll-height="165px">
                                    <div class="widget-head">
                                        <button class="btn btn-xs btn-default pull-right"><i class="fa fa-times"></i></button>
                                        <h4 class="heading">Booking History</h4>
                                    </div>
                                    <div class="widget-body padding-none">
                                        <div tabindex="5002" style="height: 165px; overflow: hidden; outline: none;">
                                            <?php if (isset($arrOrder['booking'])): ?>    
                                                <?php foreach ($arrOrder['booking'] AS $BookingOrder): ?>
                                                    <div class="media innerAll half margin-none">
                                                        <div class="media-body ">
                                                            <a href="<?php echo baseUrl(); ?>admin/orders/order_details.php?order_id=<?php echo $BookingOrder->order_id; ?>" class="strong text-success">
                                                                <i class="fa fa-circle"></i>Order ID: <?php echo $BookingOrder->order_number; ?>
                                                            </a> 
                                                            <div class="clearfix"></div>
                                                            <em><?php echo date("d M, Y", strtotime($BookingOrder->order_created)); ?></em>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-none">
                                                <?php endforeach; ?>
                                            <?php endif; ?>    

                                        </div>
                                    </div>
                                </div>
                                <div id="ascrail2002" class="nicescroll-rails" style="width: 7px; z-index: 800; cursor: default; position: absolute; top: 41px; left: 237px; height: 165px; display: none;"><div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div><div id="ascrail2002-hr" class="nicescroll-rails" style="height: 7px; z-index: 800; top: 199px; left: 1px; position: absolute; cursor: default; display: none;"><div style="position: relative; top: 0px; height: 5px; width: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div></div>
                        </div>
                    </div>



                    <div class="col-md-3 col-sm-6">
                        <div class="panel-3d animated" style="visibility: visible;">
                            <div class="front">

                                <div class="widget text-center">
                                    <div class="widget-body padding-none">
                                        <div>
                                            <div class="bg-info innerAll">
                                                <p class="lead strong margin-none text-white"><i class="fa fa-bullhorn" style="visibility: visible;"></i><br><?php echo $countEvents; ?> Events</p>
                                            </div>
                                            <div class="innerAll">
                                                <button class="btn btn-info">View Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="back">

                                <div class="widget widget-inverse widget-scroll" data-scroll-height="165px">
                                    <div class="widget-head">
                                        <button class="btn btn-xs btn-default pull-right"><i class="fa fa-times"></i></button>
                                        <h4 class="heading">Your Events</h4>
                                    </div>
                                    <div class="widget-body padding-none">
                                        <div tabindex="5002" style="height: 165px; overflow: hidden; outline: none;">
                                            <?php if (count($arrayEventName) > 0): ?>    
                                                <?php foreach ($arrayEventName AS $name): ?>
                                                    <div class="media innerAll half margin-none">
                                                        <div class="media-body ">
                                                            <a href="<?php echo baseUrl(); ?>admin/view_list.php?id=<?php echo $name->event_id; ?>"><i class="fa fa-leaf"></i>&nbsp;<?php echo $name->event_title; ?></a>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-none">
                                                <?php endforeach; ?>
                                            <?php endif; ?>    

                                        </div>
                                    </div>

                                </div>

                                <div id="ascrail2003" class="nicescroll-rails" style="width: 7px; z-index: 800; cursor: default; position: absolute; top: 41px; left: 237px; height: 165px; display: none;"><div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div><div id="ascrail2003-hr" class="nicescroll-rails" style="height: 7px; z-index: 800; top: 199px; left: 1px; position: absolute; cursor: default; display: none;"><div style="position: relative; top: 0px; height: 5px; width: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(66, 66, 66); background-clip: padding-box;"></div></div></div>
                        </div>
                    </div>
                </div>

                <!-- Event List For Archived -->
                <?php if ($countOverEvent > 0): ?>
                    <div class="widget widget-inverse">
                        <div class="widget-head">
                            <h4 class="heading">Event List</h4>
                        </div>
                        <div class="widget-body">
                            <table class="table table-bordered table-striped table-white">
                                <thead>
                                    <tr>
                                        <th class="center">No.</th>
                                        <th>Event Title</th>
                                        <th>Event Ending Date</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>

                                    <?php foreach ($overEventArray AS $over): ?>

                                        <tr>
                                            <td class="center"><?php echo $count; ?></td>
                                            <td><?php echo $over->event_title; ?></td>
                                            <td><?php echo $over->venue_start_date; ?></td>
                                            <td>
                                                <?php 
                                                if($adtype==1){
                                                ?>
                                                <div class="btn-group btn-group-xs ">
                                                    <a class="btn btn-inverse" href="<?php echo baseUrl(); ?>admin/make_archive.php?id=<?php echo $over->event_id; ?>"><i class="fa fa-pencil"></i>&nbsp;Archive</a>
                                                </div>
                                                <?php }else{ ?>
                                                <div class="btn-group btn-group-xs ">
                                                    <a class="btn btn-inverse" href="<?php echo baseUrl(); ?>admin/view_list.php?id=<?php echo $over->event_id; ?>"><i class="fa fa-pencil"></i>&nbsp;View Orders</a>
                                                </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $count++; ?>
                                    <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Event List For Archived -->


            </div>

        </div><!-- // Content END -->
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#dash").addClass("active");
        $("#dash").parent().parent().addClass("active");
        $("#dash").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>