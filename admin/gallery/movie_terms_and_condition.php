<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$id = "";
$movie_condition = "";
//$event_id = "";
//$item_file = "";
//$payment_method_id = "";
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
//$event_id = 0;
//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
//$eventarray = array();
//$eventssql = "SELECT event_id,event_title FROM events";
//$eventresult = mysqli_query($con, $eventssql);
//if ($eventresult) {
//    while ($eventobj = mysqli_fetch_object($eventresult)) {
//        $eventarray[] = $eventobj;
//    }
//} else {
//    if (DEBUG) {
//        $err = "resultEvent error: " . mysqli_error($con);
//    } else {
//        $err = "resultEvent query failed.";
//    }
//}





//$payarray = array();
//$paysql = "SELECT id,name FROM payment_method";
//$payquery = mysqli_query($con, $paysql);
//$paycheck = mysqli_num_rows($payquery);
//if ($paycheck != 0) {
//    while ($payrow = mysqli_fetch_object($payquery)) {
//        $payarray[] = $payrow;
//    }
//}
//echo $paycheck;
//exit();


if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);
    //alert sms show 
    if (empty($movie_condition)) {
        $err = "Please write text";
    }

    if (!empty($movie_condition)) { //alert sms show data exit already
        $insert_iteam = "";
       // $insert_iteam .= "event_id = '" . $event_id . "'";
        $insert_iteam .= "description	 = '" .$movie_condition . "'";
        $insert_iteam .= ",date = '" . date('Y-m-d') . "'";
        $insert_iteam .= ",status = '1'";
        $sql_insert_iteam = "INSERT INTO movie_terms_and_condition SET $insert_iteam ";
        $iteam_result = mysqli_query($con, $sql_insert_iteam);
       
       if ($iteam_result == 1) {
           $msg = "Successfully submit Data.";
        } else {
            $err = "Data submit  failed.";
        }
    }//alert sms show data exit already end 
}



//if (isset($_POST["btnCreateGallery"])) {
//    extract($_POST);
//    if (empty($event_id || $id)) {
//        $err = "Please Select a event name & eventwise payment method";
//    }
//
//    $asd = 0;
//    if (!empty($event_id)) {
//        foreach ($_POST['city_id'] as $index => $value) {
//
//
//            $insert_sql = "INSERT INTO eventwise_delivery_charge SET city_id='" . $value . "', delivery_charge='" . $_POST['cost'][$index] . "',event_id='" . $event_id . "'";
//            $ins = mysqli_query($con, $insert_sql);
//            if ($ins == 1) {
//                $asd+=1;
//            } else {
//                $asd+=0;
//            }
//            // echo $value."<br>";
//        }
//    }
//
//    if ($asd != 0) {
//        $msg = "Successfully Inserted";
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
            <h3 class="bg-white content-heading border-bottom strong"> Add Movie and Condition </h3>

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
<!--                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Event Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="eventname_id" name="event_id">
                                                <option value="0">Select Event</option>
                                                <?php //if (count($eventarray) >= 1): ?>
                                                    <?php //foreach ($eventarray as $events): ?>
                                                        <option value="<?php //echo $events->event_id; ?>"><?php// echo $events->event_title; ?></option>
                                                    <?php// endforeach; ?>
                                                <?php// endif; ?>
                                            </select>
                                        </div>
                                    </div>-->

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Description</label>
                                        <div class="col-md-8">
                                            <textarea id="movie_condition" name="movie_condition" rows="6" cols="50"><?php //echo $announcement_long_desc; ?></textarea>
                                        </div>
                                    </div>

                                    <!--                                    <div class="form-group">
                                                                            //<div class="col-md-12"><h4 class="page-header">Please Add Your Delivery Cost Based On City Name</h4></div>
                                                                            <div class="col-md-12">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>City ID</th>
                                                                                            <th>City Name</th>
                                                                                            <th>Delivery Charge/Cost</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                    <?php //foreach //($cityarray as $city) {  ?>
                                                                                            <tr>
                                                                                                <td><?php //echo $city->city_id;    ?></td>
                                                                                                <td>
                                    <?php //echo $city->city_name;  ?>
                                                                                                    <input type="hidden" name="city_id[]" value="<?php //echo $city->city_id;   ?>" />
                                                                                                </td>
                                                                                                <td><input type="text" name="cost[]" placeholder="Type Your Delivery Cost" class="form-control"></td>
                                                                                            </tr>
                                    <?php //}  ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
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
        $("#movietermscondition").addClass("active");
        $("#movietermscondition").parent().parent().addClass("active");
        $("#movietermscondition").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>




