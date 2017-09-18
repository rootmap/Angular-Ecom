<?php
$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

$newOrder = 0;
$sqlOrders = "SELECT order_id FROM `orders` "
        . "LEFT JOIN order_events ON `order_events`.OE_order_id = orders.order_id "
        . "LEFT JOIN events ON `order_events`.OE_event_id = events.event_id "
        . "WHERE order_read='no' ";
if ($adminEventPermission == "created") {
    $sqlOrders .= "AND event_created_by=$adminID ";
} elseif ($adminEventPermission == "selected") {
    if ($adminEventID != "") {
        $sqlOrders .= "AND event_id IN ($adminEventID) ";
    } else {
        $sqlOrders .= "AND event_id IN (0) ";
    }
}
$sqlOrders .= "GROUP BY orders.order_id "
        . "ORDER BY orders.order_id DESC";
$resultOrders = mysqli_query($con, $sqlOrders);
if ($resultOrders) {
    $newOrder = mysqli_num_rows($resultOrders);
} else {
    if (DEBUG) {
        echo "resultOrders error: " . mysqli_error($con);
    }
}
?>
<div class="navbar navbar-fixed-top navbar-primary main" role="navigation">

    <div class="navbar-header pull-left">
        <div class="navbar-brand">
            <div class="pull-left">
                <a href="" class="toggle-button toggle-sidebar btn-navbar"><i class="fa fa-bars"></i></a>
            </div>
            <a href="<?php echo baseUrl('admin/dashboard.php'); ?>" class="appbrand innerL"><i>TicketChai</i></a>
        </div>
    </div>

    <ul class="nav navbar-nav navbar-left hidden-xs">
        <li class="dropdown notification hidden-sm hidden-md">
            <a href="#" class="dropdown-toggle menu-icon dropdown-hover" data-toggle="dropdown"><i class="fa fa-fw fa-exclamation-circle"></i><span class="badge badge-info"><?php
                    if ($newOrder > 0) {
                        echo $newOrder;
                    }
                    ?></span></a>
            <ul class="dropdown-menu">
                <?php if ($newOrder > 0): ?><li><a href="<?php echo baseUrl(); ?>admin/orders/index.php"><span style="color: tomato; font-weight: bolder;"><?php echo $newOrder; ?></span> New Order Placed. Click to check.</a></li><?php endif; ?>
            </ul>
        </li>
    </ul>

    <ul class="nav navbar-nav navbar-right hidden-xs">
        <li class="dropdown">
            <a href="" class="dropdown-toggle user" data-toggle="dropdown"> <img src="<?php echo baseUrl('admin/assets/images/people/35/1.jpg') ?>" alt="" class="img-circle"/><span class="hidden-xs hidden-sm"> &nbsp; <?php echo "" . getSession("admin_name") . ""; ?> </span> <span class="caret"></span></a>
            <ul class="dropdown-menu list pull-right ">
                <li><a href="<?php echo baseUrl('admin/account/edit_profile.php'); ?>"><i class="fa fa-user pull-right"></i>My Account</a></li>
                <li><a href="<?php echo baseUrl('admin/account/change_password.php'); ?>"><i class="fa fa-pencil pull-right"></i>Change Password</a></li>
                <li><a href="<?php echo baseUrl('admin/logout.php'); ?>"><i class="fa fa-sign-out pull-right"></i>Log out</a></li>
            </ul>
        </li>
    </ul>
</div>