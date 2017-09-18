<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

//include '../../lib/Zebra_Image.php';
$arrMarchents = array();
$get_Marchents = "SELECT clients_id,clients_name FROM clients GROUP BY clients_id";
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

$arrEvents = array();
$get_Events = "SELECT event_id, event_title FROM events GROUP BY event_id";
$resultEvents = mysqli_query($con, $get_Events);
if ($resultEvents) {
    while ($obj = mysqli_fetch_object($resultEvents)) {
        $arrEvents[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

//$merchant_id = "";
//$event_id = "";
//
//
//if (isset($_POST["btnCreateMerchantGallery"])) {
//    extract($_POST);
//
//
//    $merchant_id = mysqli_real_escape_string($con, $merchant_id);
//    $event_id = mysqli_real_escape_string($con, $event_id);
//    $merchant_gal_created_on = date("Y-m-d");
//
//    $insert_MerGalArray = '';
//    $insert_MerGalArray .= ' merchant_id = "' . $merchant_id . '"';
//    $insert_MerGalArray .= ', event_id = "' . $event_id . '"';
//    $insert_MerGalArray .= ', date = "' . $merchant_gal_created_on . '"';
//
//
//
//    $checkMerGal = "SELECT * FROM merchant_wise_event_gallery WHERE event_id = '$event_id'";
//    $checkMerGalResult = mysqli_query($con, $checkMerGal);
//    $countMerGal = mysqli_num_rows($checkMerGalResult);
//    if ($countMerGal >= 1) {
//        $err = "Event name already exists";
//    } else {
//        $run_insert_MerGalArray = "INSERT INTO merchant_wise_event_data SET $insert_MerEvntArray";
//
//        $resultMerGalInsert = mysqli_query($con, $run_insert_MerGalArray);
//        //echo var_dump($resultMerEvntInsert);
//        //exit();
//        if ($resultMerGalInsert) {
//            $msg = "Mechant's Gallery saved successfully";
//            //$link = "merchant_wise_event_list.php?msg=" . base64_encode($msg);
//            //redirect($link);
//        } else {
//            if (DEBUG) {
//                $err = "resultMerEvntInsert error: " . mysqli_error($con);
//            } else {
//                $err = "resultMerEvntInsert query failed.";
//            }
//        }
//    }
//}
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
            <h3 class="bg-white content-heading border-bottom strong">Add Merchant-wise Gallery</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" action="insert_set_merchant_gallery.php" autocomplete="off" id="createClient" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="merchant-event-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="MerchantTitle">Merchant Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="merchant_id" name="merchant_id">
                                                <option value="0">Select Merchant</option>
                                                <?php if (count($arrMarchents) >= 1): ?>
                                                    <?php foreach ($arrMarchents as $marchents): ?>
                                                        <option <?php
                                                        if (isset($_GET['merchant_id'])) {
                                                            if ($_GET['merchant_id'] == $marchents->clients_id) {
                                                                ?> selected="selected" <?php
                                                                }
                                                            }
                                                            ?> value="<?php echo $marchents->clients_id; ?>">
                                                            <?php echo $marchents->clients_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select><br>
                                            <div class="form-actions">
                                                <button type="button"  id="btnCreateMerchantGallery" name="btnCreateMerchantGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Load Merchant's Event List</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="event_gallery" class="widget widget-inverse" data-toggle="collapse-widget">
                        <div class="widget-head"><h4 class="heading">Event Gallery</h4></div>
                        <div class="widget-body">

                            <!-- Table -->
                            <table class="table table-striped table-responsive swipe-horizontal table-primary">

                                <!-- Table heading -->
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Event Photo</th>
                                        <th>Select to set as banner</th>
                                    </tr>
                                </thead>
                                <!-- // Table heading END -->

                                <!-- Table body -->
                                <tbody id="merEvntList">

                                    <!-- Table row -->

                                    <!-- // Table row END -->



                                </tbody>
                                <!-- // Table body END -->

                            </table>
                            <!-- // Table END -->
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnMerGal" name="btnMerGal" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save Gallery Banners</button>
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

    <script type="text/javascript">
        $("#merchant-events-gallery").addClass("active");
        $("#merchant-events-gallery").parent().parent().addClass("active");
        $("#merchant-events-gallery").parent().addClass("in");
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#event_gallery').hide();
            $("#btnCreateMerchantGallery").click(function () {
                var merchant_id = $('#merchant_id').val();
                //$('#event_gallery').show('slow');
                //var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;
                if (merchant_id === "") {
                    $("#merchant-gallery-error").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Merchant name required</em></strong></div>');
                } else if (merchant_id !='0') {
                    $.post('load_merchant_wise_gallery.php', {'st': 1, 'merchant_id': merchant_id}, function (fetchs) {
                        if(fetchs !='0') {
                            $('#event_gallery').show('slow');
                            $('tbody#merEvntList').html(fetchs);
                        }
                    });
                    $("#merchant-gallery-error").html("");
                }
            });
        });

<?php /*
  if (isset($_GET['merchant_id'])) {
  ?>
  $('#event_gallery').show('slow');
  $.post('load_merchant_wise_gallery.php', {'st': 1, 'merchant_id': merchant_id}, function (fetchsd) {
  $('tbody#merEvntList').html(fetchsd);
  });
  $("#merchant-gallery-error").html("");
  <?php } */ ?>

    </script>



    //<?php
//    if (isset($_POST['btnMerGal'])) {
//        if (!empty($_POST['check_list'])) {
//            // Counting number of checked checkboxes.
//            $checked_count = count($_POST['check_list']);
//            echo "You have selected following " . $checked_count . " option(s): <br/>";
//            // Loop to store and display values of individual checked checkbox.
//            foreach ($_POST['check_list'] as $selected) {
//                echo "<p>" . $selected . "</p>";
//            }
//            //echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";
//        } else {
//            echo "<b>Please Select Atleast One Event.</b>";
//        }
//    }
//    
    ?>



    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>