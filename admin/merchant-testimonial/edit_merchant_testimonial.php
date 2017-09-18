
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';


$item_title = "";
$item_file = "";
$item_description = "";
$IG_merchant_id = "";
$IG_title = "";
$IG_description = "";
$IG_created_on = "";
$IG_created_by = "";
$image_file = array();
$last_image_id = 0;
$merchant_id = 0;


if (isset($_GET["merchant_id"])) {
    $merchant_id = mysqli_real_escape_string($con, $_GET["merchant_id"]);
}
if (isset($_GET['image_id'])) {
    $id = $_GET['image_id'];
}
//debug($IG_id);exit();

$sql = "select id,merchant_id from merchant_testimonial where merchant_id = $merchant_id";
$result_merchant = mysqli_query($con, $sql);
if ($result_merchant) {
    while ($row = mysqli_fetch_object($result_merchant)) {
        $id = $row->id;
        $merchant_id = $row->merchant_id;
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

    /*     * *************** Event Image Code start Here *********************** */
    $IG_image_name = "";
    if ($_FILES["image_file"]["tmp_name"] != '') {

        /*         * *****Renaming the image file******** */

        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MerchantID-' . $merchant_id . '-ImgID-' . $id . '.' . $info; /* create custom image name color id will add  */
        $gallery_image_source = $_FILES["image_file"]["tmp_name"];
        /*         * *****Renaming the image file******** */

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["image_file"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;

        if (!(move_uploaded_file($gallery_image_source, $image_target_path))) {
            $err = "Gallery image upload failed.";
        }
    }

    /*     * *************** Event Image Code End Here *********************** */


    $IG_merchant_id = $merchant_id;
    $IG_title = mysqli_real_escape_string($con, $item_title);
    $IG_description = mysqli_real_escape_string($con, $item_description);
    $IG_image_name = mysqli_real_escape_string($con, $IG_image_name);
    $IG_updated_by = getSession('admin_id');


    $update_ImageArray = '';
    $update_ImageArray .= ' merchant_id = "' . $merchant_id . '"';
    $update_ImageArray .= ', title = "' . $IG_title . '"';
    $update_ImageArray .= ', testimonial_des = "' . $IG_description . '"';
    if ($_FILES["image_file"]["tmp_name"] != '') {
        $update_ImageArray .= ', photo = "' . $IG_image_name . '"';
    }
    

    $run_update_query = "UPDATE merchant_testimonial SET $update_ImageArray WHERE id = $id";
    $result = mysqli_query($con, $run_update_query);


    if (!$result) {
        if (DEBUG) {
            $err = "run_update_query error: " . mysqli_error($con);
        } else {
            $err = "run_update_query query failed.";
        }
    } else {
        $msg = "Image updated successfully";
        $link = "merchant_testimonial_list.php?msg=" . base64_encode($msg) . "&merchant_id=" . $merchant_id;
        redirect($link);
    }
}


$get_gallery_sql = "SELECT merchant_testimonial.* FROM merchant_testimonial  WHERE id = $id AND merchant_id = $merchant_id";
$get_result = mysqli_query($con, $get_gallery_sql);

if ($get_result) {
    $count_gallery = mysqli_num_rows($get_result);
    if ($count_gallery > 0) {
        while ($row = mysqli_fetch_object($get_result)) {
            $IG_merchant_id = $row->merchant_id;
            $item_title = $row->title;
            $item_description = $row->testimonial_des;
            $IG_image_name = $row->photo;
        }
    }
} else {
    if (DEBUG) {
        $err = "run_update_query error: " . mysqli_error($con);
    } else {
        $err = "run_update_query query failed.";
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
        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Edit Merchant Gallery</h3>

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
                                    <div class="form-group" id="imageLink">
                                        <label class="col-md-4 control-label">Image File</label>
                                        <div class="col-md-8">
                                            <input type="file" multiple name="image_file" id="image_file"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <img src="<?php echo baseUrl("upload/image_file/original/") ?><?php echo $IG_image_name; ?>" width="80px" height="50px;"  />
                                        </div>
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
        $(document).ready(function () {
            $("#btnCreateGallery").click(function () {
                var item_title = $("#item_title").val();

                if (item_title === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter item title</em></strong></div>');
                } else {
                    $("#createGallery").submit();
                }
            });
        });



    </script>

    <script type="text/javascript">
        $("#merchentgal").addClass("active");
        $("#merchentgal").parent().parent().addClass("active");
        $("#merchentgal").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>