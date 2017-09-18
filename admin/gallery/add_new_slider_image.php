

<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$cid = "";
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
$event_id = "";


$category_array = array();
$sqlcat = mysqli_query($con, "SELECT category_id,category_title FROM categories");
$rowcate = mysqli_num_rows($sqlcat);
if ($rowcate != 0) {
    while ($caterows = mysqli_fetch_object($sqlcat)) {
        $category_array[] = $caterows;
    }
}




if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);


    if (!empty($_FILES["image_file"]["tmp_name"])) {
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'categoryid-' . $category_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
        $gallery_image_source = $_FILES["image_file"]["tmp_name"];
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/', 0777, TRUE);
        }

        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["image_file"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;

        if (!(move_uploaded_file($gallery_image_source, $image_target_path))) {
            $err = "Gallery image upload failed." . $IG_image_name;
        } else {
            $ins = '';
            $ins .="cid='" . $category_id . "'";
            $ins .=",event_id='" . $event_id . "'";
            $ins .=",image='" . $IG_image_name . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='1'";

            $sqlins = "INSERT INTO category_slider SET " . $ins;

            $sqlinsimg = mysqli_query($con, $sqlins);
            if ($sqlinsimg == 1) {
                $msg = "Gallery image upload Successfully.";
                $link = "category_slider_list.php?msg=" . base64_encode($msg);
                redirect($link);
            } else {
                $err = "run_insert_query` error: " . mysqli_error($con);
            }
//                    else
//                    {
//                        $err = "Gallery image upload failed.";
//                    }
        }
    }
}


