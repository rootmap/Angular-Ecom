


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
$media_title = "";
$name = "";
$media_content = "";
$media_publish_date = "";
$media_image = "";
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
        $IG_image_name = 'MediaID-' . $event_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
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
            $media_title = mysqli_real_escape_string($con, $media_title);
            $media_content = mysqli_real_escape_string($con, $media_content);
            $media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
            $media_image = mysqli_real_escape_string($con, $IG_image_name);
            //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
            $VG_created_on = date("Y-m-d");
            //$VG_created_by = getSession("admin_id");

            $insert_eedc_array = '';
            $insert_eedc_array .= 'media_title = "' . $media_title . '"';
            $insert_eedc_array .= ',media_content = "' . $media_content . '"';
            $insert_eedc_array .= ',media_publish_date = "' . $media_publish_date . '"';
            $insert_eedc_array .= ',media_image = "' . $media_image . '"';
            $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


            $run_eedc_array_sql = "INSERT INTO ticketchai_media SET $insert_eedc_array";
            $result = mysqli_query($con, $run_eedc_array_sql);

            if (!$result) {
                if (DEBUG) {
                    $err = "run_video_array_sql error: " . mysqli_error($con);
                } else {
                    $err = "run_video_array_sql query failed.";
                }
            } else {
                $msg = " Add media content successfully";
                $link = "media_content_list.php?msg=" . base64_encode($msg);
                redirect($link);
            }
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
    
    
    //update start here
    if (isset($_POST["btneditGallery"])) {
    extract($_POST);
    if (!empty($_FILES["image_file"]["tmp_name"])) {

        /*         * *****Renaming the image file******** */
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MediaID-' . $event_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
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
            $media_title = mysqli_real_escape_string($con, $media_title);
            $media_content = mysqli_real_escape_string($con, $media_content);
            $media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
            $media_image = mysqli_real_escape_string($con, $IG_image_name);
            //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
            $VG_created_on = date("Y-m-d");
            //$VG_created_by = getSession("admin_id");

            $insert_eedc_array = '';
            $insert_eedc_array .= 'media_title = "' . $media_title . '"';
            $insert_eedc_array .= ',media_content = "' . $media_content . '"';
            $insert_eedc_array .= ',media_publish_date = "' . $media_publish_date . '"';
            $insert_eedc_array .= ',media_image = "' . $media_image . '"';
            $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


            $run_eedc_array_sql = "UPDATE ticketchai_media SET $insert_eedc_array WHERE id='".$id."'";
            $result = mysqli_query($con, $run_eedc_array_sql);

            if (!$result) {
                if (DEBUG) {
                    $err = "run_video_array_sql error: " . mysqli_error($con);
                } else {
                    $err = "run_video_array_sql query failed.";
                }
            } else {
                $msg = "edit media content successfully";
                $link = "recent_post_list.php?msg=" . base64_encode($msg);
                redirect($link);
            }
        }
    }else{
            $media_title = mysqli_real_escape_string($con, $media_title);
            $media_content = mysqli_real_escape_string($con, $media_content);
            $media_publish_date = mysqli_real_escape_string($con, $media_publish_date);
            //$media_image = mysqli_real_escape_string($con, $IG_image_name);
            //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
            $VG_created_on = date("Y-m-d");
            //$VG_created_by = getSession("admin_id");

            $insert_eedc_array = '';
            $insert_eedc_array .= 'media_title = "' . $media_title . '"';
            $insert_eedc_array .= ',media_content = "' . $media_content . '"';
            $insert_eedc_array .= ',media_publish_date = "' . $media_publish_date . '"';
            $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


            $run_eedc_array_sql = "UPDATE ticketchai_media SET $insert_eedc_array WHERE id='".$id."'";
            $result = mysqli_query($con, $run_eedc_array_sql);

            if (!$result) {
                if (DEBUG) {
                    $err = "run_video_array_sql error: " . mysqli_error($con);
                } else {
                    $err = "run_video_array_sql query failed.";
                }
            } else {
                $msg = " Edit media content successfully";
                $link = "media_content_list.php?msg=" . base64_encode($msg);
                redirect($link);
            }
        }
        
     
} 
     

//update end 
//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $media = "SELECT * FROM ticketchai_media WHERE  id = '" . $id . "'";
    $mediaarray = array();
    $mediacount = mysqli_query($con, $media);
    $mediachk = mysqli_num_rows($mediacount);
    if ($mediachk != 0) {
        while ($mediarow = mysqli_fetch_object($mediacount)) {
            $mediaarray[] = $mediarow;
        }
    }
}
//edit option for discount end
//    echo var_dump($mediaarray);
//     exit();
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
            <h3 class="bg-white content-heading border-bottom strong">Edit Media Content</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php');
                if (isset($_GET['id'])){
                ?>
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
                                        <label class="col-md-4 control-label" for="itemTitle"> Media  Title</label>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $mediaarray[0]->media_title; ?>"id="media_title" name="media_title"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Media Content</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $mediaarray[0]->media_content;?>" id="media_content" name="media_content"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Media Publish Date</label>
                                        <div class="col-md-8"><input class="form-control"value="<?php echo $mediaarray[0]->media_publish_date;?>" id="media_publish_date" name="media_publish_date"  type="text"/></div>
                                    </div>
                                    <div class="form-group" id="imageLink">
                                            <label class="col-md-4 control-label">Image File</label>
                                            <div class="col-md-8">
                                                <input type="file" name="image_file" id="image_file"/>
                                                <input type="hidden" value="<?php echo $mediaarray[0]->media_image; ?>" name="image_file_hidden" id="image_file"/>
                                                <br>
                                                <img width="100" src="<?php echo baseUrl(); ?>upload/image_file/original/<?php echo $mediaarray[0]->media_image; ?>" class="img-responsive" />
                                            </div>
                                        </div>  
        

                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreateEDC" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>edit Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php }else{?>
                 <h3 class="bg-white content-heading border-bottom strong">Add Media Content</h3>
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
                                        <label class="col-md-4 control-label" for="itemTitle"> Media  Title</label>
                                        <div class="col-md-8"><input class="form-control" id="media_title" name="media_title"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Media Content</label>
                                        <div class="col-md-8"><input class="form-control" id="media_content" name="media_content"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Media Publish Date</label>
                                        <div class="col-md-8"><input class="form-control" id="media_publish_date" name="media_publish_date"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Media Image</label>
                                        <div class="col-md-8">
                                            <input id="media_image" name="image_file"  type="file"/></div>
                                    </div>
        

                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btneditGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php }?>
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
        $("#mediacontentlist").addClass("active");
        $("#mediacontentlist").parent().parent().addClass("active");
        $("#mediacontentlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

