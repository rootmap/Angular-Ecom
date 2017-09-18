<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$ID = 0;
if (isset($_GET['MI_id'])) {
    $ID = $_GET['MI_id'];
}
$sqlGetRequestEventData = "SELECT * FROM merchant_info WHERE MI_id=$ID";
$resultRequestEventData = mysqli_query($con, $sqlGetRequestEventData);
if ($resultRequestEventData) {
    $resultRequestEventDataObj = mysqli_fetch_object($resultRequestEventData);
    $first_name = $resultRequestEventDataObj->MI_first_name;
    $last_name = $resultRequestEventDataObj->MI_last_name;
    $contact_email = $resultRequestEventDataObj->MI_email_address;
    $contact_address = $resultRequestEventDataObj->MI_address;
    $contact_number = $resultRequestEventDataObj->MI_number;
    $event_title = $resultRequestEventDataObj->MI_event_title;
    $event_datatime = $resultRequestEventDataObj->MI_event_date_time;
    $close_event = $resultRequestEventDataObj->MI_is_closed_event;
    $event_details = $resultRequestEventDataObj->MI_event_description;
    $venue_name = $resultRequestEventDataObj->MI_venue_name;
    $venue_address = $resultRequestEventDataObj->MI_venue_address;
    $about_ticket = $resultRequestEventDataObj->MI_about_ticket;
} else {
    if (DEBUG) {
        $err = "resultRequestEventData error: " . mysqli_error($con);
    } else {
        $err = "resultRequestEventData query failed.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <?php include basePath('admin/header_script.php'); ?>	
    </head>
    <body>
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
        <div id="content" style="padding-left: 0px;">
            <h3 class="bg-white content-heading border-bottom strong">Requested Event Details</h3>
            <div class="innerAll spacing-x2">
                <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                    <?php include basePath('admin/message.php'); ?>
                </div>
                <div class="relativeWrap">
                    <div class="box-generic">

                        <div class="tabsbar tabsbar-2">
                            <ul class="row row-merge">
                                <li class="col-md-3 glyphicons cargo active"><a data-toggle="tab" href="#tab1-4"><i></i> About Merchant</a></li>
                                <li class="col-md-3 glyphicons circle_info"><a data-toggle="tab" href="#tab2-4"><i></i> <span>About Event</span></a></li>
                                <li class="col-md-3 glyphicons cart_in"><a data-toggle="tab" href="#tab3-4"><i></i> <span>About Venue</span></a></li>
                                <li class="col-md-3 glyphicons pencil"><a data-toggle="tab" href="#tab4-4"><i></i> <span>About Ticket</span></a></li>
                            </ul>
                        </div>

                        <div class="tab-content">

                            <div id="tab1-4" class="tab-pane active">
                                <h5>First Name:&nbsp;&nbsp;<strong><?php echo $first_name; ?></strong></h5>
                                <p></p>
                                <h5>Last Name:&nbsp;&nbsp;<strong><?php echo $last_name; ?></strong></h5>
                                <p></p>
                                <h5>Contact Email:&nbsp;&nbsp;<strong><?php echo $contact_email; ?></strong></h5>
                                <p></p>
                                <h5>Contact Number:&nbsp;&nbsp;<strong><?php echo $contact_number; ?></strong></h5>
                                <p></p>
                                <h5>Contact Address:&nbsp;&nbsp;<strong><?php echo $contact_address; ?></strong></h5>
                                <p></p>

                            </div>
                            <div id="tab2-4" class="tab-pane">
                                <h4>Event Title</h4>
                                <p><?php echo $event_title; ?></p>
                                <h4>Event Date</h4>
                                <p><?php echo $event_datatime; ?></p>
                                <h4>Event Details</h4>
                                <p><?php echo $event_details; ?></p>
                            </div>
                            <div id="tab3-4" class="tab-pane">
                                <h4>Venue Title</h4>
                                <p><?php echo $venue_name; ?></p>   
                                <h4>Venue Address</h4>
                                <p><?php echo $venue_address; ?></p>   
                            </div>
                            <div id="tab4-4" class="tab-pane">
                                <h4>Ticket Details</h4>
                                <p><?php echo $about_ticket; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

        <script type="text/javascript">
            $("#requesteventlist").addClass("active");
            $("#requesteventlist").parent().parent().addClass("active");
            $("#requesteventlist").parent().addClass("in");
        </script>
        <?php include basePath('admin/footer_script.php'); ?>
    </body>

</html>
