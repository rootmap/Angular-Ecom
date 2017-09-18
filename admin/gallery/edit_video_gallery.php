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
$VG_event_id = "";
$VG_title = "";
$VG_description = "";
$VG_video_link = "";
$VG_updated_by = "";
$event_id = 0;
$VG_id = 0;

if (isset($_GET["event_id"])) {
    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
}

if (isset($_GET['video_id'])) {
    $VG_id = $_GET['video_id'];
}

if (isset($_POST["item_title"])) {
    extract($_POST);


    $VG_event_id = $event_id;
    $VG_title = mysqli_real_escape_string($con, $item_title);
    $VG_description = mysqli_real_escape_string($con, $item_description);
    $VG_video_link = mysqli_real_escape_string($con, $item_link);
    $VG_updated_by = getSession("admin_id");

    $update_VideoArray = '';
    $update_VideoArray .= ' VG_event_id = "' . $event_id . '"';
    $update_VideoArray .= ', VG_title = "' . $VG_title . '"';
    $update_VideoArray .= ', VG_description = "' . $VG_description . '"';
    $update_VideoArray .= ', VG_video_link = "' . $VG_video_link . '"';
    $update_VideoArray .= ', VG_updated_by = "' . $VG_updated_by . '"';

    $run_update_query = "UPDATE event_video_gallery SET $update_VideoArray WHERE VG_id = $VG_id";
    $result = mysqli_query($con, $run_update_query);


    if (!$result) {
        if (DEBUG) {
            $err = "run_update_query error: " . mysqli_error($con);
        } else {
            $err = "run_update_query query failed.";
        }
    } else {
        $msg = "Video Link updated successfully";
        $link = "created_gallery_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
        redirect($link);
    }
}



$get_video_sql = "SELECT event_video_gallery.* FROM event_video_gallery  WHERE VG_id = $VG_id AND VG_event_id = $event_id";
$get_result = mysqli_query($con, $get_video_sql);
if ($get_result) {
    $count_gallery = mysqli_num_rows($get_result);
    if ($count_gallery > 0) {
        while ($row = mysqli_fetch_object($get_result)) {
            $VG_event_id = $row->VG_event_id;
            $item_title = $row->VG_title;
            $item_description = $row->VG_description;
            $item_link = $row->VG_video_link;
        }
    }
} else {
    if (DEBUG) {
        $err = "get_result error: " . mysqli_error($con);
    } else {
        $err = "get_result query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Edit Gallery</h3>

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

                                    <div class="form-group" id="videoLink">
                                        <label class="col-md-4 control-label" for="itemLink">Video Link</label>
                                        <div class="col-md-8"><input class="form-control" id="item_link" name="item_link" value="<?php echo $item_link; ?>" type="text"/></div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Gallery</button>
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
        $(document).ready(function () {
            $("#btnCreateGallery").click(function () {
                var item_title = $("#item_title").val();
                var item_link = $("#item_link").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;
                //alert(itemType);

                if (item_title === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter item title</em></strong></div>');
                }  else if (item_link === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter video link</em></strong></div>');
                } else if (item_link !== "") {
                    if (URL_check.test(item_link)) {
                        $("#createGallery").submit();
                    } else {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter valid URL for link</em></strong></div>');
                    }
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