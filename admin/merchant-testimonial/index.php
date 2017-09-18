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
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//    
//}
 

$arrMarchents = array();
$get_Marchents = "SELECT 
                    clients_id,
                    clients_name
                    FROM clients GROUP BY clients_id";
$resultMarchents = mysqli_query($con, $get_Marchents);
if ($resultMarchents) {
    while ($obj = mysqli_fetch_object($resultMarchents)) {
        $arrMarchents[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

if (isset($_POST["item_title"])) {
    extract($_POST);
    //echo ($_POST);
   // exit();
    
    // Image file save start

    $uploadStatus = true;

    for ($x = 0; $x < count($_FILES['image_file']['name']); $x++) {
//            echo 'Name ' . $x . ': ' . $_FILES['image_file']['name'][$x] . '<br/>';
//            echo 'tmp_name ' . $x . ': ' . $_FILES['image_file']['tmp_name'][$x] . '<br/>';

        $IG_image_name = "";
        $IG_merchant_id = mysqli_real_escape_string($con, $merchant_id);
        $IG_title = mysqli_real_escape_string($con, $item_title);
        $IG_description = mysqli_real_escape_string($con, $item_description);
        $IG_created_on = date("Y-m-d");
        $IG_created_by = getSession("admin_id");
        //echo $IG_description;
        //exit();
        $insert_Image = '';
        $insert_Image .= ' merchant_id = "' . $IG_merchant_id . '"';
        $insert_Image .= ', title = "' . $IG_title . '"';
        $insert_Image .= ', testimonial_des = "' . $IG_description . '"';
        $insert_Image .= ', date = "' . $IG_created_on . '"';
        //$insert_Image .= ', IG_created_by = "' . $IG_created_by . '"';
        //echo var_dump($insert_Image);
        //exit();

        $sql_insert_image = "INSERT INTO merchant_testimonial SET $insert_Image";
        $image_result = mysqli_query($con, $sql_insert_image);



        if (!$image_result) {
            echo mysqli_error($con);
        } else {
            $last_image_id = mysqli_insert_id($con);
        }

        if ($_FILES["image_file"]["tmp_name"][$x] != '') {

            /*             * *****Renaming the image file******** */
            $gallery_image = basename($_FILES['image_file']['name'][$x]);
            $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
            $IG_image_name = 'MerchantID-' . $merchant_id . '-ImgID-' . $last_image_id . '.' . $info; /* create custom image name color id will add  */
            $gallery_image_source = $_FILES["image_file"]["tmp_name"][$x];
            /*             * *****Renaming the image file******** */


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
                $updateImage .= ' photo = "' . $IG_image_name . '"';

                $sqlUpdateImage = "UPDATE merchant_testimonial SET $updateImage WHERE id=$last_image_id";
                $resultUpdateImage = mysqli_query($con, $sqlUpdateImage);
                if (!$resultUpdateImage) {
                    $uploadStatus = false;
                }
            }
        }
    }

    if ($uploadStatus == true) {
        $msg = "Image uploaded successfully";
        $link = "merchant_testimonial_list.php?msg=" . base64_encode($msg);
        redirect($link);
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
            <h3 class="bg-white content-heading border-bottom strong">Add New Gallery Image</h3>

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
                                        <label class="col-md-4 control-label" for="venueTitle">Merchant Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="merchant_id" name="merchant_id">
                                                <option value="0">Select Merchant</option>
                                                <?php if (count($arrMarchents) >= 1): ?>
                                                    <?php foreach ($arrMarchents as $marchents): ?>
                                                        <option value="<?php echo $marchents->clients_id; ?>">
                                                            <?php echo $marchents->clients_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Testimonial Image Title</label>
                                        <div class="col-md-8"><input class="form-control" id="item_title" name="item_title" value="<?php echo $item_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Testimonial Description</label>
                                        <div class="col-md-8">
                                            <textarea id="item_description" name="item_description" rows="3" cols="30"><?php echo html_entity_decode($item_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" id="imageLink">
                                        <label class="col-md-4 control-label">Image File</label>
                                        <div class="col-md-8">
                                            <input type="file" multiple name="image_file[]" id="image_file"/>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save </button>
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
    <!--<script type="text/javascript">
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
    </script>-->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateGallery").click(function () {
                var merchant_id = $("#merchant_id").val();
                var item_title = $("#item_title").val();
                var item_description = $("#item_description").val();
                var image_file = $("#image_file").val();
                if (merchant_id === '0') {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select event title</em></strong></div>');
                }else if (item_title === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter item title</em></strong></div>');
                }else if (item_description === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter Decctiption</em></strong></div>');
                } else if (image_file === "") {
                    $("#galleryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one image</em></strong></div>');
                } else {
                    $("#createGallery").submit();
                }
            });
        });

    </script>

    <script type="text/javascript">
        $("#merchenttest").addClass("active");
        $("#merchenttest").parent().parent().addClass("active");
        $("#merchenttest").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>