if (isset($_POST["btnEditGallery"])) {
    extract($_POST);


    if (!empty($_FILES["image_file"]["tmp_name"])) {
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'categoryid-' . $category_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
        $gallery_image_source = $_FILES["image_file"]["tmp_name"];
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/image_file/original/', 0777, TRUE);
        }

        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["image_file"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/image_file/original/' . $IG_image_name;

        if (!(move_uploaded_file($gallery_image_source, $image_target_path))) {
            $err = "Gallery image upload failed." . $IG_image_name;
        } else {
            $ins = '';
            $ins .="cid='" . $category_id . "'";
            $ins .=",event_id='" . $event_id . "'";
            $ins .=",image='" . $IG_image_name . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='1'";

            $sqlins = "UPDATE category_slider SET " . $ins . " WHERE id='" . $id . "'";

            $sqlinsimg = mysqli_query($con, $sqlins);
            if ($sqlinsimg == 1) {
                $msg = "Gallery image upload Updated.";
                $link = "category_slider_list.php?msg=" . base64_encode($msg);
                redirect($link);
            } else {
                $err = "run_insert_query` error: " . mysqli_error($con);
            }
//                    else
//                    {
//                        $err = "Gallery image upload failed.";
//                    }
        }
    } else {
        $ins = '';
        $ins .="cid='" . $category_id . "'";
        $ins .=",event_id='" . $event_id . "'";
        $ins .=",date='" . date('Y-m-d') . "'";
        $ins .=",status='1'";

        $sqlins = "UPDATE category_slider SET " . $ins . " WHERE id='" . $id . "'";

        $sqlinsimg = mysqli_query($con, $sqlins);
        if ($sqlinsimg == 1) {
            $msg = "Gallery image upload Updated.";
            $link = "category_slider_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            $err = "run_insert_query` error: " . mysqli_error($con);
        }
    }
}

//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $slider = "SELECT * FROM category_slider WHERE  id = '" . $id . "'";
    $sliderarray = array();
    $slidercount = mysqli_query($con, $slider);
    $sliderchk = mysqli_num_rows($slidercount);
    if ($sliderchk != 0) {
        while ($sliderrow = mysqli_fetch_object($slidercount)) {
            $sliderarray[] = $sliderrow;
        }
    }
}
//edit option for discount end
//  echo var_dump($sliderarray);
//   exit();
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



            <div class="innerAll spacing-x2">
                <?php
                include basePath('admin/message.php');
                if (isset($_GET['id'])) {
                    ?>
                    <h3 class="bg-white content-heading border-bottom strong">Category Slider </h3>
                    <form class="form-horizontal" method="post" id="createGallery" enctype="multipart/form-data">

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
                                            <label class="col-md-4 control-label" for="itemType">Category name</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option  value="0">Select Category</option>

                                                    <?php
                                                    if (!empty($category_array)) {
                                                        foreach ($category_array as $sdarray):
                                                            ?>
                                                            <option  <?php if ($sliderarray[0]->cid == $sdarray->category_id) { ?> selected="selected" <?php } ?> value="<?php echo $sdarray->category_id; ?>"><?php echo $sdarray->category_title; ?></option>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                </select>
                                                <script>
                                                    $(document).ready(function () {
                                                        <?php 
                                                        if($sliderarray[0]->cid!=0)
                                                        {
                                                            ?>
                                                            var cat_ids='<?php echo $sliderarray[0]->cid; ?>';
                                                            load_event_lists = {'category_id':cat_ids,'event_id':'<?php echo $sliderarray[0]->event_id;  ?>'};
                                                            $.post('load_catwise_events.php', load_event_lists, function (datas) {
                                                                $('#evl_data').html(datas);
                                                            });        
                                                            <?php
                                                        }
                                                        ?>
                                                        $('#category_id').change(function () {
                                                            //alert(this.value); // or $(this).val()
                                                            var cat_id=$(this).val();
                                                            load_event_list = {'category_id':cat_id};
                                                            $.post('load_catwise_events.php', load_event_list, function (data) {
                                                                $('#evl_data').html(data);
                                                            });
                                                        });
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemType">Event name</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="event_id" id="evl_data">
                                                    
                                                </select>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                         
                                        <!--for category wise event list start -->
                                        
                                        <!--for category wise event list end-->

                                        <div class="form-group" id="imageLink">
                                            <label class="col-md-4 control-label">Image File</label>
                                            <div class="col-md-8">
                                                <input type="file" name="image_file" id="image_file"/>
                                                <input type="hidden" value="<?php echo $sliderarray[0]->image; ?>" name="image_file_hidden" id="image_file"/>
                                                <br>
                                                <img width="100" src="<?php echo baseUrl(); ?>upload/image_file/original/<?php echo $sliderarray[0]->image; ?>" class="img-responsive" />
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btnEditGallery" name="btnEditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Gallery</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                </div>



                <h3 class="bg-white content-heading border-bottom strong">Category Slider </h3>

                <div class="innerAll spacing-x2">
                    <?php include basePath('admin/message.php'); ?>
                    <form class="form-horizontal" method="post" id="createGallery" enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>


                                         
                                         <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemType">Category name</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option  value="0">Select Category</option>

                                                    <?php
                                                    if (!empty($category_array)) {
                                                        foreach ($category_array as $sdarray):
                                                            ?>
                                                            <option value="<?php echo $sdarray->category_id; ?>"><?php echo $sdarray->category_title; ?></option>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                </select>
                                                <script>
                                                    $(document).ready(function () {
                                                        
                                                        $('#category_id').change(function () {
                                                            //alert(this.value); // or $(this).val()
                                                            var cat_id=$(this).val();
                                                            load_event_list = {'category_id':cat_id};
                                                            $.post('load_catwise_events.php', load_event_list, function (data) {
                                                                $('#evl_data').html(data);
                                                            });
                                                        });
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemType">Event name</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="event_id" id="evl_data">
                                                    
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group" id="imageLink">
                                            <label class="col-md-4 control-label">Image File</label>
                                            <div class="col-md-8">
                                                <input type="file" name="image_file" id="image_file"/>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btnCreateGallery" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Gallery</button>
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


    <script type="text/javascript">
        $("#catslider").addClass("active");
        $("#catslider").parent().parent().addClass("active");
        $("#catslider").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>