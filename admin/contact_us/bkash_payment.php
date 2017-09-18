

<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$transaction_id = "";
$order_id = "";
$order_amount = "";
$full_name = "";
$phone_number = "";
$record_date = "";
$status_id = "";

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
$transaction_id = 0;

//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
//$bkasharray = array();
//$get_bkash = "SELECT * FROM bkash_transaction_module";
//$resultbkash = mysqli_query($con, $get_bkash);
//if ($resultbkash) {
//    while ($obj = mysqli_fetch_object($resultbkash)) {
//       $bkasharray[] = $obj;
//    }
//} else {
//    if (DEBUG) {
//        $err = "Bkash paymnet error: " . mysqli_error($con);
//    } else {
//        $err = "Bkash paymnet failed.";
//    }
//}
//insert bkash option start
if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $transaction_id = mysqli_real_escape_string($con, $transaction_id);
    $order_id = mysqli_real_escape_string($con, $order_id);
    $order_amount = mysqli_real_escape_string($con, $order_amount);
    $full_name = mysqli_real_escape_string($con, $full_name);
    $phone_number = mysqli_real_escape_string($con, $phone_number);
    $record_date = mysqli_real_escape_string($con, $record_date);
    $status_id = mysqli_real_escape_string($con, $status_id);
    //$VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' transaction_id = "' . $transaction_id . '"';
    $insert_eedc_array .= ',order_id = "' . $order_id . '"';
    $insert_eedc_array .= ',paid_amount = "' . $order_amount . '"';
    $insert_eedc_array .= ',full_name = "' . $full_name . '"';
    $insert_eedc_array .= ',phone_number = "' . $phone_number . '"';
    $insert_eedc_array .= ',date = "' . $record_date . '"';
    $insert_eedc_array .= ',status = "' . $status_id . '"';

    //$run_eedc_array_sql = "UPDATE bkash_transaction_module SET $insert_eedc_array WHERE id='$id'";
    $run_eedc_array_sql = "INSERT INTO bkash_transaction_module SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "Bkash transaction error: " . mysqli_error($con);
        } else {
            $err = "Bkash transaction failed.";
        }
    } else {
        $msg = "Bkash transactiont saved successfully";
        $link = "bkash_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    
    
    // Video link save end
    // Image file save start
    // Image file save end
}//Insert bkash option end


//Update bkash option start
if (isset($_POST["btnEdit"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $id = mysqli_real_escape_string($con, $id);
    $transaction_id = mysqli_real_escape_string($con, $transaction_id);
    $order_id = mysqli_real_escape_string($con, $order_id);
    $order_amount = mysqli_real_escape_string($con, $order_amount);
    $full_name = mysqli_real_escape_string($con, $full_name);
    $phone_number = mysqli_real_escape_string($con, $phone_number);
    $record_date = mysqli_real_escape_string($con, $record_date);
    $status_id = mysqli_real_escape_string($con, $status_id);
    //$VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= ' transaction_id = "' . $transaction_id . '"';
    $insert_eedc_array .= ',order_id = "' . $order_id . '"';
    $insert_eedc_array .= ',paid_amount = "' . $order_amount . '"';
    $insert_eedc_array .= ',full_name = "' . $full_name . '"';
    $insert_eedc_array .= ',phone_number = "' . $phone_number . '"';
    $insert_eedc_array .= ',date = "' . $record_date . '"';
    $insert_eedc_array .= ',status = "' . $status_id . '"';

    $run_eedc_array_sql = "UPDATE bkash_transaction_module SET $insert_eedc_array WHERE id='$id'";
    
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "Bkash transaction error: " . mysqli_error($con);
        } else {
            $err = "Bkash transaction failed.";
        }
    } else {
        $msg = "Bkash transactiont Updated successfully";
        $link = "bkash_payment.php?msg=" . base64_encode($msg)."&id=".$id;
        redirect($link);
    }
    
    
    // Video link save end
    // Image file save start
    // Image file save end
}
//Update bkash option end

//edit bkash option start
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $bkashedit = "SELECT * FROM bkash_transaction_module WHERE id = '" . $id . "'";
    $bkasheditarray =  array();
    $sqlbkash =  mysqli_query($con, $bkashedit);
    $bkashcheck=  mysqli_num_rows($sqlbkash);
      if($bkashcheck != 0){
          while($bkashrow = mysqli_fetch_object($sqlbkash)){
                $bkasheditarray[]= $bkashrow;
    
          }
      }
}

//echo var_dump($bkasheditarray);
//edit bkash option end

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
            <h3 class="bg-white content-heading border-bottom strong"> Add Bkash Transaction </h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); 
                
                if(isset($_GET['id'])){
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
                                    
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Transaction ID</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $bkasheditarray[0]->transaction_id; ?>" id="transaction_id" name="transaction_id"  type="text"/></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Order ID</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $bkasheditarray[0]->order_id; ?>" id="order_id" name="order_id"  type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Paid amount</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $bkasheditarray[0]->paid_amount; ?>" id="order_amount" name="order_amount"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Full Name</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $bkasheditarray[0]->full_name; ?>" id="full_name" name="full_name"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Phone Number</label>
                                        <div class="col-md-8"><input class="form-control"  value="<?php echo $bkasheditarray[0]->phone_number; ?>" id="phone_number" name="phone_number"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Date</label>
                                        <div class="col-md-8"><input class="form-control" value="<?php echo $bkasheditarray[0]->date; ?>" id="record_date" name="record_date"  type="text"/></div>

                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="status_id" name="status_id">
                                                <option <?php if($bkasheditarray[0]->status==0){ ?> selected="selected" <?php } ?> value="0">Select Status</option>
                                                <option <?php if($bkasheditarray[0]->status=="aprove"){ ?> selected="selected" <?php } ?> value="aprove">Aprove</option>
                                                <option <?php if($bkasheditarray[0]->status=="not_aprove"){ ?> selected="selected" <?php } ?> value="not_aprove">Not Aprove</option>
                                                 <option <?php if($bkasheditarray[0]->status=="pending"){ ?> selected="selected" <?php } ?> value="pending">Pending</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnEditEDC" name="btnEdit" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Change Record</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 
                }
                else
                {
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
                                        <label class="col-md-4 control-label" for="itemTitle">Transaction ID</label>
                                        <div class="col-md-8"><input class="form-control" id="transaction_id" name="transaction_id"  type="text"/></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Order ID</label>
                                        <div class="col-md-8"><input class="form-control" id="order_id" name="order_id"  type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Paid amount</label>
                                        <div class="col-md-8"><input class="form-control" id="order_amount" name="order_amount"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Full Name</label>
                                        <div class="col-md-8"><input class="form-control" id="full_name" name="full_name"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Phone Number</label>
                                        <div class="col-md-8"><input class="form-control" id="phone_number" name="phone_number"  type="text"/></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemDescription">Date</label>
                                        <div class="col-md-8"><input class="form-control" id="record_date" name="record_date"  type="text"/></div>

                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="status_id" name="status_id">
                                                <option value="0">Select Status</option>
                                                <option value="aprove">Aprove</option>
                                                <option value="not_aprove">Not Aprove</option>
                                                <option value="pending">Pending</option>

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
                <?php 
                }
                ?>
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
        $("#bkashtranlist").addClass("active");
        $("#bkashtranlist").parent().parent().addClass("active");
        $("#bkashtranlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

