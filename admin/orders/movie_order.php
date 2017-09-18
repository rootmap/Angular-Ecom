<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

if (isset($_POST['btnDownload'])) {
    extract($_POST);
//    echo $OI_item_type;

    include '../../lib/mpdf/mpdf.php';
    $dateTimeNow = date("d-m-y H:i:s");
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 15, 16, 13);
    $mpdf->SetDisplayMode('fullpage');
    $stylesheet = file_get_contents(baseUrl() . "pdfticket/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->list_indent_first_level = 0;
    $url = baseUrl() . "pdfticket/e-ticket-mini.php?id=" . $OI_id . "&type=" . $OI_item_type . "&OS_id=" . $OS_id;
    $html = file_get_contents($url);
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('e-ticket-' . $dateTimeNow . '.pdf', 'D');
    exit();
}

include '../../lib/Zebra_Image.php';

//$event_id = "";
//$item_description = "";
$id = "";
$customer_id = "";
$order_id = "";
$verified_order_id = "";
$movie_name = "";
$theatre_id = "";
$dtmsid = "";
$lid = "";
$trx_id = "";
$seat_number = "";
$seat = "";
$seat_unit_price = "";
$seat_type = "";
$request_date = "";
$fullname = "";
$email = "";
$mobile = "";
$dob = "";
$sex = "";
//$datetime = "";
//$image_file = array();
//$last_image_id = 0;
$event_id = 0;

