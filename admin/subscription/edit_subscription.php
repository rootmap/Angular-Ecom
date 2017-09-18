<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

if (isset($_GET["subscription_id"])) {
    $subscription_id = $_GET["subscription_id"];
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
$subscription_updated_by = "";


if (isset($_POST['subscription_event_id'])) {
    extract($_POST);

    $subscription_event_id = intval($subscription_event_id);
    $subscription_min_amount = floatval($subscription_min_amount);
    $subscription_desc = mysqli_real_escape_string($con, $subscription_desc);
    $subscription_updated_by = getSession("admin_id");


    $check_EventID = "select * from event_subscription where subscription_event_id = '$subscription_event_id' AND subscription_id NOT IN (" . $subscription_id . ") ";
    $check_EventIDRun = mysqli_query($con, $check_EventID);
    $countEvent = mysqli_num_rows($check_EventIDRun);
    if ($countEvent >= 1) {
        $err = "Subscription already added for this event";
    } else {
        $updateSubscriptionArray = '';
        $updateSubscriptionArray .= ' subscription_event_id  = "' . $subscription_event_id . '"';
        $updateSubscriptionArray .= ', subscription_min_amount = "' . $subscription_min_amount . '"';
        $updateSubscriptionArray .= ', subscription_desc = "' . $subscription_desc . '"';
        $updateSubscriptionArray .= ', subscription_updated_by = "' . $subscription_updated_by . '"';

        $run_update_query = "UPDATE event_subscription SET $updateSubscriptionArray WHERE subscription_id = $subscription_id";
        $result = mysqli_query($con, $run_update_query);

        if ($result) {

            $msg = "Subscription updated successfully";
            $link = "subscription_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "updateSubscriptionArray error: " . mysqli_error($con);
            } else {
                $err = "updateSubscriptionArray query failed.";
            }
        }
    }
}

$get_subscription_sql = "SELECT event_subscription.*, events.event_title, `events`.event_id FROM event_subscription LEFT JOIN events ON event_subscription.subscription_event_id = `events`.event_id WHERE event_subscription.subscription_id = $subscription_id";
$get_result = mysqli_query($con, $get_subscription_sql);
if ($get_result) {
    $count_sub = mysqli_num_rows($get_result);
    if ($count_sub > 0) {
        while ($row = mysqli_fetch_object($get_result)) {
            $subscription_event_id = $row->subscription_event_id;
            $subscription_desc = $row->subscription_desc;
            $subscription_min_amount = $row->subscription_min_amount;
        }
    }
} else {
    if (DEBUG) {
        $err = "get_result error: " . mysqli_error($con);
    } else {
        $err = "get_result query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Edit Subscription</h3>

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
                                <button type="button"  id="btnCreateSubscription" name="btnCreateSubscription" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Subscription</button>
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

