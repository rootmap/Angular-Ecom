
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$arr = array();
$get_venues = "SELECT venue_id,venue_title FROM event_venues order by venue_id desc";
$rs = mysqli_query($con, $get_venues);
if ($rs) {
    while ($obj = mysqli_fetch_object($rs)) {
        $arr[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "get_venues error: " . mysqli_error($con);
    } else {
        $err = "get_venues query failed.";
    }
}
// Get all events
$arrEvent = array();
$getEvents = "SELECT event_id,event_title FROM events WHERE event_status = 'active' order by event_id desc";
$resultEvent = mysqli_query($con, $getEvents);
if ($resultEvent) {
    while ($objEvent = mysqli_fetch_object($resultEvent)) {
        $arrEvent[] = $objEvent;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

//debug($arrEvent);exit();

$TT_venue_id = "";
$TT_event_id = "";
$TT_type_title = "";
$TT_type_description = "";
$TT_current_price = "";
$TT_old_price = "";
$TT_per_user_limit = "";
$TT_late_fee = "";
$TT_late_fee_apply_from = "";
$TT_ticket_quantity = "";
$TT_created_on = "";
$TT_created_by = "";
$is_late_fee = "";
$TT_status = "";
$TT_is_preorder = "";


if (isset($_POST['TT_type_title'])) {
    extract($_POST);


    if (!$is_late_fee OR $is_late_fee != "yes") {
        $is_late_fee = 'no';
    }
    if(!$TT_is_preorder OR $TT_is_preorder != "yes"){
        $TT_is_preorder = "no";
    }
    $TT_venue_id = mysqli_real_escape_string($con, $TT_venue_id);
    $TT_event_id = mysqli_real_escape_string($con, $TT_event_id);
    $TT_type_title = mysqli_real_escape_string($con, $TT_type_title);
    $TT_type_description = mysqli_real_escape_string($con, $TT_type_description);
    $TT_old_price = mysqli_real_escape_string($con, $TT_old_price);
    $TT_ticket_quantity = mysqli_real_escape_string($con, $TT_ticket_quantity);
    $TT_per_user_limit = mysqli_real_escape_string($con, $TT_per_user_limit);
    $TT_late_fee = mysqli_real_escape_string($con, $TT_late_fee);
    $TT_late_fee_apply_from = mysqli_real_escape_string($con, $TT_late_fee_apply_from);
    $TT_is_preorder = mysqli_real_escape_string($con, $TT_is_preorder);
    
    if($TT_is_preorder == "yes"){
        $TT_current_price = 0;
    }else{
        $TT_current_price = mysqli_real_escape_string($con, $TT_current_price);
    }

    if ($is_late_fee == 'no') {
        $TT_late_fee = "";
        $TT_late_fee_apply_from = "";
    } else {
        $apply_from = mysqli_real_escape_string($con, $TT_late_fee_apply_from);
        $apply_date = date_create("$apply_from");
        $TT_late_fee_apply_from = date_format($apply_date, "Y-m-d");
    }

    $TT_created_by = getSession("admin_id");
    $TT_created_on = date("Y-m-d H:i:s");
    $TT_status = "inactive";

    $insertTicketArray = '';
    $insertTicketArray .= ' TT_venue_id = "' . $TT_venue_id . '"';
    $insertTicketArray .= ', TT_event_id = "' . $TT_event_id . '"';
    $insertTicketArray .= ', TT_type_title = "' . $TT_type_title . '"';
    $insertTicketArray .= ', TT_type_description = "' . $TT_type_description . '"';
    $insertTicketArray .= ', TT_current_price = "' . $TT_current_price . '"';
    $insertTicketArray .= ', TT_old_price = "' . $TT_old_price . '"';
    $insertTicketArray .= ', TT_per_user_limit = "' . $TT_per_user_limit . '"';
    $insertTicketArray .= ', TT_late_fee = "' . $TT_late_fee . '"';
    $insertTicketArray .= ', TT_late_fee_apply_from = "' . $TT_late_fee_apply_from . '"';
    $insertTicketArray .= ', TT_ticket_quantity = "' . $TT_ticket_quantity . '"';
    $insertTicketArray .= ', TT_created_on = "' . $TT_created_on . '"';
    $insertTicketArray .= ', TT_created_by = "' . $TT_created_by . '"';
    $insertTicketArray .= ', TT_status = "' . $TT_status . '"';
    $insertTicketArray .= ', TT_is_preorder = "' . $TT_is_preorder . '"';

    $run_insert_query = "INSERT INTO event_ticket_types SET $insertTicketArray";
    $result = mysqli_query($con, $run_insert_query);
    if (!$result) {
        $err = mysqli_error($con);
    } else {
        $msg = "Ticket Type saved successfully";
        $link = "venue_ticket_list.php?msg=" . base64_encode($msg) . "&venue_id=" . $TT_venue_id . "&event_id=" . $TT_event_id;
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Ticket Type </h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="ticketCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="ticketError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Event Title</label>
                                        <div class="col-md-8">
                                            <select onchange="javascript:generateVenue(this.value);" class="form-control" id="TT_event_id" name="TT_event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arrEvent) >= 1): ?>
                                                    <?php foreach ($arrEvent as $Event): ?>
                                                        <option value="<?php echo $Event->event_id; ?>"  
                                                        <?php
                                                        if ($Event->event_id == $TT_event_id) {
                                                            echo ' selected="selected"';
                                                        }
                                                        ?>>
                                                            <?php echo $Event->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Venue Name</label>
                                        <div class="col-md-8" id="venueSelectBox">
                                            <select class="form-control" id="TT_venue_id" name="TT_venue_id">
                                                <option value="0">Select Venue</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="ticketTypeTitle">Ticket Type Name</label>
                                        <div class="col-md-8"><input class="form-control" id="TT_type_title" name="TT_type_title" value="<?php echo $TT_type_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="descriptionTT">Description</label>
                                        <div class="col-md-8">
                                            <textarea id="TT_type_description" name="TT_type_description" rows="3" cols="30"><?php echo html_entity_decode($TT_type_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;" for="userLimit">is preorder?</label>
                                        <div class="col-md-8">
                                            <input onchange="javascript:showPriceDiv();" type="checkbox" id="TT_is_preorder" name="TT_is_preorder" value="yes" <?php
                                            if ($TT_is_preorder == 'yes') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div>
                                    </div>
                                    <div id="showPrice">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="currentPrice">Current Price</label>
                                            <div class="col-md-8">
                                                <input style="width: 200px;" class="form-control" id="TT_current_price" name="TT_current_price" min="1" value="<?php echo $TT_current_price; ?>" type="number"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="oldPrice">Old Price</label>
                                            <div class="col-md-8"><input style="width: 200px;"  class="form-control" id="TT_old_price" name="TT_old_price" min="1" value="<?php echo $TT_old_price; ?>" type="number"/></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="ticketQty">Ticket Quantity</label>
                                        <div class="col-md-8"><input style="width: 200px;"  class="form-control" id="TT_ticket_quantity" name="TT_ticket_quantity" min="1" value="<?php echo $TT_ticket_quantity; ?>" type="number"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="userLimit">User Limit</label>
                                        <div class="col-md-8"><input style="width: 200px;" class="form-control" id="TT_per_user_limit" name="TT_per_user_limit" min="1" value="<?php echo $TT_per_user_limit; ?>" type="number"/></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;" for="userLimit">is late fee applicable?</label>
                                        <div class="col-md-8"><input onchange="javascript:showLateFeeDiv();" type="checkbox" name="is_late_fee" id="is_late_fee" value="yes" <?php
                                            if ($is_late_fee == 'yes') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div>
                                    </div>


                                    <div style="display: none;" id="showDiv">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="lateFee">Late Fee</label>
                                            <div class="col-md-8"><input style="width: 200px;" class="form-control" id="TT_late_fee" name="TT_late_fee" min="1" value="<?php echo $TT_late_fee; ?>" type="number"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="applyFrom">Apply From</label>
                                            <div class="col-md-8"><input style="width: 200px;" id="TT_late_fee_apply_from" name="TT_late_fee_apply_from" value="<?php echo $TT_late_fee_apply_from; ?>"/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateTicket" name="btnCreateTicket" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Ticket</button>
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

    </div>
    <script>
        $(document).ready(function () {
            $("#TT_type_description").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });</script>
    <script type="text/javascript">
        function showLateFeeDiv() {
            if ($('input[name="is_late_fee"]:checked').length > 0) {
                $("#showDiv").fadeIn();
            } else {
                $("#showDiv").fadeOut();
            }
        }
        function showPriceDiv() {
            if ($('input[name="TT_is_preorder"]:checked').length > 0) {

                $("#showPrice").fadeOut();
            } else {
                $("#showPrice").fadeIn();
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $("#TT_late_fee_apply_from").kendoDatePicker();
        });
    </script>
    <script>
        function generateVenue(event_id) {
            if (event_id == 0) {
                $('#TT_venue_id').prop('disabled', 'disabled');
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
                                VenueHtml += '<select class="form-control" id="TT_venue_id" name="TT_venue_id">';
                                VenueHtml += '<option value="0">Select Venue</option>';
                                for (var i = 0; i < obj.object.length; i++) {
                                    VenueHtml += '<option value="' + obj.object[i].venue_id + '">' + obj.object[i].venue_title + '</option>';
                                }
                                VenueHtml += '</select>';
                            } else {
                                VenueHtml += '<select class="form-control" id="TT_venue_id" name="TT_venue_id">';
                                VenueHtml += '<option value="0">Select Venue</option>';
                                VenueHtml += '</select>';
                            }
                            $('#venueSelectBox').html(VenueHtml);
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
            $("#btnCreateTicket").click(function () {
                var TT_event_id = $("#TT_event_id").val();
                var TT_venue_id = $("#TT_venue_id").val();
                var TT_type_title = $("#TT_type_title").val();
                var TT_current_price = $("#TT_current_price").val();
                var TT_ticket_quantity = $("#TT_ticket_quantity").val();
                var TT_per_user_limit = $("#TT_per_user_limit").val();
                var TT_late_fee = $("#TT_late_fee").val();
                var TT_late_fee_apply_from = $("#TT_late_fee_apply_from").val();
                var is_late_fee = $("input[name='is_late_fee']:checked").val();
                var TT_is_preorder = $("input[name='TT_is_preorder']:checked").val();
                var LateFee = "no";
                var Preorder = "no";
                if (typeof is_late_fee === "string" && is_late_fee === "yes") {
                    LateFee = is_late_fee;
                }
                if (typeof TT_is_preorder === "string" && TT_is_preorder === "yes") {
                    Preorder = TT_is_preorder;
                }
                
                if (TT_event_id === '0') {
                    $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select event title for ticket type</em></strong></div>');
                } else if (TT_venue_id === '0') {
                    $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select venue name for ticket type</em></strong></div>');
                } else if (TT_type_title === "") {
                    $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket type name</em></strong></div>');
                } else if (Preorder == "no") {
                    if (TT_current_price === "") {
                        $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket current price</em></strong></div>');
                    }else{
                        $("#ticketCreate").submit();
                    }
                } else if (TT_ticket_quantity === "") {
                    $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket quantity</em></strong></div>');
                } else if (TT_per_user_limit === "") {
                    $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket per user limit</em></strong></div>');
                } else if (LateFee === "yes") {
                    if (TT_late_fee === "") {
                        $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket late fee amount</em></strong></div>');
                    } else if (TT_late_fee_apply_from === "") {
                        $("#ticketError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter ticket late fee applicable date</em></strong></div>');
                    } else {
                        $("#ticketCreate").submit();
                    }
                } else {
                    $("#ticketCreate").submit();
                }
            });
        });

    </script>

    <script type="text/javascript">
        $("#ticlist").addClass("active");
        $("#ticlist").parent().parent().addClass("active");
        $("#ticlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>