<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$arr = array();
$get_events = "SELECT event_id,event_title FROM events";
$rs = mysqli_query($con, $get_events);
if ($rs) {
    while ($obj = mysqli_fetch_object($rs)) {
        $arr[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "get_events error: " . mysqli_error($con);
    } else {
        $err = "get_events query failed.";
    }
}

$subscription_event_id = "";
$subscription_desc = "";
$subscription_min_amount = "";
$subscription_created_on = "";
$subscription_created_by = "";


if (isset($_POST['subscription_event_id'])) {
    extract($_POST);

    $subscription_event_id = intval($subscription_event_id);
    $subscription_min_amount = floatval($subscription_min_amount);
    $subscription_desc = mysqli_real_escape_string($con, $subscription_desc);
    $subscription_created_by = getSession("admin_id");
    $subscription_created_on = date("Y-m-d H:i:s");



    $check_EventID = "select * from event_subscription where subscription_event_id = $subscription_event_id";
    $check_EventIDRun = mysqli_query($con, $check_EventID);
    $countEvent = mysqli_num_rows($check_EventIDRun);
    if ($countEvent >= 1) {
        $err = "Subscription already added for this event";
    } else {

        $insertSubscriptionArray = '';
        $insertSubscriptionArray .= ' subscription_event_id  = "' . $subscription_event_id . '"';
        $insertSubscriptionArray .= ', subscription_min_amount = "' . $subscription_min_amount . '"';
        $insertSubscriptionArray .= ', subscription_desc = "' . $subscription_desc . '"';
        $insertSubscriptionArray .= ', subscription_created_by = "' . $subscription_created_by . '"';
        $insertSubscriptionArray .= ', subscription_created_on = "' . $subscription_created_on . '"';


        $runSubscriptionArray = "INSERT INTO event_subscription SET $insertSubscriptionArray";
        $result = mysqli_query($con, $runSubscriptionArray);

        if ($result) {
            $sub_id = mysqli_insert_id($con);


            $getEventID = "select subscription_event_id from event_subscription where subscription_id = $sub_id";
            $eventIDResult = mysqli_query($con, $getEventID);
            $countID = mysqli_num_rows($eventIDResult);
            if ($countID > 0) {
                while ($row = mysqli_fetch_object($eventIDResult)) {
                    $event_id = $row->subscription_event_id;
                }
            }

            $sqlEventTitle = "select event_title from events where event_id = $event_id";
            $getEventTitle = mysqli_query($con, $sqlEventTitle);
            $countTitle = mysqli_num_rows($getEventTitle);
            if ($countTitle > 0) {
                while ($row = mysqli_fetch_object($getEventTitle)) {
                    $event_title = $row->event_title;
                }
            }

            $msg = "Subscription added successfully for " . $event_title;
            $link = "subscription_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "runSubscriptionArray error: " . mysqli_error($con);
            } else {
                $err = "runSubscriptionArray query failed.";
            }
        }
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
        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Add New Subscription</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="subCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="subError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="eventTitle">Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="subscription_event_id" name="subscription_event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->event_id; ?>"  
                                                        <?php
                                                        if ($at->event_id == $subscription_event_id) {
                                                            echo ' selected="selected"';
                                                        }
                                                        ?>>
                                                            <?php echo $at->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="minAmount">Subscription Amount</label>
                                        <div class="col-md-8"><input class="form-control" id="subscription_min_amount" name="subscription_min_amount" min="0" value="<?php echo $subscription_min_amount; ?>" type="number"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueAddress">Subscription Description</label>
                                        <div class="col-md-8">
                                            <textarea id="subscription_desc" name="subscription_desc" rows="3" cols="30"><?php echo html_entity_decode($subscription_desc, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateSubscription" name="btnCreateSubscription" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Add Subscription</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script>
        $(document).ready(function () {
            $("#subscription_desc").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $("#sub").addClass("active");
        $("#sub").parent().parent().addClass("active");
        $("#sub").parent().addClass("in");
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateSubscription").click(function () {
                var subscription_event_id = $("#subscription_event_id").val();
                var subscription_min_amount = $("#subscription_min_amount").val();

                if (subscription_event_id === '0') {
                    $("#subError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select event title</em></strong></div>');
                } else if (subscription_min_amount === "") {
                    $("#subError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Subscription amount required</em></strong></div>');
                } else {
                    $("#subCreate").submit();
                }

            });
        });

    </script>
    <script type="text/javascript">
        $("#sublist").addClass("active");
        $("#sublist").parent().parent().addClass("active");
        $("#sublist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
