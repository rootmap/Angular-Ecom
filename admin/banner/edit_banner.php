
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';
$banner_title = "";
$banner_image = "";
$banner_link = "";
$banner_link_type = "";
$banner_updated_by = "";
$banner_priority = "";
$banner_details = "";
$buy_ticket = "";

if (isset($_GET['banner_id'])) {
    $banner_id = $_GET['banner_id'];
}


if (isset($_POST["banner_title"])) {
    extract($_POST);

    if (!$banner_link_type OR $banner_link_type != "external") {
        $banner_link_type = "internal";
    }

    /*     * *************** Event Banner Image Code start Here *********************** */

    if ($_FILES["banner_image"]["tmp_name"] != '') {

        /*         * *****Renaming the image file******** */

        $ban_image = basename($_FILES['banner_image']['name']);

        $info = pathinfo($ban_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $banner_image = 'Banner-' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $ban_image_source = $_FILES["banner_image"]["tmp_name"];
        
        $mobile_width = get_option('HOME_PAGE_BANNER_MOBILE_WIDTH');
        $desktop_width = get_option('HOME_PAGE_BANNER_DESKTOP_WIDTH');
        /*         * *****Renaming the image file******** */

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/' . $banner_image;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["banner_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/' . $banner_image;

        if (!$zebra->resize(1300)) {
            zebraImageErrorHandaling($zebra->error);
        }
        
        
        // mobile
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/mobile/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/mobile/', 0777, TRUE);
        }
        $image_target_path_mobile = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/mobile/' . $banner_image;
        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["banner_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/mobile/' . $banner_image;
        if (!$zebra->resize($mobile_width)) {
            zebraImageErrorHandaling($zebra->error);
        }
        // desktop
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/desktop/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/banner_image/desktop/', 0777, TRUE);
        }
        $image_target_path_desktop = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/desktop/' . $banner_image;
        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["banner_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/banner_image/desktop/' . $banner_image;
        if (!$zebra->resize($desktop_width)) {
            zebraImageErrorHandaling($zebra->error);
        }
        
        
    }
    /*     * *************** Event Banner Image Code End Here *********************** */



    $banner_title = mysqli_real_escape_string($con, $banner_title);
    $banner_link = mysqli_real_escape_string($con, $banner_link);
    $banner_image = mysqli_real_escape_string($con, $banner_image);
    $banner_link_type = mysqli_real_escape_string($con, $banner_link_type);
    $banner_priority = mysqli_real_escape_string($con, $banner_priority);
    $banner_details = mysqli_real_escape_string($con, $banner_details);
    $buy_ticket = mysqli_real_escape_string($con, $buy_ticket);
    $banner_updated_by = getSession("admin_id");

    $update_BannerArray = '';
    $update_BannerArray .= ' banner_title = "' . $banner_title . '"';
    $update_BannerArray .= ', banner_link = "' . $banner_link . '"';
    $update_BannerArray .= ', banner_priority = "' . $banner_priority . '"';
    $update_BannerArray .= ', banner_buy_ticket = "' . $buy_ticket . '"';
    $update_BannerArray .= ', banner_link_type = "' . $banner_link_type . '"';
    $update_BannerArray .= ', banner_details = "' . $banner_details . '"';
    if ($_FILES["banner_image"]["tmp_name"] != '') {
        $update_BannerArray .= ', banner_image = "' . $banner_image . '"';
    }
    $update_BannerArray .= ', banner_updated_by = "' . $banner_updated_by . '"';


    $run_update_query = "UPDATE banner SET $update_BannerArray WHERE banner_id = $banner_id";
    $result = mysqli_query($con, $run_update_query);


    if ($result) {
        $msg = "Banner updated successfully";
        $link = "banner_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "run_update_queryForBanner error: " . mysqli_error($con);
        } else {
            $err = "run_update_queryForBanner query failed.";
        }
    }
}



$get_banner_sql = "SELECT banner.* FROM banner  WHERE banner_id = $banner_id";
$get_result = mysqli_query($con, $get_banner_sql);
$count_banner = mysqli_num_rows($get_result);
if ($count_banner > 0) {
    while ($row = mysqli_fetch_object($get_result)) {
        $banner_title = $row->banner_title;
        $banner_link = $row->banner_link;
        $banner_link_type = $row->banner_link_type;
        $banner_priority = $row->banner_priority;
        $banner_image = $row->banner_image;
        $banner_details = $row->banner_details;
        $buy_ticket = $row->banner_buy_ticket;
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
            <h3 class="bg-white content-heading border-bottom strong">Edit Banner</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createBanner" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="bannerError" style="color: red;"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bannerTitle">Banner Title</label>
                                        <div class="col-md-8"><input class="form-control" id="banner_title" name="banner_title" value="<?php echo $banner_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bannerLink">Banner Link</label>
                                        <div class="col-md-8"><input class="form-control" id="banner_link" name="banner_link" value="<?php echo $banner_link; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bannerLink">Buy Ticket Link</label>
                                        <div class="col-md-8"><input class="form-control" id="buy_ticket" name="buy_ticket" value="<?php echo $buy_ticket; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bannerDetails">Banner Details</label>
                                        <div class="col-md-8"><textarea id="banner_details" name="banner_details" rows="3" cols="30"><?php echo html_entity_decode($banner_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="bannerPriority">Banner Priority</label>
                                        <div class="col-md-4"><input class="form-control" id="banner_priority" name="banner_priority" value="<?php echo $banner_priority; ?>" type="number"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Banner Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="banner_image" id="banner_image"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <img src="<?php echo baseUrl("upload/banner_image/") ?><?php echo $banner_image; ?>" width="80px" height="50px;"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Banner Link Type</label>
                                        <div class="col-md-8">
                                            <input type="checkbox" name="banner_link_type" id="banner_link_type" value="external" <?php
                                            if ($banner_link_type == 'external') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> <em style="color: #962929">is external ?</em>
                                        </div> 
                                    </div>

                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateBanner" name="btnCreateBanner" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Banner</button>
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
            $("#banner_details").kendoEditor({
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
        $("#ban").addClass("active");
        $("#ban").parent().parent().addClass("active");
        $("#ban").parent().addClass("in");
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateBanner").click(function () {
                var banner_title = $("#banner_title").val();
                var banner_priority = $("#banner_priority").val();

                if (banner_title === "") {
                    $("#bannerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Banner title required</em></strong></div>');
                } else if (banner_priority === "") {
                    $("#bannerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Banner priority required</em></strong></div>');
                } else {
                    $("#createBanner").submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $("#banlist").addClass("active");
        $("#banlist").parent().parent().addClass("active");
        $("#banlist").parent().addClass("in");
    </script>


    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>