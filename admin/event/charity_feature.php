
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';
//$id = "";
$event_id = "";
$dtname = "";
$cotname = "";
$dtemail = "";
$dtnamnt = "";
$dtndate = "";
$dtnpymod = "";
$type = "";
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
    $name = mysqli_real_escape_string($con, $dtname);
    $contact_no = mysqli_real_escape_string($con, $cotname);
    $email = mysqli_real_escape_string($con, $dtemail);
    $donate_amount = mysqli_real_escape_string($con, $dtnamnt);
    $donation_date = mysqli_real_escape_string($con, $dtndate);
    $donation_payment_method = mysqli_real_escape_string($con, $dtnpymod);
    $donation_status = mysqli_real_escape_string($con, $type);

    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',name = "' . $dtname . '"';
    $insert_eedc_array .= ',contact_no= "' . $cotname . '"';
    $insert_eedc_array .= ',email = "' . $dtemail . '"';
    $insert_eedc_array .= ',donate_amount = "' . $dtnamnt . '"';
    $insert_eedc_array .= ',donation_date = "' . $dtndate . '"';
    $insert_eedc_array .= ',donation_payment_method = "' . $dtnpymod . '"';
    $insert_eedc_array .= ',donation_status = "' . $type . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "' . $type . '"';

    $run_eedc_array_sql = "INSERT INTO chairty_fund SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Chairty Fund saved successfully";
        $link = "chairty_feature_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for Chairty Fund start
if (isset($_POST["btneditGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $event_id = mysqli_real_escape_string($con, $event_id);
    $name = mysqli_real_escape_string($con, $dtname);
    $contact_no = mysqli_real_escape_string($con, $cotname);
    $email = mysqli_real_escape_string($con, $dtemail);
    $donate_amount = mysqli_real_escape_string($con, $dtnamnt);
    $donation_date = mysqli_real_escape_string($con, $dtndate);
    $donation_payment_method = mysqli_real_escape_string($con, $dtnpymod);
    $donation_status = mysqli_real_escape_string($con, $type);

    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',name = "' . $dtname . '"';
    $insert_eedc_array .= ',contact_no= "' . $cotname . '"';
    $insert_eedc_array .= ',email = "' . $dtemail . '"';
    $insert_eedc_array .= ',donate_amount = "' . $dtnamnt . '"';
    $insert_eedc_array .= ',donation_date = "' . $dtndate . '"';
    $insert_eedc_array .= ',donation_payment_method = "' . $dtnpymod . '"';
    $insert_eedc_array .= ',donation_status = "' . $type . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "' . $type . '"';

    $run_eedc_array_sql = "UPDATE chairty_fund SET $insert_eedc_array WHERE id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Chairty Fund UPDATE successfully";
        $link = "chairty_feature_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for Chairty Fund  end
//edit option for Chairty Fund  start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $chairtyfund = "SELECT * FROM  chairty_fund WHERE id = '" . $id . "'";
    $chairtyarray = array();
    $sqlchairty = mysqli_query($con, $chairtyfund);
    $chairtychk = mysqli_num_rows($sqlchairty);
    if ($chairtychk != 0) {
        while ($chairtyrow = mysqli_fetch_object($sqlchairty)) {
            $chairtyarray[] = $chairtyrow;
        }
    }
}
//edit option for Chairty Fund  end
//    echo var_dump($chairtyarray);
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
            <h3 class="bg-white content-heading border-bottom strong">Edit Donation Detail</h3>
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
                                            <select class="form-control" id="event_id" name="event_id">
                                                <option>Select Event</option>
                                                <?php if (count($arrEvents) >= 0): ?>
                                                    <?php foreach ($arrEvents as $events): ?>
                                                        <option <?php if ($chairtyarray[0]->event_id == $events->event_id) { ?>selected="selected"<?php } ?> value="<?php echo $events->event_id; ?>">
                                                            <?php echo $events->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Name</label>
                                        <div class="col-md-8"><input class="form-control" id="dtname" name="dtname" value="<?php echo $chairtyarray[0]->name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Contact No</label>
                                        <div class="col-md-8"><input class="form-control" id="cotname" name="cotname" value="<?php echo $chairtyarray[0]->contact_no; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Email</label>
                                        <div class="col-md-8"><input class="form-control" id="dtemail" name="dtemail" value="<?php echo $chairtyarray[0]->email; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Donate Amount</label>
                                        <div class="col-md-8"><input class="form-control" id="dtnamnt" name="dtnamnt" value="<?php echo $chairtyarray[0]->donate_amount; ?>" type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Donate Date</label>
                                        <div class="col-md-8"><input class="form-control" id="dtndate" name="dtndate" value="<?php echo $chairtyarray[0]->donation_date; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Donation Payment Method</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="dtnpymod" name="dtnpymod" >
                                                <option <?php if ($chairtyarray[0]->donation_payment_method == 0) { ?>selected="selected"<?php } ?>  value="0">Select option</option>
                                                <option <?php if ($chairtyarray[0]->donation_payment_method == "online") { ?>selected="selected"<?php } ?> value="online">Online</option>

                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle" id="dontestatus" name="dontestatus">Donation Status </label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="type" name="type" >
                                                <option <?php if ($chairtyarray[0]->donation_status == 0) { ?>selected="selected"<?php } ?>  value="0">Select option</option>
                                                <option <?php if ($chairtyarray[0]->donation_status == "cancel") { ?>selected="selected"<?php } ?> value="1">Cancel</option>
                                                <option <?php if ($chairtyarray[0]->donation_status == "confirm") { ?>selected="selected"<?php } ?> value="2">Confirm</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>update Record</button>
                            </div>
                        </div>
                    </div>
                </form>
               <?php } else {?>

                <h3 class="bg-white content-heading border-bottom strong">Manual Donation Detail</h3>


                <?php include basePath('admin/message.php'); ?>
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
                                        <label class="col-md-4 control-label" for="itemTitle">Name</label>
                                        <div class="col-md-8"><input class="form-control" id="dtname" name="dtname"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Contact No</label>
                                        <div class="col-md-8"><input class="form-control" id="cotname" name="cotname"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Email</label>
                                        <div class="col-md-8"><input class="form-control" id="dtemail" name="dtemail"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Donate Amount</label>
                                        <div class="col-md-8"><input class="form-control" id="dtnamnt" name="dtnamnt"  type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Donate Date</label>
                                        <div class="col-md-8"><input class="form-control" id="dtndate" name="dtndate"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Donation Payment Method</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="dtnpymod" name="dtnpymod" >
                                                <option value="0">Select option</option>
                                                <option value="1">Online</option>
                                                <!--                                                    <option value="2">Cencel</option>-->
                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle" id="dontestatus" name="dontestatus">Donation Status </label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="type" name="type" >
                                                <option value="0">Select option</option>
                                                <option value="1">Cencel</option>
                                                <option value="2">Confirm</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreateGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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
    $("#chairtyfeaturelist").addClass("active");
    $("#chairtyfeaturelist").parent().parent().addClass("active");
    $("#chairtyfeaturelist").parent().addClass("in");
</script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

