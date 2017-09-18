
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
if (isset($_GET["venue_id"])) {
    $venue_id = $_GET['venue_id'];
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
$venue_status = "";
$venue_updated_by = "";
$venue_closing_message = "";

if (isset($_POST['venue_title'])) {
    extract($_POST);
    if (!$is_one_day_event OR $is_one_day_event != "yes") {
        $is_one_day_event = 'no';
    }
    if (!$venue_status OR $venue_status != "active") {
        $venue_status = 'inactive';
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

    $venue_updated_by = getSession("admin_id");
    $venue_status = mysqli_real_escape_string($con, $venue_status);

    $update_VenueArray = '';
    $update_VenueArray .= ' venue_event_id = "' . $venue_event_id . '"';
    $update_VenueArray .= ', venue_title = "' . $venue_title . '"';
    $update_VenueArray .= ', venue_description = "' . $venue_description . '"';
    $update_VenueArray .= ', venue_address = "' . $venue_address . '"';
    $update_VenueArray .= ', venue_valid_from = "' . $venue_valid_from . '"';
    $update_VenueArray .= ', venue_valid_till = "' . $venue_valid_till . '"';
    $update_VenueArray .= ', venue_start_date = "' . $venue_start_date . '"';
    $update_VenueArray .= ', venue_end_date = "' . $venue_end_date . '"';
    $update_VenueArray .= ', venue_start_time = "' . $venue_start_time . '"';
    $update_VenueArray .= ', venue_end_time = "' . $venue_end_time . '"';
    $update_VenueArray .= ', venue_geo_location = "' . $venue_geo_location . '"';
    $update_VenueArray .= ', venue_status = "' . $venue_status . '"';
    $update_VenueArray .= ', venue_updated_by = "' . $venue_updated_by . '"';
    $update_VenueArray .= ', venue_closing_message = "' . $venue_closing_message . '"';

    $run_update_query = "UPDATE event_venues SET $update_VenueArray WHERE venue_id = $venue_id";
    $result = mysqli_query($con, $run_update_query);
    //debug($run_update_query);exit();
    if (!$result) {
        if (DEBUG) {
            $err = "run_update_query error: " . mysqli_error($con);
        } else {
            $err = "run_update_query query failed.";
        }
    } else {
        $msg = "Venue updated successfully";
        $link = "event_venue_list.php?msg=" . base64_encode($msg) . "&event_id=" . $venue_event_id;
        redirect($link);
    }
}

//$arr = array();
$venue_query = "select event_venues.*, events.* from event_venues left join events on event_venues.venue_event_id = events.event_id where event_venues.venue_id = '$venue_id'";
$venue_result = mysqli_query($con, $venue_query);

$count_venue = mysqli_num_rows($venue_result);
if ($count_venue > 0) {
    while ($row = mysqli_fetch_object($venue_result)) {
        $venue_title = $row->venue_title;
        $venue_address = $row->venue_address;
        $venue_event_id = $row->venue_event_id;
        $venue_description = $row->venue_description;
        $venue_valid_from = $row->venue_valid_from;
        $venue_valid_till = $row->venue_valid_till;
        $venue_start_date = $row->venue_start_date;
        $venue_end_date = $row->venue_end_date;
        $venue_start_time = $row->venue_start_time;
        $venue_end_time = $row->venue_end_time;
        $venue_geo_location = $row->venue_geo_location;
        $venue_status = $row->venue_status;
        $venue_closing_message = $row->venue_closing_message;
    }
}

$geo = explode(',', $venue_geo_location);
$lat = $geo[0];
$long = $geo[1];

$venue_valid_from = date("m/d/Y", strtotime($venue_valid_from));
$venue_valid_till = date("m/d/Y", strtotime($venue_valid_till));
$venue_start_date = date("m/d/Y", strtotime($venue_start_date));
if ($venue_end_date == "0000-00-00") {
    $venue_end_date = "";
} else {
    $venue_end_date = date("m/d/Y", strtotime($venue_end_date));
}
$venue_start_time = date("h:i A", strtotime($venue_start_time));
$venue_end_time = date("h:i A", strtotime($venue_end_time));

//while($obj = mysqli_fetch_object($venue_result)){
//    $arr[] = $obj;
//}
//debug($arr);exit();
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Edit Venue</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="venueUpdate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="venueError"></div>
                                    </div>

                                    <input class="form-control" id="venue_event_id" name="venue_event_id" value="<?php echo $venue_event_id; ?>" type="hidden"/>
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
                                        <div class="col-md-8"><input  id="venue_valid_from" name="venue_valid_from" value="<?php echo $venue_valid_from; ?>"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Booking End Date</label>
                                        <div class="col-md-8"><input  id="venue_valid_till" name="venue_valid_till" value="<?php echo $venue_valid_till; ?>"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;" for="">is one day event?</label>
                                        <div class="col-md-8">
                                            <input onchange="javascript:showEventEndDate();" type="checkbox" name="is_one_day_event" id="is_one_day_event" value="yes" <?php
                                            if ($is_one_day_event == 'yes' OR $venue_end_date == "0000-00-00" OR $venue_end_date == "") {
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
                                            <span id="showEndDate" <?php
                                            if ($is_one_day_event == 'yes' OR $venue_end_date == "0000-00-00" OR $venue_end_date == "") {
                                                echo 'style="display:none"';
                                            }
                                            ?>>
                                                <label class="col-md-4 control-label" for="">Venue End Date</label>
                                                <div class="col-md-8"><input  id="venue_end_date" name="venue_end_date" value="<?php echo $venue_end_date; ?>"/></div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="">Venue End Time</label>
                                        <div class="col-md-8">
                                            <input id="venue_end_time" name="venue_end_time" value="<?php echo $venue_end_time; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueAddress">Venue Description</label>
                                        <div class="col-md-8">
                                            <textarea id="venue_description" name="venue_description" rows="3" cols="30"><?php echo html_entity_decode($venue_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Is Venue Active ?</label>
                                        <div class="col-md-8">
                                            <input type="checkbox" name="venue_status" id="venue_status" value="active" <?php
                                            if ($venue_status == 'active') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnUpdateVenue" name="btnUpdateVenue" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Venue</button>
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
            $("#btnUpdateVenue").click(function () {
                var venue_title = $("#venue_title").val();
                var venue_address = $("#venue_address").val();
                var lat = $("#lat").val();
                var long = $("#long").val();
                
                var venue_valid_from = $("#venue_valid_from").data("kendoDatePicker").value();
                var venue_valid_till = $("#venue_valid_till").data("kendoDatePicker").value();
                var diff = Math.round((venue_valid_till - venue_valid_from) / 1000 / 60 / 60 / 24);
                var venue_start_date = $("#venue_start_date").data("kendoDatePicker").value();
                var venue_end_date = $("#venue_end_date").data("kendoDatePicker").value();

//                var venue_valid_from = $("#venue_valid_from").val();
//                var startmydate = new Date(venue_valid_from);
//                var venue_valid_start = startmydate.toString("yyyyMMdd");


//                var venue_valid_till = $("#venue_valid_till").val();
//                var endmydate = new Date(venue_valid_till);
//                var venue_valid_end = endmydate.toString("yyyyMMdd");

//                var venue_start_date = $("#venue_start_date").val();
//                var venueSdate = new Date(venue_start_date);
//                var venuestartDate = venueSdate.toString("yyyyMMdd");


//                var venue_end_date = $("#venue_end_date").val();
//                var venueEdate = new Date(venue_end_date);
//                var venueendDate = venueEdate.toString("yyyyMMdd");


                var venue_start_time = $("#venue_start_time").val();
                var is_one_day_event = $("input[name='is_one_day_event']:checked").val();
                var oneDayEvent = "no";
                if (typeof is_one_day_event === "string" && is_one_day_event === "yes") {
                    oneDayEvent = is_one_day_event;
                }

                if (venue_title === "") {
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
                            $("#venueUpdate").submit();
                        }
                    }
                }
                else if (oneDayEvent == "yes") {
                    $("#venueUpdate").submit();
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