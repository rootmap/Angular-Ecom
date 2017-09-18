



<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

//$event_id = "";
//$item_description = "";
$id = "";
$post_title = "";
//$name = "";
$post_content = "";
//$media_publish_date = "";
$post_image = "";
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

if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);




    //image upload start from here


    if (!empty($_FILES["image_file"]["tmp_name"])) {

        /*         * *****Renaming the image file******** */
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MediaRecID-' . $post_title . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
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
        } else {
            $post_title = mysqli_real_escape_string($con, $post_title);
            $post_content = mysqli_real_escape_string($con, $post_content);
            //$media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
            $post_image = mysqli_real_escape_string($con, $IG_image_name);
            //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
            $VG_created_on = date("Y-m-d");
            //$VG_created_by = getSession("admin_id");

            $insert_eedc_array = '';
            $insert_eedc_array .= 'post_title = "' . $post_title . '"';
            $insert_eedc_array .= ',post_content = "' . $post_content . '"';
            $insert_eedc_array .= ',post_image = "' . $post_image . '"';
            $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


            $run_eedc_array_sql = "INSERT INTO media_recent_post SET $insert_eedc_array";
            $result = mysqli_query($con, $run_eedc_array_sql);

            if (!$result) {
                if (DEBUG) {
                    $err = "run_video_array_sql error: " . mysqli_error($con);
                } else {
                    $err = "run_video_array_sql query failed.";
                }
            } else {
                $msg = " Add media content successfully";
                $link = "recent_post_content.php?msg=" . base64_encode($msg);
                redirect($link);
            }
        }
    }
    //image upload end from here
    //echo var_dump($_POST);
    //exit();
    // video link save start
    // Video link save end
    // Image file save start
    // Image file save end
}

//edit start
if (isset($_POST["btneditGallery"])) {
    extract($_POST);




    //image upload start from here


    if (!empty($_FILES["image_file"]["tmp_name"])) {

        /*         * *****Renaming the image file******** */
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MediaRecID-' . $post_title . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
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
        } else {
            $post_title = mysqli_real_escape_string($con, $post_title);
            $post_content = mysqli_real_escape_string($con, $post_content);
            //$media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
            $post_image = mysqli_real_escape_string($con, $IG_image_name);
            //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
            $VG_created_on = date("Y-m-d");
            //$VG_created_by = getSession("admin_id");

            $insert_eedc_array = '';
            $insert_eedc_array .= 'post_title = "' . $post_title . '"';
            $insert_eedc_array .= ',post_content = "' . $post_content . '"';
            $insert_eedc_array .= ',post_image = "' . $post_image . '"';
            $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


            $run_eedc_array_sql = "UPDATE media_recent_post SET $insert_eedc_array WHERE id = '" . $id . "'";
            $result = mysqli_query($con, $run_eedc_array_sql);

            if (!$result) {
                if (DEBUG) {
                    $err = "run_video_array_sql error: " . mysqli_error($con);
                } else {
                    $err = "run_video_array_sql query failed.";
                }
            } else {
                $msg = " Edit media content successfully";
                $link = "recent_post_list.php?msg=" . base64_encode($msg);
                redirect($link);
            }
        }
    } else {
        $post_title = mysqli_real_escape_string($con, $post_title);
        $post_content = mysqli_real_escape_string($con, $post_content);
        //$media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
        //$post_image = mysqli_real_escape_string($con, $IG_image_name);
        //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
        $VG_created_on = date("Y-m-d");
        //$VG_created_by = getSession("admin_id");

        $insert_eedc_array = '';
        $insert_eedc_array .= 'post_title = "' . $post_title . '"';
        $insert_eedc_array .= ',post_content = "' . $post_content . '"';
        $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


        $run_eedc_array_sql = "UPDATE media_recent_post SET $insert_eedc_array WHERE id = '" . $id . "'";
        $result = mysqli_query($con, $run_eedc_array_sql);

        if (!$result) {
            if (DEBUG) {
                $err = "run_video_array_sql error: " . mysqli_error($con);
            } else {
                $err = "run_video_array_sql query failed.";
            }
        } else {
            $msg = " Edit media content successfully";
            $link = "recent_post_list.php?msg=" . base64_encode($msg);
            redirect($link);
        }
    }
    //image upload end from here
    //echo var_dump($_POST);
    //exit();
    // video link save start
    // Video link save end
    // Image file save start
    // Image file save end
}
//edit end
//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $recpst = "SELECT * FROM media_recent_post WHERE  id = '" . $id . "'";
    $recpstarray = array();
    $recpstcount = mysqli_query($con, $recpst);
    $recpstchk = mysqli_num_rows($recpstcount);
    if ($recpstchk != 0) {
        while ($recpstrow = mysqli_fetch_object($recpstcount)) {
            $recpstarray[] = $recpstrow;
        }
    }
}
//edit option for discount end
//  echo var_dump($recpstarray);
//  exit();
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
            <h3 class="bg-white content-heading border-bottom strong">Recent Post</h3>


            <?php
            include basePath('admin/message.php');
            if (isset($_GET['id'])) {
                ?>
                <div class="innerAll spacing-x2">
                    <form class="form-horizontal margin-none" method="post" autocomplete="off"  enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post  Title</label>
                                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                            <div class="col-md-8"><input class="form-control" value="<?php echo $recpstarray[0]->post_title; ?>" id="post_title" name="post_title"  type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post Content</label>
                                            <div class="col-md-8"><input class="form-control"value="<?php echo $recpstarray[0]->post_content; ?>" id="post_content" name="post_content"  type="text"/></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post Image</label>
                                            <div class="col-md-8">
                                                <input type="file" name="image_file" id="image_file"/>
                                                <input type="hidden" value="<?php echo $recpstarray[0]->post_image; ?>" name="image_file_hidden" id="image_file"/>
                                                <br>
                                                <img width="100" src="<?php echo baseUrl(); ?>upload/image_file/original/<?php echo $recpstarray[0]->post_image; ?>" class="img-responsive" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>Edit Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
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
                                        <!--                                    <div class="form-group">
                                                                                <label class="col-md-4 control-label" for="venueTitle">Event ID</label>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-control" id="event_id" name="event_id">
                                                                                        <option value="0">Select Event</option>
                                        <?php //if //(count($arrEvents) >= 1):  ?>
                                        <?php // foreach //($arrEvents as $events):  ?>
                                                                                                <option value="<?php //echo //$events->event_id;       ?>">
                                        <?php //echo $events->event_title; ?></option>
                                        <?php //endforeach; ?>
                                        <?php //endif;  ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>-->

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post  Title</label>
                                            <div class="col-md-8"><input class="form-control" id="post_title" name="post_title"  type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post Content</label>
                                            <div class="col-md-8"><input class="form-control" id="post_content" name="post_content"  type="text"/></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Post Image</label>
                                            <div class="col-md-8">
                                                <input id="image_file" name="image_file"  type="file"/></div>
                                        </div>
                                        <!--                                    <div class="form-group">
                                                                                <label class="col-md-4 control-label" for="itemDescription">Add Payment Method</label>
                                                                                <div class="col-md-8"><input class="form-control" id="event_cost" name="extra_event_cost"  type="text"/></div>
                                        
                                                                           </div>-->

                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btnCreateEDC" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
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
        $("#recentpostlist").addClass("active");
        $("#recentpostlist").parent().parent().addClass("active");
        $("#recentpostlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

