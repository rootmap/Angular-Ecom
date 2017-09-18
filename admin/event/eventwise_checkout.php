<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$id = "";
//$name = "";
$event_id = "";
//$item_file = "";
$checkout_id = "";
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
$eventarray = array();
$eventssql = "SELECT event_id,event_title FROM events";
$eventresult = mysqli_query($con, $eventssql);
if ($eventresult) {
    while ($eventobj = mysqli_fetch_object($eventresult)) {
        $eventarray[] = $eventobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}





$payarray = array();
$paysql = "SELECT id,name FROM event_checkout_type";
$payquery = mysqli_query($con, $paysql);
$paycheck = mysqli_num_rows($payquery);
if ($paycheck != 0) {
    while ($payrow = mysqli_fetch_object($payquery)) {
        $payarray[] = $payrow;
    }
}
//echo $paycheck;
//exit();


if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);
    //alert sms show 
    if (empty($event_id) || empty($checkout_id)) {
        $err = "Please select a event name and  checkout name";
    }

    if (!empty($event_id) && !empty($checkout_id)) { //alert sms show data exit already
        $insert_iteam = "";
        $insert_iteam .= "event_id = '" . $event_id . "'";
        $insert_iteam .= ",checkout_id = '" . $checkout_id. "'";
        $insert_iteam .= ",date = '" . date('Y-m-d') . "'";
        $insert_iteam .= ",status = '1'";
        $sql_insert_iteam = "INSERT INTO eventwise_checkout SET $insert_iteam ";
        $iteam_result = mysqli_query($con, $sql_insert_iteam);
       
       if ($iteam_result == 1) {
           $msg = "Successfully submit Data.";
            $link = "eventwise_checkout_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            $err = "Data submit  failed.";
        }
    }//alert sms show data exit already end 
}

//edit option for eventwise payment method start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $evtwisepy = "SELECT * FROM  eventwise_checkout WHERE id = '" . $id . "'";
    $eventpayarray = array();
    $sqlentpay = mysqli_query($con, $evtwisepy);
    $evtpaychk = mysqli_num_rows($sqlentpay);
    if ($evtpaychk != 0) {
        while ($chairtyrow = mysqli_fetch_object($sqlentpay)) {
            $eventpayarray[] = $chairtyrow;
        }
    }
}
//edit option for eventwise payment method  end
//    echo var_dump($chairtyarray);
//    exit();
//<!---update option eventwise payment method start--->
if (isset($_POST["btnEditGallery"])) {
    extract($_POST);
    //alert sms show 
    if (empty($event_id) || empty($checkout_id)) {
        $err = "Please select a event name and  checkout name";
    }

    if (!empty($event_id) && !empty($checkout_id)) { //alert sms show data exit already
        $insert_iteam = "";
        $insert_iteam .= "event_id = '" . $event_id . "'";
        $insert_iteam .= ",checkout_id = '" . $checkout_id . "'";
        $insert_iteam .= ",date = '" . date('Y-m-d') . "'";
        $insert_iteam .= ",status = '1'";
        $sql_insert_iteam = "UPDATE eventwise_checkout SET $insert_iteam where id='". $id ."'";
        $iteam_result = mysqli_query($con, $sql_insert_iteam);
       
       if ($iteam_result == 1) {
           $msg = "Successfully submit Data.";
            $link = "eventwise_checkout_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            $err = "Data submit  failed.";
        }
    }//alert sms show data exit already end 
}
//<!---update option eventwise payment method end--->
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
            <?php include basePath('admin/message.php');
                if (isset($_GET['id'])){
                ?>
            
            
            <h3 class="bg-white content-heading border-bottom strong">Edit Eventwise Checkout </h3>

             
            
                
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGallery" enctype="multipart/form-data">

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
                                        <label class="col-md-4 control-label" for="venueTitle">Event Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="eventname_id" name="event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($eventarray) >= 1): ?>
                                                    <?php foreach ($eventarray as $events): ?>
                                                        <option <?php if ($eventpayarray[0]->event_id == $events->event_id) { ?> selected="selected" <?php } ?> value="<?php echo  $events->event_id; ?>">
                                                            <?php echo  $events->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Checkout Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="checkout_id" name="checkout_id">
                                                <option value="0">Select Name</option>
                                                <?php if (count($payarray) >= 1): ?>
                                                    <?php foreach ($payarray as $chkout): ?>
                                                        <option <?php if ($eventpayarray[0]->checkout_id == $chkout->id) { ?> selected="selected" <?php } ?> value="<?php echo  $chkout->id; ?>"><?php echo  $chkout->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                              </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnEditGallery" name="btnEditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Record</button>
                            </div>
                        </div>
                    </div>
                </form>
               
            </div>
         <?php } else { ?>
            
            
            
            
            
            <h3 class="bg-white content-heading border-bottom strong "> Add Eventwise Checkout </h3>

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
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Event Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="eventname_id" name="event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($eventarray) >= 1): ?>
                                                    <?php foreach ($eventarray as $events): ?>
                                                        <option value="<?php echo $events->event_id; ?>"><?php echo $events->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle"> Checkout Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="checkout_id" name="checkout_id">
                                                <option value="0">Select Name</option>
                                                <?php if (count($payarray) >= 1): ?>
                                                    <?php foreach ($payarray as $chkout): ?>
                                                        <option value="<?php echo  $chkout->id; ?>"><?php echo  $chkout->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
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
        $("#eventwisechkout").addClass("active");
        $("#eventwisechkout").parent().parent().addClass("active");
        $("#eventwisechkout").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>






