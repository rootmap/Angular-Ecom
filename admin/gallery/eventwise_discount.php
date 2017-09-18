
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$event_id = "";
//$item_description = "";
$eventwise_discount_title = "";
//$item_file = "";
$eventwise_discount_amount = "";
$type = "";
//$VG_title = "";
//$VG_description = "";
//$VG_video_link = "";
//$VG_created_on = "";
//$VG_created_by = "";
//$IG_event_id = "";
//$IG_title = "";
//$IG_description = "";
//$IG_created_on = "";
//$IG_created_by = "";
//$image_file = array();
//$last_image_id = 0;
$event_id = 0;

//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
$arrEvents = array();
$get_events = "SELECT event_id,event_title FROM events";
$resultEvent = mysqli_query($con, $get_events);
if ($resultEvent) {
    while ($obj = mysqli_fetch_object($resultEvent)) {
        $arrEvents[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $event_id = mysqli_real_escape_string($con, $event_id);
    $eventwise_discount_title = mysqli_real_escape_string($con, $eventwise_discount_title);
    $eventwise_discount_amount = mysqli_real_escape_string($con, $eventwise_discount_amount);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',discount_title = "' . $eventwise_discount_title . '"';
    $insert_eedc_array .= ',discount_amount = "' . $eventwise_discount_amount . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "' . $type . '"';

    $run_eedc_array_sql = "INSERT INTO eventwise_discount SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Discount Amount saved successfully";
        $link = "eventwise_discount_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for discount start
if (isset($_POST["btneditGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $event_id = mysqli_real_escape_string($con, $event_id);
    $eventwise_discount_title = mysqli_real_escape_string($con, $eventwise_discount_title);
    $eventwise_discount_amount = mysqli_real_escape_string($con, $eventwise_discount_amount);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',discount_title = "' . $eventwise_discount_title . '"';
    $insert_eedc_array .= ',discount_amount = "' . $eventwise_discount_amount . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "' . $type . '"';
    $run_eedc_array_sql = "UPDATE eventwise_discount SET $insert_eedc_array WHERE id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "Discount_eventwise error: " . mysqli_error($con);
        } else {
            $err = "Discount_eventwise_sql query failed.";
        }
    } else {
        $msg = "Discount UPDATE Amount saved successfully";
        $link = "eventwise_discount_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for discount end
//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $eventdiscount = "SELECT * FROM  eventwise_discount WHERE id = '" . $id . "'";
    $discountarray = array();
    $sqldiscount = mysqli_query($con, $eventdiscount);
    $discountchk = mysqli_num_rows($sqldiscount);
    if ($discountchk != 0) {
        while ($discountrow = mysqli_fetch_object($sqldiscount)) {
            $discountarray[] = $discountrow;
        }
    }
}
//edit option for discount end
//    echo var_dump($discountarray);
//    exit();
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
            <?php
                include basePath('admin/message.php');
                if (isset($_GET['id'])) {
                    ?>

            <h3 class="bg-white content-heading border-bottom strong"> Edit Eventwise Discount</h3>

                <div class="innerAll spacing-x2">
                

                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGallery" enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Event ID</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="event_id" name="event_id" >
                                                    <option  value="0">Select Event</option>

                                                    <?php if (count($arrEvents) >= 1): ?>
                                                        <?php foreach ($arrEvents as $events): ?>
                                                            <option <?php if ($discountarray[0]->event_id == $events->event_id ) { ?> selected="selected" <?php } ?> value="<?php echo $events->event_id; ?>">
                                                                <?php echo $events->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle">Eventwise Discount Title</label>
                                            <div class="col-md-8"><input class="form-control" id="event_discount_title" name="eventwise_discount_title" value="<?php echo $discountarray[0]->discount_title; ?>" type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Eventwise Discount Amount</label>
                                            <div class="col-md-8"><input class="form-control" id="eventwise_discount_amount" name="eventwise_discount_amount" value="<?php echo $discountarray[0]->discount_amount; ?>" type="text"/></div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Select Payment </label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="type" name="type" >
                                                    <option <?php if($discountarray[0]->status == 0){ ?> selected="selected" <?php } ?> value="0">Select option</option>
                                                    <option <?php if($discountarray[0]->status == 1){ ?> selected="selected" <?php } ?> value="1">Percentage</option>
                                                    <option <?php if($discountarray[0]->status == 2){ ?> selected="selected" <?php } ?> value="2">Amount</option>
                                                </select>
                                            </div>
                                        </div>


                                        <!--                                            <label class="col-md-4 control-label" for="itemDescription">Select Percentage/Amount</label>
                                                                                    <div class="col-md-8"><input class="form-control" id="eventwise_percentaget_amount" name="eventwise_percentaget_amount" value="<?php //echo $discountarray[0]->discount_amount;  ?>" type="text"/></div>-->



                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>Update Record</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>





                     <?php //include basePath('admin/message.php'); ?>
                    <h3 class="bg-white content-heading border-bottom strong">Eventwise Discount</h3>

<div class="innerAll spacing-x2">
                  
                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGallery" enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Event ID</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="event_id" name="event_id">
                                                    <option value="0">Select Event</option>
                                                    <?php if (count($arrEvents) >= 1): ?>
                                                        <?php foreach ($arrEvents as $events): ?>
                                                            <option value="<?php echo $events->event_id; ?>">
                                                                <?php echo $events->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle">Eventwise Discount Title</label>
                                            <div class="col-md-8"><input class="form-control" id="event_discount_title" name="eventwise_discount_title"  type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Eventwise Discount Amount</label>
                                            <div class="col-md-8"><input class="form-control" id="eventwise_discount_amount" name="eventwise_discount_amount"  type="text"/></div>

                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Select Payment </label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="type" name="type" >
                                                    <option value="0">Select option</option>
                                                    <option value="1">Percentage</option>
                                                    <option value="2">Amount</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btnCreateEDC" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>

        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
<!--    <script>
        $(document).ready(function () {
            $("#item_description").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>-->



    <script type="text/javascript">
        $("#eventwisdiscount").addClass("active");
        $("#eventwisdiscount").parent().parent().addClass("active");
        $("#eventwisdiscount").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

