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

$mov_array = array();
$sqlmov = mysqli_query($con, "SELECT movie_id,name FROM event_movie_list");
$rowmov = mysqli_num_rows($sqlmov);
if ($rowmov != 0) {
    while ($row = mysqli_fetch_object($sqlmov)) {
        $mov_array[] = $row;
    }
}


if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);


    if (!empty($_FILES["image_file"]["tmp_name"])) {
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MovieID-' . $movie_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
        $gallery_image_source = $_FILES["image_file"]["tmp_name"];
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
            $ins = '';
            $ins .="movie_id='" . $movie_id . "'";
            $ins .=",image='" . $IG_image_name . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='1'";

            $sqlins = "INSERT INTO event_movie_gallery_list SET " . $ins;
            $sqlinsimg = mysqli_query($con, $sqlins);
            if ($sqlinsimg == 1) {
                $msg = "Gallery image upload Successfully.";
                $link = "movie_gallery_list.php?msg=" . base64_encode($msg);
                redirect($link);
            } else {
                $err = "Gallery image upload failed.";
            }
        }
    }
}
//UPDATE querry start

if (isset($_POST["btneditGallery"])) {
    extract($_POST);


    if (!empty($_FILES["image_file"]["tmp_name"])) {
        $gallery_image = basename($_FILES['image_file']['name']);
        $info = pathinfo($gallery_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $IG_image_name = 'MovieID-' . $movie_id . '-ImgID-' . time() . '.' . $info; /* create custom image name color id will add  */
        $gallery_image_source = $_FILES["image_file"]["tmp_name"];
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
            $ins = '';
            $ins .="movie_id='" . $movie_id . "'";
            $ins .=",image='" . $IG_image_name . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='1'";

            $sqlins = "UPDATE event_movie_gallery_list SET $ins WHERE id = '" . $id . "'";
              
            $sqlinsimg = mysqli_query($con, $sqlins);
            if ($sqlinsimg == 1) {
                $msg = "Gallery image upload Successfully.";
                $link = "movie_gallery_list.php?msg=" . base64_encode($msg);
                redirect($link);
            } else {
                $err = "Gallery image upload failed.";
            }
        }
    }
}

//UPDATE querry end


//edit option for event movie gallery start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $evtmovie = "SELECT * FROM  event_movie_gallery_list WHERE id = '" . $id . "'";
    $eventgallarray = array();
    $sqlentgall = mysqli_query($con, $evtmovie);
    $evtgallchk = mysqli_num_rows($sqlentgall);
    if ($evtgallchk != 0) {
        while ($eventrow = mysqli_fetch_object($sqlentgall)) {
            $eventgallarray[] = $eventrow;
        }
    }
}
//edit option for event movie gallery  end
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

            <h3 class="bg-white content-heading border-bottom strong">Edit Add Gallery</h3>

            <div class="innerAll spacing-x2">
                <?php
                include basePath('admin/message.php');

                if (isset($_GET['id'])) {
                    ?>
                   
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
                                            <label class="col-md-4 control-label" for="itemType">Select Movie</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="movie_id">
                                                    <option value="0">Select Movie</option>
                                                    <?php
                                                    if (!empty($mov_array)) {
                                                        foreach ($mov_array as $mov):
                                                            ?>
                                                            <option  <?php if ($eventgallarray[0]->movie_id ==$mov->movie_id) { ?> selected="selected" <?php } ?> value="<?php echo $mov->movie_id; ?>">
                                                                <?php echo $mov->name; ?></option>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
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
                                    <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Gallery</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } else { ?>




                <h3 class="bg-white content-heading border-bottom strong">Add Gallery</h3>

                <div class="innerAll spacing-x2">

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
                                            <label class="col-md-4 control-label" for="itemType">Select Movie</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="movie_id">
                                                    <option value="0">Select Movie</option>
                                                    <?php
                                                    if (!empty($mov_array)) {
                                                        foreach ($mov_array as $mov):
                                                            ?>
                                                            <option value="<?php echo $mov->movie_id; ?>"><?php echo $mov->name; ?></option>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
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
            $("#moviegallerylist").addClass("active");
            $("#moviegallerylist").parent().parent().addClass("active");
            $("#moviegallerylist").parent().addClass("in");
        </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>