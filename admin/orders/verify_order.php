<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$orderNo = "";
$countOrderNo = 0;
$isVerified = "";
if (isset($_POST['orderNo'])) {
    extract($_POST);
    echo $_POST['orderNo'];
    echo "<br>";
    $orderNo = validateInput($orderNo);
    $orderNo_format = "[" . validateInput($orderNo) . "]";
    $sqldd = "SELECT order_id,order_number FROM orders WHERE order_number='" . $orderNo_format . "'";

    $sqlCheckOrderNo = "SELECT OI_unique_id,OI_is_verified FROM order_items WHERE OI_unique_id = '$orderNo'";

    $resultCheckOrderNo = mysqli_query($con, $sqlCheckOrderNo);
    $countOrderNo = mysqli_num_rows($resultCheckOrderNo);

    $flagnomore = false; // for define barcode two format
    if ($countOrderNo > 0) {
        $msg_order_id = $orderNo;
        $resultCheckOrderNoObj = mysqli_fetch_object($resultCheckOrderNo);
        $isVerified = $resultCheckOrderNoObj->OI_is_verified;
        if ($isVerified === 'yes') {
            $err = "Order number already verified";
            mysqli_query($con, "INSERT INTO order_verification (barcode,datetime,date,status) VALUES ('$orderNo','" . date('h:m D,d/m/2015') . "','" . date('Y-m-d') . "','2')");
        } else {
            $sqlUpdateOrderVefification = "UPDATE order_items SET OI_is_verified='yes' WHERE OI_unique_id='$orderNo'";
            $resultUpdateOrderVerification = mysqli_query($con, $sqlUpdateOrderVefification);
            if ($resultUpdateOrderVerification) {
                $msg = "Order number is verified";
                mysqli_query($con, "INSERT INTO order_verification (barcode,datetime,date,status) VALUES ('$orderNo','" . date('h:m D,d/m/2015') . "','" . date('Y-m-d') . "','1')");
            } else {
                if (DEBUG) {
                    $err = "resultUpdateOrderVerification error: " . mysqli_error($con);
                } else {
                    $err = "resultUpdateOrderVerification query failed.";
                }
            }
        }
        $flagnomore = true;
    } else {
        //format two pattern start
        $resultCheckOrderNof = mysqli_query($con, $sqldd);
        $countOrderNof = mysqli_num_rows($resultCheckOrderNof);
        if ($countOrderNof > 0) {
            $flagnomore = false;
            //generate for multiple days
            $msg_order_id = $orderNo_format;
            //$resultCheckOrderNoObj = mysqli_fetch_object($resultCheckOrderNof);
            //$isVerified = $resultCheckOrderNoObj->OI_is_verified;
            //sql check for daily entry in event.
            
            $sqlgetunique_id=mysqli_query($con,"SELECT * FROM orders WHERE order_number='".$orderNo_format."'");
            $fetunid=  mysqli_fetch_array($sqlgetunique_id);
            $un_id1=$fetunid['order_session_id'];
            
            $sqlgetunique_id2=mysqli_query($con,"SELECT OI_unique_id FROM order_items WHERE OI_session_id='".$un_id1."'");
            $fetunid2=  mysqli_fetch_array($sqlgetunique_id2);
            $un_id=$fetunid2['OI_unique_id'];
            
            $sqldailyentry = "SELECT * FROM order_verification WHERE date='" . date('Y-m-d') . "' AND barcode='" . $orderNo_format . "' ORDER BY id DESC LIMIT 1";
            $resultCheckOrderNoObjv = mysqli_query($con, $sqldailyentry);
            $dailyObj = mysqli_fetch_array($resultCheckOrderNoObjv);
            if (!empty($resultCheckOrderNoObjv)) {
                $today_order_status = $dailyObj['status'];
                $today_entry_out_date_time = $dailyObj['datetime'];
            } else {
                $today_order_status = 0;
                $today_entry_out_date_time = date('h:m:s D,d/m/2015');
            }
//exit();
            $intime = date('h:m:s D,d/m/2015');
            if ($today_order_status == 0) {
                $msg = "Order Number Verified, And In Time is " . $intime;
                mysqli_query($con, "INSERT INTO order_verification (barcode,datetime,date,status) VALUES ('$orderNo_format','" . $intime . "','" . date('Y-m-d') . "','1')");
            
                 $sqlUpdateOrderVefification = "UPDATE order_items SET OI_is_verified='yes' WHERE OI_unique_id='$un_id'";
                 $resultUpdateOrderVerification = mysqli_query($con, $sqlUpdateOrderVefification);
                
            } elseif ($today_order_status == 2) {
                $msg = "Order Number Verified, and out time is " . $intime;
                mysqli_query($con, "INSERT INTO order_verification (barcode,datetime,date,status) VALUES ('$orderNo_format','" . $intime . "','" . date('Y-m-d') . "','1')");
                
                $sqlUpdateOrderVefification = "UPDATE order_items SET OI_is_verified='yes' WHERE OI_unique_id='$un_id'";
                 $resultUpdateOrderVerification = mysqli_query($con, $sqlUpdateOrderVefification);
            } elseif ($today_order_status == 1) {
                $msg = "Order Number Verified, and out time is " . $intime;
                mysqli_query($con, "INSERT INTO order_verification (barcode,datetime,date,status) VALUES ('$orderNo_format','" . $intime . "','" . date('Y-m-d') . "','2')");
                
                $sqlUpdateOrderVefification = "UPDATE order_items SET OI_is_verified='yes' WHERE OI_unique_id='$un_id'";
                 $resultUpdateOrderVerification = mysqli_query($con, $sqlUpdateOrderVefification);
            }
            //generate for multiple days
        } else {

            $err = "Please check your order number";
        }
        //$err = "Please check your order number";
    }
}

