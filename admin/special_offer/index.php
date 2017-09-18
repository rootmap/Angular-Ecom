<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
include '../../lib/Zebra_Image.php';

$SO_on_event_id = "";
$SO_on_venue_id = "";
$SO_to_event_id = "";
$SO_to_venue_id = "";
$SO_on_type = "";
$SO_on_amount = "";
$SO_to_type = "";
$SO_to_amount = "";
$SO_status = "inactive";
$SO_created_on = "";
$SO_created_by = "";
$SO_from = "";
$SO_to = "";
$SO_image = "";

// Get Event Data //
$arr = array();
$get_events = "SELECT event_id,event_title FROM events WHERE event_status = 'active' ORDER BY event_id DESC";
$rs = mysqli_query($con, $get_events);
//var_dump($rs);
//exit();
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

// Get Event Data //


if (isset($_POST['SO_on_event_id'])) {
    extract($_POST);
    
     /***************** Offer Image Code start Here *********************** */

    if ($_FILES["SO_image"]["tmp_name"] != '') {

        /*******Renaming the image file******** */

        $ban_image = basename($_FILES['SO_image']['name']);
        $info = pathinfo($ban_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $SO_image = 'Offer-' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $ban_image_source = $_FILES["SO_image"]["tmp_name"];
        /******Renaming the image file******** */

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/SO_image/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/SO_image/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/SO_image/' . $SO_image;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["SO_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/SO_image/' . $SO_image;

        if (!$zebra->resize(400)) {
            zebraImageErrorHandaling($zebra->error);
        }
    }
     /***************** Offer Image Code End Here *********************** */
    
    $SO_on_event_id = validateInput($SO_on_event_id);
    $SO_on_venue_id = validateInput($SO_on_venue_id);
    $SO_on_type = validateInput($SO_on_type);
    $SO_on_amount = validateInput($SO_on_amount);
    $SO_to_event_id = validateInput($SO_to_event_id);
    $SO_to_venue_id = validateInput($SO_to_venue_id);
    $SO_to_type = validateInput($SO_to_type);
    $SO_to_amount = validateInput($SO_to_amount);
    $SO_status = validateInput($SO_status);
    $SO_fromDate = validateInput($SO_from);
    $fromDate = date_create("$SO_fromDate");
    $SO_from = date_format($fromDate, "Y-m-d");
    $SO_toDate = validateInput($SO_to);
    $toDate = date_create("$SO_toDate");
    $SO_to = date_format($toDate, "Y-m-d");
    $SO_created_by = getSession("admin_id");
    $SO_created_on = date("Y-m-d H:i:s");
    $SO_image = mysqli_real_escape_string($con, $SO_image);


    $insertOfferArray = '';
    $insertOfferArray .= ' SO_on_event_id = "' . $SO_on_event_id . '"';
    $insertOfferArray .= ', SO_on_venue_id = "' . $SO_on_venue_id . '"';
    $insertOfferArray .= ', SO_on_type = "' . $SO_on_type . '"';
    $insertOfferArray .= ', SO_on_amount = "' . $SO_on_amount . '"';
    $insertOfferArray .= ', SO_to_type = "' . $SO_to_type . '"';
    $insertOfferArray .= ', SO_to_amount = "' . $SO_to_amount . '"';
    $insertOfferArray .= ', SO_to_event_id = "' . $SO_to_event_id . '"';
    $insertOfferArray .= ', SO_to_venue_id = "' . $SO_to_venue_id . '"';
    $insertOfferArray .= ', SO_from = "' . $SO_from . '"';
    $insertOfferArray .= ', SO_to = "' . $SO_to . '"';
    $insertOfferArray .= ', SO_status = "' . $SO_status . '"';
    $insertOfferArray .= ', SO_created_on = "' . $SO_created_on . '"';
    $insertOfferArray .= ', SO_created_by = "' . $SO_created_by . '"';
    $insertOfferArray .= ', SO_image = "' . $SO_image . '"';


    $run_insert_query = "INSERT INTO event_special_offer SET $insertOfferArray";
    $result = mysqli_query($con, $run_insert_query);
   
    if ($result) {
        $msg = "Event special offer saved successfully";
        $link = "offer_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "run_insert_query error: " . mysqli_error($con);
        } else {
            $err = "run_insert_query query failed.";
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Create Event Special Offer</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="offerCreate" enctype="multipart/form-data">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="offerError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerEvent">Special Offer On Event</label>
                                        <div class="col-md-8">
                                            <select onchange="javascript:generateVenue(this.value);" class="form-control" id="SO_on_event_id" name="SO_on_event_id">
                                                <option value="">Select Event</option>
                                                <option value="0">All Event</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->event_id; ?>"  
                                                        <?php
                                                        if ($at->event_id == $SO_on_event_id) {
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
                                        <label class="col-md-4 control-label" for="offerVenue">Special Offer On Venue</label>
                                        <div class="col-md-8" id="venueSelectBx">
                                            <select class="form-control" id="SO_on_venue_id" name="SO_on_venue_id">
                                                <option value="">Select Venue</option>
                                                <option value="0">Venue All</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerType">Special Offer On Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="SO_on_type" name="SO_on_type">
                                                <option value="0">Select Type</option>
                                                <option value="Price">Price</option>
                                                <option value="Quantity">Quantity</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerType">Special Offer On Amount</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="SO_on_amount" name="SO_on_amount" type="number" min="0"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerToEvent">Special Offer To Event</label>
                                        <div class="col-md-8">
                                            <select onchange="javascript:generateToVenue(this.value);" class="form-control" id="SO_to_event_id" name="SO_to_event_id">
                                                <option value="">Select Event</option>
                                                <option value="0">All Event</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->event_id; ?>"  
                                                        <?php
                                                        if ($at->event_id == $SO_to_event_id) {
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
                                        <label class="col-md-4 control-label" for="offerToVenue">Special Offer To Venue</label>
                                        <div class="col-md-8" id="venueToSelectBx">
                                            <select class="form-control" id="SO_to_venue_id" name="SO_to_venue_id">
                                                <option value="">Select Venue</option>
                                                <option value="0">Venue All</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerType">Special Offer To Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="SO_to_type" name="SO_to_type">
                                                <option value="0">Select Type</option>
                                                <option value="Price">Price</option>
                                                <option value="Quantity">Quantity</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="offerType">Special Offer To Amount</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="SO_to_amount" name="SO_to_amount" type="number" min="0"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="applyFrom">Special Offer From</label>
                                        <div class="col-md-8"><input style="width: 250px;" id="SO_from" name="SO_from"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="applyTo">Special Offer To</label>
                                        <div class="col-md-8"><input style="width: 250px;" id="SO_to" name="SO_to"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Offer Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="SO_image" id="SO_image"/>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateEventSO" name="btnCreateEventSO" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Add Offer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php include basePath('admin/footer.php'); ?>
    </div>

    <script type="text/javascript">
        $("#addoffer").addClass("active");
        $("#addoffer").parent().parent().addClass("active");
        $("#addoffer").parent().addClass("in");
    </script>
    <script>
        $(document).ready(function () {
            $("#SO_from").kendoDatePicker();
        });
        $(document).ready(function () {
            $("#SO_to").kendoDatePicker();
        });
    </script>



    <script>
        function generateVenue(event_id) {
            if (event_id == 0) {
                $('#SO_on_venue_id').prop('disabled', 'disabled');
            } else if (event_id > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo baseUrl(); ?>" + "admin/controller/venue/getVenue.php",
                    data: {
                        event_id: event_id
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.output === "success") {
                            var VenueHtml = '';
                            if (obj.object.length > 0) {
                                VenueHtml += '<select class="form-control" id="SO_on_venue_id" name="SO_on_venue_id">';
                                VenueHtml += '<option value="">Select Venue</option>';
                                VenueHtml += '<option value="0">All Venue</option>';
                                for (var i = 0; i < obj.object.length; i++) {
                                    VenueHtml += '<option value="' + obj.object[i].venue_id + '">' + obj.object[i].venue_title + '</option>';
                                }
                                VenueHtml += '</select>';
                            } else {
                                VenueHtml += '<select class="form-control" id="SO_on_venue_id" name="SO_on_venue_id">';
                                VenueHtml += '<option value="">Select Venue</option>';
                                VenueHtml += '<option value="0">All Venue</option>';
                                VenueHtml += '</select>';
                            }
                            $('#venueSelectBx').html(VenueHtml);
                        } else {
                            alert("Ajax response failed.")
                        }
                    }
                });
            }
        }
    </script>
    <script>
        function generateToVenue(event_id) {
            if (event_id == 0) {
                $('#SO_to_venue_id').prop('disabled', 'disabled');
            } else if (event_id > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo baseUrl(); ?>" + "admin/controller/venue/getVenue.php",
                    data: {
                        event_id: event_id
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.output === "success") {
                            var VenueHtml = '';
                            if (obj.object.length > 0) {
                                VenueHtml += '<select class="form-control" id="SO_to_venue_id" name="SO_to_venue_id">';
                                VenueHtml += '<option value="">Select Venue</option>';
                                VenueHtml += '<option value="0">All Venue</option>';
                                for (var i = 0; i < obj.object.length; i++) {
                                    VenueHtml += '<option value="' + obj.object[i].venue_id + '">' + obj.object[i].venue_title + '</option>';
                                }
                                VenueHtml += '</select>';
                            } else {
                                VenueHtml += '<select class="form-control" id="SO_to_venue_id" name="SO_to_venue_id">';
                                VenueHtml += '<option value="">Select Venue</option>';
                                VenueHtml += '<option value="0">All Venue</option>';
                                VenueHtml += '</select>';
                            }
                            $('#venueToSelectBx').html(VenueHtml);
                        } else {
                            alert("Ajax response failed.")
                        }
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateEventSO").click(function () {
                var SO_on_event_id = $("#SO_on_event_id").val();
                var SO_on_venue_id = $("#SO_on_venue_id").val();
                var SO_to_event_id = $("#SO_to_event_id").val();
                var SO_to_venue_id = $("#SO_to_venue_id").val();
                var SO_on_type = $("#SO_on_type").val();
                var SO_to_type = $("#SO_to_type").val();
                var SO_to_amount = $("#SO_to_amount").val();
                var SO_on_amount = $("#SO_on_amount").val();

                var SO_from = $("#SO_from").val();
                var fromDate = SO_from.split("/");
                //alert(SO_from);exit();
//                var fromDate = new Date(SO_from);
//                var SO_fromDate = fromDate.toString("yyyyMMdd");
                //alert(fromDate[0]+fromDate[1]+fromDate[2]);exit();

                var SO_to = $("#SO_to").val();
                var toDate = new Date(SO_to);
                var SO_ToDate = toDate.toString("yyyyMMdd");
                

                if (SO_on_event_id === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special offer on event</em></strong></div>');
                } else if (SO_on_event_id > 0 && SO_on_venue_id == "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special offer on venue</em></strong></div>');
                } else if (SO_on_type === '0') {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special event offer on type</em></strong></div>');
                } else if (SO_on_amount === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special event offer on amount</em></strong></div>');
                } else if (SO_to_event_id === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special offer to event</em></strong></div>');
                } else if (SO_to_event_id > 0 && SO_to_venue_id == "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special offer to venue</em></strong></div>');
                } else if (SO_to_type === '0') {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special event offer to type</em></strong></div>');
                } else if (SO_to_amount === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select special event offer to amount</em></strong></div>');
                } else if (SO_from === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter special offer from date</em></strong></div>');
                } else if (SO_to === "") {
                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter special offer to date</em></strong></div>');
                } 
//                else if (SO_fromDate > SO_ToDate) {
//                    $("#offerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Invalid special offer date combination</em></strong></div>');
//                } 
                else {
                    $("#offerCreate").submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $("#offerlist").addClass("active");
        $("#offerlist").parent().parent().addClass("active");
        $("#offerlist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>