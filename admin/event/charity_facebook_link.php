
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

    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',page_name = "' . $page_name . '"';
    $insert_eedc_array .= ',page_link= "' . $page_link . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "1"';

    $run_eedc_array_sql = "INSERT INTO charity_facebook_link SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Fan Page Link saved successfully";
        $link = "charity_facebook_link_list.php?msg=" . base64_encode($msg);
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


    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'event_id = "' . $event_id . '"';
    $insert_eedc_array .= ',page_name = "' . $page_name . '"';
    $insert_eedc_array .= ',page_link= "' . $page_link . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';
    $insert_eedc_array .= ',status = "0"';

    $run_eedc_array_sql = "UPDATE charity_facebook_link SET $insert_eedc_array WHERE id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Fan Page Link UPDATE successfully";
        $link = "charity_facebook_link_list.php?msg=" . base64_encode($msg);
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
    $chairtyfund = "SELECT * FROM charity_facebook_link WHERE id ='" . $id . "'";
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
                <h3 class="bg-white content-heading border-bottom strong">Edit Eventwise Facebook Link</h3>
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
                                        <label class="col-md-4 control-label" for="itemTitle">Page Name</label>
                                        <div class="col-md-8"><input class="form-control" id="page_name" name="page_name" value="<?php echo $chairtyarray[0]->page_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Page Link</label>
                                        <div class="col-md-8"><input class="form-control" id="page_link" name="page_link" value="<?php echo $chairtyarray[0]->page_link; ?>" type="text"/></div>
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
            <?php } else { ?>

                <h3 class="bg-white content-heading border-bottom strong">Add Eventwise Facebook Link</h3>


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
                                        <label class="col-md-4 control-label" for="itemTitle">Page Name</label>
                                        <div class="col-md-8"><input class="form-control" id="page_name" name="page_name"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Page Link</label>
                                        <div class="col-md-8"><input class="form-control" id="page_link" name="page_link"  type="text"/></div>
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
    $("#charity_facebook_link").addClass("active");
    $("#charity_facebook_link").parent().parent().addClass("active");
    $("#charity_facebook_link").parent().addClass("in");
</script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