$checkflag=true;

if (isset($_POST['orderNoC'])) {
    $checkflag=false;
    extract($_POST);
    echo $_POST['orderNoC'];
    echo "<br>";
    $orderNoC = validateInput($orderNoC);
    $orderNo_format = "[" . validateInput($orderNoC) . "]";
    $sqldd = "SELECT order_id,order_number FROM orders WHERE order_number='" . $orderNo_format . "'";

    $sqlCheckOrderNo = "SELECT OI_unique_id,OI_is_verified FROM order_items WHERE OI_unique_id = '$orderNoC'";

    $resultCheckOrderNo = mysqli_query($con, $sqlCheckOrderNo);
    $countOrderNo = mysqli_num_rows($resultCheckOrderNo);

    $flagnomore = false; // for define barcode two format
    if ($countOrderNo > 0) {
        $msg_order_id = $orderNoC;
        $resultCheckOrderNoObj = mysqli_fetch_object($resultCheckOrderNo);
        $isVerified = $resultCheckOrderNoObj->OI_is_verified;
        if ($isVerified === 'yes') {
            $err = "Order number already verified";
        
        } else {
            $msg = "Order number is verified";
        }
        $flagnomore = true;
    } else {
        //format two pattern start
        $resultCheckOrderNof = mysqli_query($con, $sqldd);
        $countOrderNof = mysqli_num_rows($resultCheckOrderNof);
        if ($countOrderNof > 0) {
            $flagnomore = false;
            //generate for multiple days
            $msg_order_id = $orderNo_format;
            //$resultCheckOrderNoObj = mysqli_fetch_object($resultCheckOrderNof);
            //$isVerified = $resultCheckOrderNoObj->OI_is_verified;
            //sql check for daily entry in event.
            
            $sqlgetunique_id=mysqli_query($con,"SELECT * FROM orders WHERE order_number='".$orderNo_format."'");
            $fetunid=  mysqli_fetch_array($sqlgetunique_id);
            $un_id1=$fetunid['order_session_id'];
            
            $sqlgetunique_id2=mysqli_query($con,"SELECT OI_unique_id FROM order_items WHERE OI_session_id='".$un_id1."'");
            $fetunid2=  mysqli_fetch_array($sqlgetunique_id2);
            $un_id=$fetunid2['OI_unique_id'];
            
            $sqldailyentry = "SELECT * FROM order_verification WHERE date='" . date('Y-m-d') . "' AND barcode='" . $orderNo_format . "' ORDER BY id DESC LIMIT 1";
            $resultCheckOrderNoObjv = mysqli_query($con, $sqldailyentry);
            $dailyObj = mysqli_fetch_array($resultCheckOrderNoObjv);
            if (!empty($resultCheckOrderNoObjv)) {
                $today_order_status = $dailyObj['status'];
                $today_entry_out_date_time = $dailyObj['datetime'];
            } else {
                $today_order_status = 0;
                $today_entry_out_date_time = $dailyObj['datetime'];
            }
//exit();
            $intime = $today_entry_out_date_time;
            if ($today_order_status == 0) {
                $msg = "Order Number Verified";
            } elseif ($today_order_status == 2) {
                $msg = "Order Number Verified, and out time is " . $intime;
            } elseif ($today_order_status == 1) {
                $msg = "Order Number Verified, and in time is " . $intime;
            }
            //generate for multiple days
        } else {

            $err = "Please check your order number";
        }
        //$err = "Please check your order number";
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
            <h3 class="bg-white content-heading border-bottom strong">Verify Order</h3>
            <?php if (checkPermission('order', 'verify', getSession('admin_type'))): ?>
             <div class="innerAll spacing-x2">
               <?php include basePath('admin/message.php'); ?> 
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal margin-none" method="post" autocomplete="off">
                                            <label class="col-md-12" style="text-align: center;">Please Enter a Barcode For add in System</label>
                                            <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control" autofocus="autofocus" id="orderNo" name="orderNo" type="text" placeholder="Enter order number"/>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                    
                </div>
                
 <div class="col-md-6">
                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal margin-none" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label class="col-md-12" style="text-align: center;">Please Enter a Barcode For check in System</label>
                                            <div class="col-md-12">
                                                <input class="form-control" autofocus="autofocus" id="orderNoC" name="orderNoC" type="text" placeholder="Enter order number For Check"/>
                                            </div>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                
            </div>
            </div>
                   
            
                
    <?php
    if (!empty($msg_order_id)):
        if($flagnomore==true)
        {
            
            $sqlcheckorderver = mysqli_query($con, "SELECT date,barcode,datetime,status,(SELECT `event_title` from `events` where `events`.event_id=(select `OI_OE_id` from order_items where OI_unique_id='$msg_order_id')) as event_name,(select `OI_order_id` from order_items where OI_unique_id='$msg_order_id') as order_id,(SELECT concat(`user_first_name`,' ',`user_middle_name`,' ',`user_last_name`) as name FROM `users` where user_id=(select order_user_id from orders where order_id=(select `OI_order_id` from order_items where OI_unique_id='$msg_order_id'))) as customer_name,(SELECT user_phone FROM `users` where user_id=(select order_user_id from orders where order_id=(select `OI_order_id` from order_items where OI_unique_id='$msg_order_id'))) as customer_phone FROM order_verification WHERE barcode = '$msg_order_id'");
        }
        else
        {
            $fq="SELECT date,barcode,datetime,status,(SELECT `event_title` from `events` where `events`.event_id=(select `OE_event_id` from order_events where OE_session_id='$un_id1' LIMIT 1)) as event_name,(select `OI_order_id` from order_items where OI_unique_id='$un_id'  LIMIT 1) as order_id,(SELECT concat(`user_first_name`,' ',`user_middle_name`,' ',`user_last_name`) as name FROM `users` where user_id=(select order_user_id from orders where order_id=(select `OI_order_id` from order_items where OI_unique_id='$un_id'  LIMIT 1))) as customer_name,(SELECT user_phone FROM `users` where user_id=(select order_user_id from orders where order_id=(select `OI_order_id` from order_items where OI_unique_id='$un_id'  LIMIT 1))) as customer_phone FROM order_verification WHERE barcode = '$orderNo_format'";
             $sqlcheckorderver = mysqli_query($con, $fq);
        }
    
    if (!empty($sqlcheckorderver)) {

            //echo $fetch->OI_unique_id;
            ?>
                            

                                <div class="widget widget-inverse">
                                    <div class="widget-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>SL</td>
                                                            <td>EVENT NAME</td>
                                                            <td>B.ID</td>
                                                            <td>C.Name</td>
                                                            <td>Phone</td>
                                                            <td>VERIFICATION In / Out</td>
                                                            <td>DATE TIME</td>
                                                            <td>DATE</td>
                                                        </tr>
            <?php
            $a = 1;
            while ($fetch = mysqli_fetch_object($sqlcheckorderver)):
                $stg = $fetch->status;
                ?>
                                                            <tr class="<?php
                                                            if ($stg == 1) {
                                                                echo "btn-success";
                                                            } else {
                                                                echo "btn-warning";
                                                            }
                                                            ?>">
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $fetch->event_name; ?></td>
                                                                <td><?php echo $fetch->order_id; ?></td>
                                                                <td><?php echo $fetch->customer_name; ?></td>
                                                                <td><?php echo $fetch->customer_phone; ?></td>
                                                                <td><?php
                                                @$stg = $fetch->status;
                                                if ($stg == 1) {
                                                    echo "In";
                                                } else {
                                                    echo "Out";
                                                }
                                                            ?></td>
                                                                <td><?php echo $fetch->datetime; ?></td>
                                                                 <td><?php echo $fetch->date; ?></td>
                                                            </tr>
                <?php
                $a++;
            endwhile;
            ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
            <?php
        }
    endif;
    ?>
                <?php else : ?>
                    <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="clearfix"></div>
<?php include basePath('admin/footer.php'); ?>

        <script type="text/javascript">
            $("#verifyorder").addClass("active");
            $("#verifyorder").parent().parent().addClass("active");
            $("#verifyorder").parent().addClass("in");
        </script>

<?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>