//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
// select option movie name show start.
$movieqarray = array();
$movietsql = "SELECT movie_id,name FROM event_movie_list";
$moviecresult = mysqli_query($con, $movietsql);
if ($moviecresult) {
    while ($movieobj = mysqli_fetch_object($moviecresult)) {
        $movieqarray[] = $movieobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
// select option movie name show end.
// select option Theater name show start.
$movieearray = array();
$moviessql = "SELECT theatre_id,name FROM event_movie_theatre";
$moviedresult = mysqli_query($con, $moviessql);
if ($moviedresult) {
    while ($movieeobj = mysqli_fetch_object($moviedresult)) {
        $movieearray[] = $movieeobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
// select optiontheater name show end.
// select option verification code show start.
$moviekarray = array();
$movieksql = "SELECT order_id FROM orders";
$moviekresult = mysqli_query($con, $movieksql);
if ($moviekresult) {
    while ($moviekobj = mysqli_fetch_object($moviekresult)) {
        $moviekarray[] = $moviekobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
// select option verification code show end.
// select option Customer  name show start.
$moviecarray = array();
$moviecsql = "SELECT user_id,concat(user_first_name,' ',user_last_name) as user_full_name FROM users";
$moviecresult = mysqli_query($con, $moviecsql);
if ($moviecresult) {
    while ($moviecobj = mysqli_fetch_object($moviecresult)) {
        $moviecarray[] = $moviecobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
// select option Customer  name show end.
//Insert Option start.

if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $customer_id = mysqli_real_escape_string($con, $customer_id);
    $order_id = mysqli_real_escape_string($con, $order_id);
    $verified_order_id = mysqli_real_escape_string($con, $verified_order_id);
    $movie_name = mysqli_real_escape_string($con, $movie_name);
    $theatre_id = mysqli_real_escape_string($con, $theatre_id);
    $dtmsid = mysqli_real_escape_string($con, $dtmsid);
    $lid = mysqli_real_escape_string($con, $lid);
    $trx_id = mysqli_real_escape_string($con, $trx_id);
    $seat_number = mysqli_real_escape_string($con, $seat_number);
    $seat = mysqli_real_escape_string($con, $seat);
    $seat_unit_price = mysqli_real_escape_string($con, $seat_unit_price);
    $seat_type = mysqli_real_escape_string($con, $seat_type);
    $request_date = mysqli_real_escape_string($con, $request_date);
    $fullname = mysqli_real_escape_string($con, $fullname);
    $email = mysqli_real_escape_string($con, $email);
    $mobile = mysqli_real_escape_string($con, $mobile);
//    $dob = mysqli_real_escape_string($con, $dob);
    $sex = mysqli_real_escape_string($con, $sex);


    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'customer_id = "' . $customer_id . '"';
    $insert_eedc_array .= ',order_id= "' . $order_id . '"';
    $insert_eedc_array .= ',verified_order_id = "' . $verified_order_id . '"';
    $insert_eedc_array .= ',movie_name = "' . $movie_name . '"';
    $insert_eedc_array .= ',theatre_id = "' . $theatre_id . '"';
    $insert_eedc_array .= ',dtmsid = "' . $dtmsid . '"';
    $insert_eedc_array .= ',lid = "' . $lid . '"';
    $insert_eedc_array .= ',trx_id = "' . $trx_id . '"';
    $insert_eedc_array .= ',seat_number = "' . $seat_number . '"';
    $insert_eedc_array .= ',seat = "' . $seat . '"';
    $insert_eedc_array .= ',seat_unit_price= "' . $seat_unit_price . '"';
    $insert_eedc_array .= ',seat_type = "' . $seat_type . '"';
    $insert_eedc_array .= ',request_date = "' . $request_date . '"';
    $insert_eedc_array .= ',fullname = "' . $fullname . '"';
    $insert_eedc_array .= ',email = "' . $email . '"';
//    $insert_eedc_array .= ',dob = "' . $dob . '"';
    $insert_eedc_array .= ',mobile = "' . $mobile . '"';
    $insert_eedc_array .= ',sex = "' . $sex . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


    $run_eedc_array_sql = "INSERT INTO order_movie_event SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = " Add Movie Data successfully";
        $link = "movie_order_list.php?msg=" . base64_encode($msg);
        redirect($link);
        // Video link save end
        // Image file save start
        // Image file save end
    }
}
//Insert Option end
//update start here  
if (isset($_POST["btneditGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $customer_id = mysqli_real_escape_string($con, $customer_id);
    $order_id = mysqli_real_escape_string($con, $order_id);
    $verified_order_id = mysqli_real_escape_string($con, $verified_order_id);
    $movie_name = mysqli_real_escape_string($con, $movie_name);
    $theatre_id = mysqli_real_escape_string($con, $theatre_id);
    $dtmsid = mysqli_real_escape_string($con, $dtmsid);
    $lid = mysqli_real_escape_string($con, $lid);
    $trx_id = mysqli_real_escape_string($con, $trx_id);
    $seat_number = mysqli_real_escape_string($con, $seat_number);
    $seat = mysqli_real_escape_string($con, $seat);
    $seat_unit_price = mysqli_real_escape_string($con, $seat_unit_price);
    $seat_type = mysqli_real_escape_string($con, $seat_type);
    $request_date = mysqli_real_escape_string($con, $request_date);
    $fullname = mysqli_real_escape_string($con, $fullname);
    $email = mysqli_real_escape_string($con, $email);
    //$dob = mysqli_real_escape_string($con, $dob);
    $sex = mysqli_real_escape_string($con, $sex);


    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'customer_id = "' . $customer_id . '"';
    $insert_eedc_array .= ',order_id= "' . $order_id . '"';
    $insert_eedc_array .= ',verified_order_id = "' . $verified_order_id . '"';
    $insert_eedc_array .= ',movie_name = "' . $movie_name . '"';
    $insert_eedc_array .= ',theatre_id = "' . $theatre_id . '"';
    $insert_eedc_array .= ',dtmsid = "' . $dtmsid . '"';
    $insert_eedc_array .= ',lid = "' . $lid . '"';
    $insert_eedc_array .= ',trx_id = "' . $trx_id . '"';
    $insert_eedc_array .= ',seat_number = "' . $seat_number . '"';
    $insert_eedc_array .= ',seat = "' . $seat . '"';
    $insert_eedc_array .= ',seat_unit_price= "' . $seat_unit_price . '"';
    $insert_eedc_array .= ',seat_type = "' . $seat_type . '"';
    $insert_eedc_array .= ',request_date = "' . $request_date . '"';
    $insert_eedc_array .= ',fullname = "' . $fullname . '"';
    $insert_eedc_array .= ',email = "' . $email . '"';
    //$insert_eedc_array .= ',dob = "' . $dob . '"';
    $insert_eedc_array .= ',sex = "' . $sex . '"';
    $insert_eedc_array .= ',date = "' . $VG_created_on . '"';


    $run_eedc_array_sql = "Update order_movie_event SET $insert_eedc_array WHERE id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    $run_eedc_array_sql2 = "Update orders SET order_status='" . $order_status . "' WHERE order_id='" . $verified_order_id . "'";
    $result2 = mysqli_query($con, $run_eedc_array_sql2);

    if ($order_status == "paid") {
        include "../event/blockbuster_api_class/GenerateSecretKey.php";
        $api = new XmlToJson();
        $dd=$api->SecureBookingConfirm($dtmsid, $lid, $trx_id);
    } elseif ($order_status == "cancel") {
        include "../event/blockbuster_api_class/GenerateSecretKey.php";
        $api = new XmlToJson();
        $dd=$api->SecureBookingCancel($dtmsid, $lid, $trx_id);
    }
//    echo var_dump($dd)."<br>";
//    echo $dd->status_code;
//    exit();
    
    if (!$result) {
        if (DEBUG) {
            $err = "run_video_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_video_array_sql query failed.";
        }
    } else {
        $msg = " Update Movie Data successfully";
        $link = "movie_order_list.php?msg=" . base64_encode($msg);
        redirect($link);
        // Video link save end
        // Image file save start
        // Image file save end
    }
}


//update end 
//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $movie = "SELECT a.*,o.order_status FROM order_movie_event as a 
LEFT JOIN orders as o on o.`order_id`=a.verified_order_id WHERE a.id = '" . $id . "'";
    $moviearray = array();
    $moviecount = mysqli_query($con, $movie);
    $moviechk = mysqli_num_rows($moviecount);
    if ($moviechk != 0) {
        while ($movierow = mysqli_fetch_object($moviecount)) {
            $moviearray[] = $movierow;
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
<?php
include basePath('admin/message.php');
if (isset($_GET['id'])) {
    ?>
                <h3 class="bg-white content-heading border-bottom strong">Edit Movie Order Detail</h3>
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
                                        <label class="col-md-4 control-label" for="itemTitle">Customer ID</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="customer_id" name="customer_id" >
                                                <option value="0">Select Customer Name</option>
    <?php if (count($moviecarray) >= 1): ?>
        <?php foreach ($moviecarray as $moviel): ?>
                                                        <option <?php if ($moviecarray[0]->user_id == $moviel->user_id) { ?> selected="selected"<?php } ?> value="<?php echo $moviel->user_id; ?>">
                                                        <?php echo $moviel->user_full_name ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Order ID</label>
                                        <div class="col-md-8">
                                            <input class="form-control"  id="order_id" name="order_id"value="<?php echo $moviearray[0]->order_id; ?>" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Verified Order ID</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="verified_order_id" name="verified_order_id"  >
                                                <option value="0">Select Verified ID</option>
    <?php if (count($moviekarray) >= 1): ?>
        <?php foreach ($moviekarray as $moviek): ?>
                                                        <option <?php if ($moviearray[0]->verified_order_id == $moviek->order_id) { ?> selected="selected" <?php } ?> value="<?php echo $moviek->order_id; ?>">
                                                        <?php echo $moviek->order_id; ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Movie Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="movie_name" name="movie_name" >
                                                <option value="0">Select Movie Name</option>
    <?php if (count($movieqarray) >= 1): ?>
        <?php foreach ($movieqarray as $movie): ?>
                                                        <option <?php if ($movieqarray[0]->movie_id == $movie->movie_id) { ?>selected="selected"<?php } ?> value="<?php echo $movie->movie_id; ?>">
                                                        <?php echo $movie->name; ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Theatre Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="theatre_id" name="theatre_id" >
                                                <option value="0">Select Theater Name</option>
    <?php if (count($movieearray) >= 1): ?>
        <?php foreach ($movieearray as $moviee): ?>
                                                        <option <?php if ($movieearray[0]->theatre_id == $moviee->theatre_id) { ?>selected="selected"<?php } ?>value="<?php echo $moviee->theatre_id; ?>">
                                                        <?php echo $moviee->name; ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Dtmsid</label>
                                        <div class="col-md-8"><input class="form-control" id="dtmsid" name="dtmsid" value="<?php echo $moviearray[0]->dtmsid; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">LID</label>
                                        <div class="col-md-8"><input class="form-control" id="lid" name="lid" value="<?php echo $moviearray[0]->lid; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">TRANSACTION ID</label>
                                        <div class="col-md-8"><input class="form-control" id="trx_id" name="trx_id" value="<?php echo $moviearray[0]->trx_id; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat Number</label>
                                        <div class="col-md-8"><input class="form-control" id="seat_number" name="seat_number" value="<?php echo $moviearray[0]->seat_number; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Seat Quantity</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="seat" name="seat"  >
                                                <option value="0">Select Quantity</option>

    <?php for ($i = 1; $i <= 30; $i++) { ?>

                                                    <option <?php if ($i == $moviearray[0]->seat) { ?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat unit Price</label>
                                        <div class="col-md-8"><input class="form-control" id="seat_unit_price" name="seat_unit_price" value="<?php echo $moviearray[0]->seat_unit_price; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat Type</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="seat_type" name="seat_type" value="<?php echo $moviearray[0]->seat_type; ?>" type="text"/>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Request Date</label>
                                        <div class="col-md-8"><input class="form-control" id="request_date" name="request_date" value="<?php echo $moviearray[0]->request_date; ?>" type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Full Name</label>
                                        <div class="col-md-8"><input class="form-control" id="fullname" name="fullname" value="<?php echo $moviearray[0]->fullname; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Email</label>
                                        <div class="col-md-8"><input class="form-control" id="email" name="email"  value="<?php echo $moviearray[0]->email; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Mobile</label>
                                        <div class="col-md-8"><input class="form-control" id="mobile" name="mobile"  value="<?php echo $moviearray[0]->mobile; ?>" type="text"/></div>
                                    </div>

                                    <!--                                    <div class="form-group">
                                                                            <label class="col-md-4 control-label" for="itemTitle">Date Of Birth</label>
                                                                            <div class="col-md-8"><input class="form-control" id="dob" name="dob" value="<?php echo $moviearray[0]->dob; ?>" type="text"/></div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Sex</label>

                                        <div class="col-md-8"><select class="form-control"id="sex" name="sex">
                                                <option  <?php if ($moviearray[0]->sex == 0) { ?>selected="selected"<?php } ?> value="0">Select</option>

                                                <option <?php if ($moviearray[0]->sex == "2") { ?>selected="selected"<?php } ?> value="2">Female</option>
                                                <option <?php if ($moviearray[0]->sex == "1") { ?>selected="selected"<?php } ?> value="1">Male</option>



                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Status</label>

                                        <div class="col-md-8"><select class="form-control" id="order_status" name="order_status">
                                                <option <?php if ($moviearray[0]->order_status == "pending") { ?>selected="selected"<?php } ?> value="pending">pending</option>
                                                <option <?php if ($moviearray[0]->order_status == "paid") { ?>selected="selected"<?php } ?> value="paid">Paid</option>
                                                <option <?php if ($moviearray[0]->order_status == "cancel") { ?>selected="selected"<?php } ?> value="cancel">Cancel</option>



                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>Update Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 
                if(!empty($moviearray[0]->verified_order_id))
                {
                ?>
                <form target="_BLANK" method="post">
                    <input type="hidden" value="<?php echo $moviearray[0]->verified_order_id; ?>" name="OI_id">
                    <input type="hidden" value="ticket" name="OI_item_type">
                    <input type="hidden" value="0" name="OS_id">
                    <button class="btn btn-success btn-lg" name="btnDownload" type="submit">Download e-Ticket</button>
                </form>
                <?php } ?>     
               <?php } else { ?>
                <h3 class="bg-white content-heading border-bottom strong">Add Movie Order</h3>
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
                                        <label class="col-md-4 control-label" for="itemTitle">Customer ID</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="customer_id" name="customer_id" >
                                                <option value="0">Select Customer Name</option>
    <?php if (count($moviecarray) >= 1): ?>
        <?php foreach ($moviecarray as $moviec): ?>
                                                        <option value="<?php echo $moviec->user_id; ?>"><?php echo $moviec->user_full_name ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Order ID</label>
                                        <div class="col-md-8">
                                            <input class="form-control"  id="order_id" name="order_id" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Verified Order ID</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="verified_order_id" name="verified_order_id"  >
                                                <option value="0">Select Verified ID</option>
    <?php if (count($moviekarray) >= 1): ?>
        <?php foreach ($moviekarray as $moviek): ?>
                                                        <option value="<?php echo $moviek->order_id; ?>"><?php echo $moviek->order_id; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Movie Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="movie_name" name="movie_name" >
                                                <option value="0">Select Movie Name</option>
    <?php if (count($movieqarray) >= 1): ?>
        <?php foreach ($movieqarray as $movie): ?>
                                                        <option value="<?php echo $movie->movie_id; ?>"><?php echo $movie->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Theatre Name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="theatre_id" name="theatre_id" >
                                                <option value="0">Select Theater Name</option>
    <?php if (count($movieearray) >= 1): ?>
        <?php foreach ($movieearray as $moviee): ?>
                                                        <option value="<?php echo $moviee->theatre_id; ?>"><?php echo $moviee->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Dtmsid</label>
                                        <div class="col-md-8"><input class="form-control" id="theatre_id" name="theatre_id"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">LID</label>
                                        <div class="col-md-8"><input class="form-control" id="lid" name="lid"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">TRANSACTION ID</label>
                                        <div class="col-md-8"><input class="form-control" id="trx_id" name="trx_id"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat Number</label>
                                        <div class="col-md-8"><input class="form-control" id="seat_number" name="seat_number"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Seat Quantity</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="seat" name="seat"  >
                                                <option value="0">Select Quantity</option>

    <?php for ($i = 1; $i <= 30; $i++) { ?>

                                                    <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat unit Price</label>
                                        <div class="col-md-8"><input class="form-control" id="seat_unit_price" name="seat_unit_price"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Seat Type</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="seat_type" name="seat_type"  type="text"/>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Request Date</label>
                                        <div class="col-md-8"><input class="form-control" id="request_date" name="request_date"  type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Full Name</label>
                                        <div class="col-md-8"><input class="form-control" id="fullname" name="fullname"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Email</label>
                                        <div class="col-md-8"><input class="form-control" id="email" name="email"  type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Mobile</label>
                                        <div class="col-md-8"><input class="form-control" id="mobile" name="mobile"  type="text"/></div>
                                    </div>

                                    <!--                                    <div class="form-group">
                                                                            <label class="col-md-4 control-label" for="itemTitle">Date Of Birth</label>
                                                                            <div class="col-md-8"><input class="form-control" id="dob" name="dob"  type="text"/></div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle">Sex</label>

                                        <div class="col-md-8"><select class="form-control"id="sex" name="sex">
                                                <option value="0">Select</option>

                                                <option value="1">Female</option>
                                                <option value="2">Male</option>


                                            </select>
                                        </div>
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
    $("#movieorderlist").addClass("active");
    $("#movieorderlist").parent().parent().addClass("active");
    $("#movieorderlist").parent().addClass("in");
</script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

