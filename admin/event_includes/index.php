<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$EI_event_id = "";
$EI_venue_id = "";
$EI_name = "";
$EI_description = "";
$EI_price = "";
$EI_total_quantity = "";
$EI_limit = "";
$EI_status = "";
$EI_created_on = "";
$EI_created_by = "";

$arr = array();
$get_events = "SELECT event_id,event_title FROM events order by event_id desc";
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



$varr = array();
$get_venues = "SELECT venue_id,venue_title FROM event_venues order by venue_id desc";
$vrs = mysqli_query($con, $get_venues);
if ($vrs) {
    while ($vobj = mysqli_fetch_object($vrs)) {
        $varr[] = $vobj;
    }
} else {
    if (DEBUG) {
        $err = "get_venues error: " . mysqli_error($con);
    } else {
        $err = "get_venues query failed.";
    }
}

if (isset($_POST['EI_name'])) {
    extract($_POST);
//    debug($_POST);exit();
//    if (!$EI_status OR $EI_status != "active") {
//        $EI_status = 'inactive';
//    }
    $EI_event_id = mysqli_real_escape_string($con, $EI_event_id);
    $EI_venue_id = mysqli_real_escape_string($con, $EI_venue_id);
    $EI_name = mysqli_real_escape_string($con, $EI_name);
    $EI_description = mysqli_real_escape_string($con, $EI_description);
    $EI_price = mysqli_real_escape_string($con, $EI_price);
    $EI_total_quantity = mysqli_real_escape_string($con, $EI_total_quantity);
    $EI_limit = mysqli_real_escape_string($con, $EI_limit);
    $EI_status = "inactive";
    $EI_created_by = getSession("admin_id");
    $EI_created_on = date("Y-m-d H:i:s");


    $insert_IncludesArray = '';
    $insert_IncludesArray .= ' EI_event_id = "' . $EI_event_id . '"';
    $insert_IncludesArray .= ', EI_venue_id = "' . $EI_venue_id . '"';
    $insert_IncludesArray .= ', EI_name = "' . $EI_name . '"';
    $insert_IncludesArray .= ', EI_description = "' . $EI_description . '"';
    $insert_IncludesArray .= ', EI_price = "' . $EI_price . '"';
    $insert_IncludesArray .= ', EI_total_quantity = "' . $EI_total_quantity . '"';
    $insert_IncludesArray .= ', EI_limit = "' . $EI_limit . '"';
    $insert_IncludesArray .= ', EI_status = "' . $EI_status . '"';
    $insert_IncludesArray .= ', EI_created_on = "' . $EI_created_on . '"';
    $insert_IncludesArray .= ', EI_created_by = "' . $EI_created_by . '"';


    $run_insert_query = "INSERT INTO event_includes SET $insert_IncludesArray";
    $result = mysqli_query($con, $run_insert_query);
    if (!$result) {
        if (DEBUG) {
            $err = "run_insert_query error: " . mysqli_error($con);
        } else {
            $err = "run_insert_query query failed.";
        }
    } else {
        $msg = "Event includes saved successfully";
        $link = "event_includes_list.php?msg=" . base64_encode($msg) . "&" . "venue_id=" . $EI_venue_id . "&" . "event_id=" . $EI_event_id;
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Create Event Includes</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="includesCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="includesError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="EI_event_id" name="EI_event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->event_id; ?>"  
                                                        <?php
                                                        if ($at->event_id == $EI_event_id) {
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
                                        <div class="col-md-8">
                                            <select class="form-control" id="EI_venue_id" name="EI_venue_id">
                                                <option value="0">Select Venue</option>
                                                <?php if (count($varr) >= 1): ?>
                                                    <?php foreach ($varr as $vat): ?>
                                                        <option value="<?php echo $vat->venue_id; ?>"  
                                                        <?php
                                                        if ($vat->venue_id == $EI_venue_id) {
                                                            echo ' selected="selected"';
                                                        }
                                                        ?>>
                                                            <?php echo $vat->venue_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="includesName">Includes Name</label>
                                        <div class="col-md-8"><input class="form-control" id="EI_name" name="EI_name" value="<?php echo $EI_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="includesDetails">Includes Details</label>
                                        <div class="col-md-8">
                                            <textarea id="EI_description" name="EI_description" rows="3" cols="30"><?php echo html_entity_decode($EI_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="price">Price</label>
                                        <div class="col-md-4"><input class="form-control" id="EI_price" name="EI_price" min="1" value="<?php echo $EI_price; ?>" type="number"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="totalQuantity">Total Quantity</label>
                                        <div class="col-md-4"><input class="form-control" id="EI_total_quantity" name="EI_total_quantity" min="1" value="<?php echo $EI_total_quantity; ?>" type="number"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="userLimit">Per User Limit</label>
                                        <div class="col-md-4"><input class="form-control" id="EI_limit" name="EI_limit" min="1" value="<?php echo $EI_total_quantity; ?>" type="number"/></div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateEventInclude" name="btnCreateEventInclude" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Includes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script>
        $(document).ready(function () {
            $("#EI_description").kendoEditor({
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
        $(document).ready(function () {
            $("#btnCreateEventInclude").click(function () {
                var EI_event_id = $("#EI_event_id").val();
                var EI_venue_id = $("#EI_venue_id").val();
                var EI_name = $("#EI_name").val();
                var EI_price = $("#EI_price").val();
                var EI_total_quantity = $("#EI_total_quantity").val();
                var EI_limit = $("#EI_limit").val();

                if (EI_event_id === '0') {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select event title for includes</em></strong></div>');
                } else if (EI_venue_id === '0') {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select venue name for includes</em></strong></div>');
                } else if (EI_name === "") {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter event includes name</em></strong></div>');
                } else if (EI_price === "") {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter event includes price</em></strong></div>');
                } else if (EI_total_quantity === "") {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter event includes total quantity</em></strong></div>');
                } else if (EI_limit === "") {
                    $("#includesError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter event includes per user limit</em></strong></div>');
                } else {
                    $("#includesCreate").submit();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $("#inclist").addClass("active");
        $("#inclist").parent().parent().addClass("active");
        $("#inclist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>