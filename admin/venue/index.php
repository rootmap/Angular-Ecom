<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$arr = array();
$get_events = "SELECT event_id,event_title FROM events WHERE event_status='active'";
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


$venue_event_id = "";
$venue_title = "";
$venue_address = "";
$venue_valid_from = "";
$venue_valid_till = "";
$venue_start_date = "";
$venue_end_date = "";
$venue_start_time = "";
$venue_end_time = "";
$venue_geo_location = "";
$venue_description = "";
$is_one_day_event = "";
$lat = "";
$long = "";
$venue_closing_message = "";


if (isset($_POST['venue_title'])) {
    extract($_POST);

    if (!$is_one_day_event OR $is_one_day_event != "yes") {
        $is_one_day_event = 'no';
    }

    $venue_event_id = mysqli_real_escape_string($con, $venue_event_id);
    $venue_title = mysqli_real_escape_string($con, $venue_title);
    $venue_address = mysqli_real_escape_string($con, $venue_address);
    $venue_description = mysqli_real_escape_string($con, $venue_description);
    $venue_closing_message = mysqli_real_escape_string($con, $venue_closing_message);
    $lat = mysqli_real_escape_string($con, $lat);
    $long = mysqli_real_escape_string($con, $long);
    $venue_geo_location = $lat . "," . $long;

    $venue_valid_from_date = mysqli_real_escape_string($con, $venue_valid_from);
    $from_date = date_create($venue_valid_from_date);
    $venue_valid_from = date_format($from_date, "Y-m-d");

    $venue_valid_till_date = mysqli_real_escape_string($con, $venue_valid_till);
    $till_date = date_create($venue_valid_till_date);
    $venue_valid_till = date_format($till_date, "Y-m-d");

    $venue_start = mysqli_real_escape_string($con, $venue_start_date);
    $start_date = date_create($venue_start);
    $venue_start_date = date_format($start_date, "Y-m-d");

    if ($is_one_day_event == 'yes') {
        $venue_end_date = "";
    } else {
        $venue_end = mysqli_real_escape_string($con, $venue_end_date);
        $end_date = date_create($venue_end);
        $venue_end_date = date_format($end_date, "Y-m-d");
    }

    $start_time = mysqli_real_escape_string($con, $venue_start_time);
    $venue_start_time = date("G:i:a", strtotime($start_time));

    $end_time = mysqli_real_escape_string($con, $venue_end_time);
    $venue_end_time = date("G:i:a", strtotime($end_time));

    $venue_created_by = getSession("admin_id");
    $venue_created_on = date("Y-m-d H:i:s");
    $venue_status = "inactive";

    $insert_VenueArray = '';
    $insert_VenueArray .= ' venue_event_id = "' . $venue_event_id . '"';
    $insert_VenueArray .= ', venue_title = "' . $venue_title . '"';
    $insert_VenueArray .= ', venue_description = "' . $venue_description . '"';
    $insert_VenueArray .= ', venue_address = "' . $venue_address . '"';
    $insert_VenueArray .= ', venue_valid_from = "' . $venue_valid_from . '"';
    $insert_VenueArray .= ', venue_valid_till = "' . $venue_valid_till . '"';
    $insert_VenueArray .= ', venue_start_date = "' . $venue_start_date . '"';
    $insert_VenueArray .= ', venue_end_date = "' . $venue_end_date . '"';
    $insert_VenueArray .= ', venue_start_time = "' . $venue_start_time . '"';
    $insert_VenueArray .= ', venue_end_time = "' . $venue_end_time . '"';
    $insert_VenueArray .= ', venue_geo_location = "' . $venue_geo_location . '"';
    $insert_VenueArray .= ', venue_status = "' . $venue_status . '"';
    $insert_VenueArray .= ', venue_created_by = "' . $venue_created_by . '"';
    $insert_VenueArray .= ', venue_created_on = "' . $venue_created_on . '"';
    $insert_VenueArray .= ', venue_closing_message = "' . $venue_closing_message . '"';

    $run_insert_query = "INSERT INTO event_venues SET $insert_VenueArray";
    $result = mysqli_query($con, $run_insert_query);
    if (!$result) {
        if (DEBUG) {
            $err = "run_insert_query` error: " . mysqli_error($con);
        } else {
            $err = "run_insert_query query failed.";
        }
    } else {
        $msg = "Venue saved successfully";
        $link = "event_venue_list.php?msg=" . base64_encode($msg) . "&event_id=" . $venue_event_id;
        redirect($link);
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
        <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
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
            <h3 class="bg-white content-heading border-bottom strong">Add New Venue</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="venueCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="venueError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="venue_event_id" name="venue_event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->event_id; ?>"  
                                                        <?php
                                                        if ($at->event_id == $venue_event_id) {
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
                                        <label class="col-md-4 control-label" for="venueTitle">Venue Name</label>
                                        <div class="col-md-8"><input class="form-control" id="venue_title" name="venue_title" value="<?php echo $venue_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueAddress">Venue Address</label>
                                        <div class="col-md-8">
                                            <textarea name="venue_address" id="venue_address" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $venue_address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueAddress">Venue Closing Message</label>
                                        <div class="col-md-8">
                                            <textarea name="venue_closing_message" id="venue_closing_message" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $venue_closing_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="latitude">Latitude</label>
                                        <div class="col-md-8"><input class="form-control" id="lat" name="lat" min="1" value="<?php echo $lat; ?>" type="number"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="longitude">Longitude</label>
                                        <div class="col-md-8"><input class="form-control" id="long" name="long" min="1" value="<?php echo $long; ?>" type="number"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Booking Start Date</label>
                                        <div class="col-md-7"><input  id="venue_valid_from" name="venue_valid_from" value="<?php echo $venue_valid_from; ?>"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Booking End Date</label>
                                        <div class="col-md-7"><input  id="venue_valid_till" name="venue_valid_till" value="<?php echo $venue_valid_till; ?>"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;" for="">is one day event?</label>
                                        <div class="col-md-7">
                                            <input onchange="javascript:showEventEndDate();" type="checkbox" name="is_one_day_event" id="is_one_day_event" value="yes" <?php
                                            if ($is_one_day_event == 'yes') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Venue Start Date</label>
                                        <div class="col-md-8">
                                            <input id="venue_start_date" name="venue_start_date" value="<?php echo $venue_start_date; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Venue Start Time</label>
                                        <div class="col-md-8">
                                            <input id="venue_start_time" name="venue_start_time" value="<?php echo $venue_start_time; ?>"/>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-group">
                                            <span id="showEndDate">
                                                <label class="col-md-4 control-label" for="">Venue End Date</label>
                                                <div class="col-md-6"><input  id="venue_end_date" name="venue_end_date" value="<?php echo $venue_end_date; ?>"/></div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Venue End Time</label>
                                        <div class="col-md-7">
                                            <input id="venue_end_time" name="venue_end_time" value="<?php echo $venue_end_time; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueAddress">Venue Description</label>
                                        <div class="col-md-8">
                                            <textarea id="venue_description" name="venue_description" rows="3" cols="30"><?php echo html_entity_decode($venue_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateVenue" name="btnCreateVenue" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Venue</button>
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
            $("#venue_description").kendoEditor({
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
    <script>
        $(document).ready(function () {
            $("#venue_valid_from").kendoDatePicker();
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#venue_start_date").kendoDatePicker();
        });

    </script>
    <script>
        $(document).ready(function () {
            $("#venue_valid_till").kendoDatePicker();
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#venue_start_time").kendoTimePicker({
                format: "hh:mm tt"

            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#venue_end_date").kendoDatePicker();
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#venue_end_time").kendoTimePicker({
                format: "hh:mm tt"

            });
        });
    </script>


    <script type="text/javascript">
        function showEventEndDate() {
            if ($('input[name="is_one_day_event"]:checked').length > 0) {
                $("#showEndDate").fadeOut();
            } else {
                $("#showEndDate").fadeIn();
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateVenue").click(function () {
                var venue_event_id = $("#venue_event_id").val();
                var venue_title = $("#venue_title").val();
                var venue_address = $("#venue_address").val();
                var lat = $("#lat").val();
                var long = $("#long").val();
                var venue_valid_from = $("#venue_valid_from").data("kendoDatePicker").value();
                //alert(venue_valid_from);
                var venue_valid_till = $("#venue_valid_till").data("kendoDatePicker").value();
                // alert(venue_valid_till);
                var diff = Math.round((venue_valid_till - venue_valid_from) / 1000 / 60 / 60 / 24);
                //alert(diff);
//                var venue_valid_from = $("#venue_valid_from").val();
//                var startmydate = new Date(venue_valid_from);
//                var venue_valid_start = startmydate.toString("yyyyMMdd");


//                var venue_valid_till = $("#venue_valid_till").val();
//                var endmydate = new Date(venue_valid_till);
//                var venue_valid_end = endmydate.toString("yyyyMMdd");

                var venue_start_date = $("#venue_start_date").data("kendoDatePicker").value();
                // alert(venue_start_date);
//                var venueSdate = new Date(venue_start_date);
//                var venuestartDate = venueSdate.toString("yyyyMMdd");


                var venue_end_date = $("#venue_end_date").data("kendoDatePicker").value();
                // alert(venue_end_date);

//                var venueEdate = new Date(venue_end_date);
//                var venueendDate = venueEdate.toString("yyyyMMdd");


                var venue_start_time = $("#venue_start_time").val();

                var is_one_day_event = $("input[name='is_one_day_event']:checked").val();
                var oneDayEvent = "no";
                if (typeof is_one_day_event === "string" && is_one_day_event === "yes") {
                    oneDayEvent = is_one_day_event;
                }
                if (venue_event_id === '0') {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select event title for venue</em></strong></div>');
                } else if (venue_title === "") {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Venue name required</em></strong></div>');
                } else if (venue_address === "") {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Venue address required</em></strong></div>');
                } else if (lat === "") {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Venue latitude required</em></strong></div>');
                } else if (long === "") {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Venue longitude required</em></strong></div>');
                } else if (venue_valid_from === "" || venue_valid_from === null) {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Choose venue booking start date</em></strong></div>');
                } else if (venue_valid_till === "" || venue_valid_till === null) {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Choose venue booking end date</em></strong></div>');
                } else if (diff < 0) {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Choose another venue booking end date</em></strong></div>');
                } else if (venue_start_date === "" || venue_start_date === null) {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Start date required</em></strong></div>');
                } else if (venue_start_time === "") {
                    $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Start time required</em></strong></div>');
                } else if (oneDayEvent == "no") {
                    if (venue_end_date === "" || venue_end_date === null) {
                        $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>End date required</em></strong></div>');
                    } else {
                        var diff_date = Math.round((venue_end_date - venue_start_date) / 1000 / 60 / 60 / 24);
                        if (diff_date < 0) {
                            $("#venueError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Choose another venue end date</em></strong></div>');
                        } else {
                            $("#venueError").html('');
                            $("#venueCreate").submit();
                        }
                    }
                }
                else if (oneDayEvent == "yes") {
                    $("#venueCreate").submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $("#venlist").addClass("active");
        $("#venlist").parent().parent().addClass("active");
        $("#venlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>