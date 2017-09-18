<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$EP_id = 0;
$EP_event_id = 0;
$EP_participant_name = "";
$EP_current_position = "";
$EP_details = "";
$EP_image = "";
$EP_created_on = "";
$EP_created_by = "";

if (isset($_GET["event_id"])) {
    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
}

$sql = "select event_id,event_title from events where event_id = $event_id";
$result_event = mysqli_query($con, $sql);
if ($result_event) {
    while ($row = mysqli_fetch_object($result_event)) {
        $event_title = $row->event_title;
        $event_id = $row->event_id;
    }
} else {
    if (DEBUG) {
        $err = "result_event error: " . mysqli_error($con);
    } else {
        $err = "result_event query failed.";
    }
}



if (isset($_POST['EP_participant_name'])) {
    extract($_POST);

    /*     * *************** Guest Photo Code start Here *********************** */
    $EP_image = "";
    if ($_FILES["EP_image"]["tmp_name"] != '') {

        /*         * *****Renaming the image file******** */
        $EP_image = basename($_FILES['EP_image']['name']);
        $info = pathinfo($EP_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $EP_image_name = 'guest_' . date("Y-m-d-H-i-s") . "_eid_" . $event_id . '.' . $info; /* create custom image name color id will add  */
        $EP_image_source = $_FILES["EP_image"]["tmp_name"];
        /*         * *****Renaming the image file******** */


        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/guest/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/guest/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/guest/' . $EP_image_name;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["EP_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/guest/' . $EP_image_name;

        if (!$zebra->resize(300)) {
            zebraImageErrorHandaling($zebra->error);
        }
    }

    /*     * *************** Guest Photo Code start Here *********************** */

    $EP_event_id = validateInput($event_id);
    $EP_participant_name = validateInput($EP_participant_name);
    $EP_current_position = validateInput($EP_current_position);
    $EP_details = validateInput($EP_details);
    $EP_image = validateInput($EP_image_name);
    $EP_created_by = getSession("admin_id");
    $EP_created_on = date("Y-m-d H:i:s");

    $insertGuestArray = '';
    $insertGuestArray .= 'EP_event_id ="' . $EP_event_id . '"';
    $insertGuestArray .= ',EP_participant_name ="' . $EP_participant_name . '"';
    $insertGuestArray .= ',EP_current_position ="' . $EP_current_position . '"';
    $insertGuestArray .= ',EP_details ="' . $EP_details . '"';
    $insertGuestArray .= ',EP_image ="' . $EP_image . '"';
    $insertGuestArray .= ',EP_created_by ="' . $EP_created_by . '"';
    $insertGuestArray .= ',EP_created_on ="' . $EP_created_on . '"';


    $insertGuestSql = "INSERT INTO event_participants SET $insertGuestArray";
    $resultGuest = mysqli_query($con, $insertGuestSql);
    if ($resultGuest) {
        $msg = "Guest information saved successfully";
        $link = "created_guest_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "insertGuestArray error: " . mysqli_error($con);
        } else {
            $err = "insertGuestArray query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Add New Guest For <?php echo $event_title; ?></h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGuest" enctype="multipart/form-data">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="guestError"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Guest Name</label>
                                        <div class="col-md-8"><input class="form-control" id="EP_participant_name" name="EP_participant_name" value="<?php echo $EP_participant_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="designation">Designation</label>
                                        <div class="col-md-8"><input class="form-control" id="EP_current_position" name="EP_current_position" value="<?php echo $EP_current_position; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Photo</label>
                                        <div class="col-md-8">
                                            <input type="file" name="EP_image" id="EP_image"/>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="details">Guest Details</label>
                                        <div class="col-md-8">
                                            <textarea id="EP_details" name="EP_details" rows="3" cols="30"><?php echo html_entity_decode($EP_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateGuest" name="btnCreateGuest" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Guest</button>
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
            $("#EP_details").kendoEditor({
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
            $("#btnCreateGuest").click(function () {
                var EP_participant_name = $("#EP_participant_name").val();
                var EP_current_position = $("#EP_current_position").val();
                var EP_image = $("#EP_image").val();

                if (EP_participant_name === "") {
                    $("#guestError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Guest name required</em></strong></div>');
                } else if (EP_current_position === "") {
                    $("#guestError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Guest position or designation required</em></strong></div>');
                } else if (EP_image === "") {
                    $("#guestError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Guest image required</em></strong></div>');
                } else {
                    $("#createGuest").submit();
                }
            });
        });

    </script>

    <script type="text/javascript">
        $("#guestlist").addClass("active");
        $("#guestlist").parent().parent().addClass("active");
        $("#guestlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

