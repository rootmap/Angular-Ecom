<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$item_title = "";
$item_description = "";
$item_link = "";
$item_file = "";
$itemType = "";
$VG_event_id = "";
$VG_title = "";
$VG_description = "";
$VG_video_link = "";
$VG_created_on = "";
$VG_created_by = "";
$IG_event_id = "";
$IG_title = "";
$IG_description = "";
$IG_created_on = "";
$IG_created_by = "";
$image_file = array();
$last_image_id = 0;
$event_id = 0;


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

if (isset($_POST["item_title"])) {
    extract($_POST);

    // video link save start
    if ($itemType === "video") {
        $VG_event_id = $event_id;
        $VG_title = mysqli_real_escape_string($con, $item_title);
        $VG_description = mysqli_real_escape_string($con, $item_description);
        $VG_video_link = mysqli_real_escape_string($con, $item_link);
        $VG_created_on = date("Y-m-d H:i:s");
        $VG_created_by = getSession("admin_id");

        $insert_video_array = '';
        $insert_video_array .= ' VG_event_id = "' . $VG_event_id . '"';
        $insert_video_array .= ', VG_title = "' . $VG_title . '"';
        $insert_video_array .= ', VG_description = "' . $VG_description . '"';
        $insert_video_array .= ', VG_video_link = "' . $VG_video_link . '"';
        $insert_video_array .= ', VG_created_by = "' . $VG_created_by . '"';
        $insert_video_array .= ', VG_created_on = "' . $VG_created_on . '"';

        $run_video_array_sql = "INSERT INTO event_video_gallery SET $insert_video_array";
        $result = mysqli_query($con, $run_video_array_sql);

        if (!$result) {
            if (DEBUG) {
                $err = "run_video_array_sql error: " . mysqli_error($con);
            } else {
                $err = "run_video_array_sql query failed.";
            }
        } else {
            $msg = "Video link saved successfully";
            $link = "created_gallery_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
            redirect($link);
        }
    }
    // Video link save end
    // Image file save start

    if ($itemType == "image") {

        $uploadStatus = true;

        for ($x = 0; $x < count($_FILES['image_file']['name']); $x++) {
//            echo 'Name ' . $x . ': ' . $_FILES['image_file']['name'][$x] . '<br/>';
//            echo 'tmp_name ' . $x . ': ' . $_FILES['image_file']['tmp_name'][$x] . '<br/>';

            $IG_image_name = "";
            $IG_event_id = $event_id;
            $IG_title = mysqli_real_escape_string($con, $item_title);
            $IG_description = mysqli_real_escape_string($con, $item_description);
            $IG_created_on = date("Y-m-d H:i:s");
            $IG_created_by = getSession("admin_id");

            $insert_Image = '';
            $insert_Image .= ' IG_event_id = "' . $IG_event_id . '"';
            $insert_Image .= ', IG_title = "' . $IG_title . '"';
            $insert_Image .= ', IG_description = "' . $IG_description . '"';
            $insert_Image .= ', IG_created_on = "' . $IG_created_on . '"';
            $insert_Image .= ', IG_created_by = "' . $IG_created_by . '"';


            $sql_insert_image = "INSERT INTO event_image_gallery SET $insert_Image";
            $image_result = mysqli_query($con, $sql_insert_image);

            if (!$image_result) {
                echo mysqli_error($con);
            } else {
                $last_image_id = mysqli_insert_id($con);
            }

            if ($_FILES["image_file"]["tmp_name"][$x] != '') {

                /*                 * *****Renaming the image file******** */
                $gallery_image = basename($_FILES['image_file']['name'][$x]);
                $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
                $IG_image_name = 'EventID-' . $event_id . '-ImgID-' . $last_image_id . '.' . $info; /* create custom image name color id will add  */
                $gallery_image_source = $_FILES["image_file"]["tmp_name"][$x];
                /*                 * *****Renaming the image file******** */


                if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/')) {
                    mkdir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/', 0777, TRUE);
                }
                $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;


                $zebra = new Zebra_Image();
                $zebra->source_path = $_FILES["image_file"]["tmp_name"][$x]; /* original image path */
                $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;

                if (!(move_uploaded_file($gallery_image_source, $image_target_path))) {
                    $err = "Gallery image upload failed.";
                } else {
                    $updateImage = '';
                    $updateImage .= ' IG_image_name = "' . $IG_image_name . '"';

                    $sqlUpdateImage = "UPDATE event_image_gallery SET $updateImage WHERE IG_id=$last_image_id";
                    $resultUpdateImage = mysqli_query($con, $sqlUpdateImage);
                    if (!$resultUpdateImage) {
                        $uploadStatus = false;
                    }
                }
            }
        }

        if ($uploadStatus == true) {
            $msg = "Image uploaded successfully";
            $link = "created_gallery_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
            redirect($link);
        }
    }

    // Image file save end
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
            <h3 class="bg-white content-heading border-bottom strong">Add Gallery</h3>

            <div class="innerAll spacing-x2">
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
                                        <label class="col-md-4 control-label" for="itemTitle">Item Title</label>
                                        <div class="col-md-8"><input class="form-control" id="item_title" name="item_title" value="<?php echo $item_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Item Description</label>
                                        <div class="col-md-8">
                                            <textarea id="item_description" name="item_description" rows="3" cols="30"><?php echo html_entity_decode($item_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemType">Item Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="itemType" name="itemType" onchange="javascript:gallery(this.value);">
                                                <option value="0">Select Type</option>
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display: none;" id="videoLink">
                                        <label class="col-md-4 control-label" for="itemLink">Video Link</label>
                                        <div class="col-md-8"><input class="form-control" id="item_link" name="item_link" value="<?php echo $item_link; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group" id="imageLink" style="display: none;">
                                        <label class="col-md-4 control-label">Image File</label>
                                        <div class="col-md-8">
                                            <input type="file" multiple="true" name="image_file[]" id="image_file"/>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Gallery</button>
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
    </script>
    <script type="text/javascript">
        function gallery(type) {
            var galleryItem = type;
            if (galleryItem === "image") {
                $("#videoLink").hide();
                $("#imageLink").show();
            } else if (galleryItem === "video") {
                $("#videoLink").show();
                $("#imageLink").hide();
            } else {
                $("#videoLink").hide();
                $("#imageLink").hide();
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateGallery").click(function () {
                var item_title = $("#item_title").val();
                var item_link = $("#item_link").val();
                var image_file = $("#image_file").val();
                var itemType = $("#itemType").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;

                if (item_title === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter item title</em></strong></div>');
                } else if (itemType === "video" && item_link === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter video link</em></strong></div>');
                } else if (itemType === "video" && item_link !== "") {
                    if (URL_check.test(item_link)) {
                        $("#createGallery").submit();
                    } else {
                        $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter valid URL link</em></strong></div>');
                    }
                } else if (itemType === "image" && image_file === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one image</em></strong></div>');
                } else if (itemType !== "image" && itemType !== "video") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select item type</em></strong></div>');
                } else {
                    $("#createGallery").submit();
                }
            });
        });

    </script>

    <script type="text/javascript">
        $("#gallerylist").addClass("active");
        $("#gallerylist").parent().parent().addClass("active");
        $("#gallerylist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>