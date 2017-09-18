
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
//$item_file = "";
$name = "";
//$VG_event_id = "";
//$VG_title = "";
//$VG_description = "";
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

    //echo var_dump($_POST);
    //exit();
    // video link save start
   $name  = mysqli_real_escape_string($con, $name);
    //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'name = "' . $payment_method . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


    $run_eedc_array_sql = "INSERT INTO payment_method SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Payment add successfully";
        $link = "list_of_payment_method.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}

if (isset($_POST["btnEditGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
   $id = mysqli_real_escape_string($con, $id);
   $name  = mysqli_real_escape_string($con, $name);
    //$extra_event_cost = mysqli_real_escape_string($con, $extra_event_cost);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'name = "' . $payment_method . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


    $run_eedc_array_sql = "UPDATE payment_method SET $insert_eedc_array WHERE id = ' ". $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = "Payment add Updated";
        $link = "list_of_payment_method.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}

//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $slider = "SELECT * FROM payment_method WHERE  id = '" . $id . "'";
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
//   echo var_dump($sliderarray);
//    exit();
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
            <h3 class="bg-white content-heading border-bottom strong">Payment Method</h3>

            <div class="innerAll spacing-x2">
                <?php
                include basePath('admin/message.php');
                if (isset($_GET['id'])) {
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
                                        <label class="col-md-4 control-label" for="itemTitle">Add Payment Method Name</label>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $sliderarray[0]->name; ?>" id="payment_method_title" name="payment_method"  type="text"/></div>
                                    </div>
                                  </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnEditGallery" name="btnEditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </form>
              <?php } else {  ?>
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
                                        <label class="col-md-4 control-label" for="itemTitle">Add Payment Method Name</label>
                                        <div class="col-md-8"><input class="form-control" id="payment_method_title" name="payment_method"  type="text"/></div>
                                    </div>
 

                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreateEDC" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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

    </div> 



    <script type="text/javascript">
        $("#listofpaymentmethod").addClass("active");
        $("#listofpaymentmethod").parent().parent().addClass("active");
        $("#listofpaymentmethod").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

