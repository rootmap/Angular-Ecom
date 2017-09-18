<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
include '../../lib/Zebra_Image.php';
if (isset($_GET["event_id"])) {
    $event_id = $_GET["event_id"];
}

// Event Tag Code Start Here //
$tag = array();
$gerEventTag = "SELECT * FROM tags";
$resultTag = mysqli_query($con, $gerEventTag);

if ($resultTag) {
    while ($obj = mysqli_fetch_object($resultTag)) {
        $tag[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultTag error: " . mysqli_error($con);
    } else {
        $err = "resultTag for category failed.";
    }
}

// Event Tag Code End Here //

$event_title = "";
$event_category_id = "";
$event_description = "";
$event_terms_conditions = "";
$event_web_logo = "";
$event_web_banner = "";
$event_eticket_banner = "";
$event_is_featured = "";
$event_featured_priority = "";
$event_is_coming = "";
$event_coming_priority = "";
$event_is_free = "";
$event_is_seat_plan = "";
$event_is_private = "";
//$event_is_eticket = "";
//$event_is_pticket = "";
$event_is_home_delivery = "";
$event_is_collectable = "";
$event_is_pickable_from_ticketchai = "";
$event_is_pickable = "";
$event_is_pickable_type = "";
$event_pick_details = "";
//$event_is_COD = "";
//$event_is_online_payable = "";
$event_status = "";
$event_is_cancel = "";
$event_is_delivery_cost = "";
$event_cancel_policy = "";
$event_organizer_details = "";
$event_tag = array();


if (isset($_POST['event_title'])) {
    extract($_POST);
    
    $mobile_width_web_logo = get_option('HOME_PAGE_EVENT_WEB_LOGO_MOBILE_WIDTH');
    $desktop_width_web_logo = get_option('HOME_PAGE_EVENT_WEB_LOGO_DESKTOP_WIDTH');
    $desktop_width_web_banner = get_option('EVENT_DETAILS_PAGE_BANNER_DESKTOP_WIDTH');
    $mobile_width_web_banner = get_option('EVENT_DETAILS_PAGE_BANNER_MOBILE_WIDTH');
    $mobile_width_eticket = get_option('EVENT_ETICKET_BANNER_MOBILE_WIDTH');
    $desktop_width_eticket = get_option('EVENT_ETICKET_BANNER_DESKTOP_WIDTH');


    if (count($event_tag) > 0) {
        $event_tag = implode(",", $event_tag);
    } else {
        $event_tag = "";
    }

    if (!$event_is_featured OR $event_is_featured != "yes") {
        $event_is_featured = 'no';
    }
    if (!$event_is_seat_plan OR $event_is_seat_plan != "yes") {
        $event_is_seat_plan = 'no';
    }

    if (!$event_is_coming OR $event_is_coming != "yes") {
        $event_is_coming = 'no';
    }

    if (!$event_is_free OR $event_is_free != "yes") {
        $event_is_free = 'no';
    }

    if (!$event_is_private OR $event_is_private != "yes") {
        $event_is_private = 'no';
    }

    if (!$event_is_delivery_cost OR $event_is_delivery_cost != "yes") {
        $event_is_delivery_cost = 'no';
    }

//    if (!$event_is_eticket OR $event_is_eticket != "yes") {
//        $event_is_eticket = 'no';
//    }
//
//    if (!$event_is_pticket OR $event_is_pticket != "yes") {
//        $event_is_pticket = 'no';
//    }
    if (!$event_is_home_delivery OR $event_is_home_delivery != "yes") {
        $event_is_home_delivery = 'no';
    }

    if (!$event_is_collectable OR $event_is_collectable != "yes") {
        $event_is_collectable = 'no';
    }

    if (!$event_is_pickable_from_ticketchai OR $event_is_pickable_from_ticketchai != "yes") {
        $event_is_pickable_from_ticketchai = 'no';
    }


    if (!$event_is_pickable OR $event_is_pickable != "yes") {
        $event_is_pickable = 'no';
    }
    
    if (!$event_is_pickable_type ) {
        $event_is_pickable_type = 'no';
    }


//    if (!$event_is_COD OR $event_is_COD != "yes") {
//        $event_is_COD = 'no';
//    }
//    if (!$event_is_online_payable OR $event_is_online_payable != "yes") {
//        $event_is_online_payable = 'no';
//    }
    if (!$event_is_cancel OR $event_is_cancel != "yes") {
        $event_is_cancel = 'no';
    }
    /*     * *************** Event Web Logo Image Code start Here *********************** */
    $event_web_logo_name = "";
    if ($_FILES["event_web_logo"]["tmp_name"] != '') {

        $event_web_logo = basename($_FILES['event_web_logo']['name']);
        $info = pathinfo($event_web_logo, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $event_web_logo_name = 'ewl_' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $event_web_logo_source = $_FILES["event_web_logo"]["tmp_name"];

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/' . $event_web_logo_name;
        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["event_web_logo"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/' . $event_web_logo_name;

//        if (!(move_uploaded_file($event_web_logo_source, $image_target_path))) {
//            $err = "Web Logo upload failed.";
//        }
        if (!$zebra->resize(1300)) {
            zebraImageErrorHandaling($zebra->error);
        }

        // mobile

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/mobile/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/mobile/', 0777, TRUE);
        }
        $image_target_path_mobile = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/mobile/' . $event_web_logo_name;
        $zebra_web_logo_mobile = new Zebra_Image();
        $zebra_web_logo_mobile->source_path = $_FILES["event_web_logo"]["tmp_name"]; /* original image path */
        $zebra_web_logo_mobile->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/mobile/' . $event_web_logo_name;
        if (!$zebra_web_logo_mobile->resize($mobile_width_web_logo)) {
            zebraImageErrorHandaling($zebra_web_logo_mobile->error);
        }

        // desktop
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/desktop/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/desktop/', 0777, TRUE);
        }
        $image_target_path_desktop = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/desktop/' . $event_web_logo_name;
        $zebra_web_logo_desktop = new Zebra_Image();
        $zebra_web_logo_desktop->source_path = $_FILES["event_web_logo"]["tmp_name"]; /* original image path */
        $zebra_web_logo_desktop->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/desktop/' . $event_web_logo_name;
        if (!$zebra_web_logo_desktop->resize($desktop_width_web_logo)) {
            zebraImageErrorHandaling($zebra_web_logo_desktop->error);
        }
    }

    /*     * *************** Event Web Logo Image Code End Here *********************** */

    /*     * *************** Event Web Banner Image Code start Here *********************** */
    $event_web_banner_name = "";
    if ($_FILES["event_web_banner"]["tmp_name"] != '') {

        $event_web_banner = basename($_FILES['event_web_banner']['name']);
        $info = pathinfo($event_web_banner, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $event_web_banner_name = 'ewb_' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $event_web_banner_source = $_FILES["event_web_banner"]["tmp_name"];
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/' . $event_web_banner_name;

        $zebra_web_banner = new Zebra_Image();
        $zebra_web_banner->source_path = $_FILES["event_web_banner"]["tmp_name"]; /* original image path */
        $zebra_web_banner->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/' . $event_web_banner_name;

//        if (!(move_uploaded_file($event_web_banner_source, $image_target_path))) {
//            $err = "Web Banner upload failed.";
//        }
        if (!$zebra_web_banner->resize(1300)) {
            zebraImageErrorHandaling($zebra_web_banner->error);
        }
        // mobile
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/mobile/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/mobile/', 0777, TRUE);
        }
        $image_target_path_banner_mobile = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/mobile/' . $event_web_banner_name;
        $zebra_web_banner_mobile = new Zebra_Image();
        $zebra_web_banner_mobile->source_path = $_FILES["event_web_banner"]["tmp_name"]; /* original image path */
        $zebra_web_banner_mobile->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/mobile/' . $event_web_banner_name;
        if (!$zebra_web_banner_mobile->resize($mobile_width_web_banner)) {
            zebraImageErrorHandaling($zebra_web_banner_mobile->error);
        }
        // desktop
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/desktop/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/desktop/', 0777, TRUE);
        }
        $image_target_path_banner_desktop = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/desktop/' . $event_web_banner_name;
        $zebra_web_banner_desktop = new Zebra_Image();
        $zebra_web_banner_desktop->source_path = $_FILES["event_web_banner"]["tmp_name"]; /* original image path */
        $zebra_web_banner_desktop->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/desktop/' . $event_web_banner_name;
        if (!$zebra_web_banner_desktop->resize($desktop_width_web_banner)) {
            zebraImageErrorHandaling($zebra_web_banner_desktop->error);
        }
    }

    /*     * *************** Event Web Banner Image Code End Here *********************** */
    /*     * *************** Event Ticket Image Code start Here *********************** */
    $event_eticket_banner_name = "";
    if ($_FILES["event_eticket_banner"]["tmp_name"] != '') {

        /*         * *****Renaming the image file******** */
        $event_eticket_banner = basename($_FILES['event_eticket_banner']['name']);
        $info = pathinfo($event_eticket_banner, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $event_eticket_banner_name = 'eetb_' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $event_eticket_banner_source = $_FILES["event_eticket_banner"]["tmp_name"];
        /*         * *****Renaming the image file******** */


        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/' . $event_eticket_banner_name;


        $zebra_ticket = new Zebra_Image();
        $zebra_ticket->source_path = $_FILES["event_eticket_banner"]["tmp_name"]; /* original image path */
        $zebra_ticket->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/' . $event_eticket_banner_name;
        
        if (!$zebra_ticket->resize(1300)) {
            zebraImageErrorHandaling($zebra_ticket->error);
        }
//        if (!(move_uploaded_file($event_eticket_banner_source, $image_target_path))) {
//            $err = "eTicket Banner upload failed.";
//        }
        
        //mobile
        
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/mobile/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/mobile/', 0777, TRUE);
        }
        $image_target_path_ticket_mobile = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/mobile/' . $event_eticket_banner_name;
        $zebra_ticket_mobile = new Zebra_Image();
        $zebra_ticket_mobile->source_path = $_FILES["event_eticket_banner"]["tmp_name"]; /* original image path */
        $zebra_ticket_mobile->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/mobile/' . $event_eticket_banner_name;
        if (!$zebra_ticket_mobile->resize($mobile_width_eticket)) {
            zebraImageErrorHandaling($zebra_ticket_mobile->error);
        }
        // desktop
        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/desktop/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/desktop/', 0777, TRUE);
        }
        $image_target_path_ticket_desktop = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/desktop/' . $event_eticket_banner_name;
        $zebra_ticket_desktop = new Zebra_Image();
        $zebra_ticket_desktop->source_path = $_FILES["event_eticket_banner"]["tmp_name"]; /* original image path */
        $zebra_ticket_desktop->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/desktop/' . $event_eticket_banner_name;
        if (!$zebra_ticket_desktop->resize($desktop_width_eticket)) {
            zebraImageErrorHandaling($zebra_ticket_desktop->error);
        }
    }

    /*     * *************** Event Ticket Image Code End Here *********************** */

    $strEventCatID = '';
    if (count($event_category_id) > 0) {
        foreach ($event_category_id AS $key => $val) {
            $strEventCatID .= $val . ',';
        }
    }

    $strEventCatID = trim($strEventCatID, ',');

    $event_title = mysqli_real_escape_string($con, $event_title);
    $event_category_id = mysqli_real_escape_string($con, $strEventCatID);
    $event_description = mysqli_real_escape_string($con, $event_description);
    $event_terms_conditions = mysqli_real_escape_string($con, $event_terms_conditions);
    $event_web_logo = mysqli_real_escape_string($con, $event_web_logo_name);
    $event_web_banner = mysqli_real_escape_string($con, $event_web_banner_name);
    $event_eticket_banner = mysqli_real_escape_string($con, $event_eticket_banner_name);
    $event_is_featured = mysqli_real_escape_string($con, $event_is_featured);
    $$event_featured_priority = mysqli_real_escape_string($con, $event_featured_priority);
    $event_is_coming = mysqli_real_escape_string($con, $event_is_coming);
    $event_coming_priority = mysqli_real_escape_string($con, $event_coming_priority);
    $event_is_private = mysqli_real_escape_string($con, $event_is_private);
    $event_is_free = mysqli_real_escape_string($con, $event_is_free);
    $event_is_seat_plan = mysqli_real_escape_string($con, $event_is_seat_plan);
//    $event_is_eticket = mysqli_real_escape_string($con, $event_is_eticket);
//    $event_is_pticket = mysqli_real_escape_string($con, $event_is_pticket);
    $event_is_home_delivery = mysqli_real_escape_string($con, $event_is_home_delivery);
    $event_is_collectable = mysqli_real_escape_string($con, $event_is_collectable);
    $event_is_pickable = mysqli_real_escape_string($con, $event_is_pickable);
    $event_is_pickable_type=mysqli_real_escape_string($con, $event_is_pickable_type);
    $event_is_pickable_from_ticketchai = mysqli_real_escape_string($con, $event_is_pickable_from_ticketchai);
    $event_pick_details = mysqli_real_escape_string($con, $event_pick_details);
//    $event_is_COD = mysqli_real_escape_string($con, $event_is_COD);
//    $event_is_online_payable = mysqli_real_escape_string($con, $event_is_online_payable);
    $event_is_cancel = mysqli_real_escape_string($con, $event_is_cancel);
    $event_cancel_policy = mysqli_real_escape_string($con, $event_cancel_policy);
    $event_is_delivery_cost = mysqli_real_escape_string($con, $event_is_delivery_cost);
    $event_organizer_details = mysqli_real_escape_string($con, $event_organizer_details);
    $event_tag = mysqli_real_escape_string($con, $event_tag);
    $event_updated_by = getSession('admin_id');
    $event_status = mysqli_real_escape_string($con, $event_status);


    $check_Event = "select * from events where event_title = '$event_title' AND event_id NOT IN (" . $event_id . ") ";
    $check_EventRun = mysqli_query($con, $check_Event);
    $countEvent = mysqli_num_rows($check_EventRun);
    if ($countEvent >= 1) {
        $err = "Event title already exists";
    } else {

        $update_EventArray = '';
        $update_EventArray .= ' event_title = "' . $event_title . '"';
        $update_EventArray .= ', event_category_id = "' . $event_category_id . '"';
        $update_EventArray .= ', event_description = "' . $event_description . '"';
        $update_EventArray .= ', event_terms_conditions = "' . $event_terms_conditions . '"';
        if ($_FILES["event_web_logo"]["tmp_name"] != '') {
            $update_EventArray .= ', event_web_logo = "' . $event_web_logo . '"';
        }
        if ($_FILES["event_web_banner"]["tmp_name"] != '') {
            $update_EventArray .= ', event_web_banner = "' . $event_web_banner . '"';
        }
        if ($_FILES["event_eticket_banner"]["tmp_name"] != '') {
            $update_EventArray .= ', event_eticket_banner = "' . $event_eticket_banner . '"';
        }
        $update_EventArray .= ', event_is_featured = "' . $event_is_featured . '"';
        $update_EventArray .= ', event_featured_priority = "' . $event_featured_priority . '"';
        $update_EventArray .= ', event_is_coming = "' . $event_is_coming . '"';
        $update_EventArray .= ', event_coming_priority = "' . $event_coming_priority . '"';
        $update_EventArray .= ', event_is_private = "' . $event_is_private . '"';
        $update_EventArray .= ', event_is_free = "' . $event_is_free . '"';
        $update_EventArray .= ', event_is_seat_plan = "' . $event_is_seat_plan . '"';
//        $update_EventArray .= ', event_is_eticket = "' . $event_is_eticket . '"';
//        $update_EventArray .= ', event_is_pticket = "' . $event_is_pticket . '"';
        $update_EventArray .= ', event_is_home_delivery = "' . $event_is_home_delivery . '"';
        $update_EventArray .= ', event_is_collectable = "' . $event_is_collectable . '"';
        $update_EventArray .= ', event_is_pickable_from_office = "' . $event_is_pickable_from_ticketchai . '"';
        $update_EventArray .= ', event_is_pickable = "' . $event_is_pickable . '"';
        $update_EventArray .= ', event_is_pickable_type = "' . $event_is_pickable_type . '"';
        $update_EventArray .= ', event_pick_details = "' . $event_pick_details . '"';
//        $update_EventArray .= ', event_is_COD = "' . $event_is_COD . '"';
//        $update_EventArray .= ', event_is_online_payable = "' . $event_is_online_payable . '"';
        $update_EventArray .= ', event_is_cancel = "' . $event_is_cancel . '"';
        $update_EventArray .= ', event_cancel_policy = "' . $event_cancel_policy . '"';
        $update_EventArray .= ', event_is_delivery_cost = "' . $event_is_delivery_cost . '"';
        $update_EventArray .= ', event_organizer_details = "' . $event_organizer_details . '"';
        $update_EventArray .= ', event_tag = "' . $event_tag . '"';
        $update_EventArray .= ', event_updated_by = "' . $event_updated_by . '"';
        $update_EventArray .= ', event_status = "' . $event_status . '"';

        $run_update_query = "UPDATE events SET $update_EventArray WHERE event_id = $event_id";
        $result = mysqli_query($con, $run_update_query);


        if (!$result) {
            if (DEBUG) {
                $err = "run_update_query error: " . mysqli_error($con);
            } else {
                $err = "run_update_query failed.";
            }
        } else {
            
            
            //payment method start
            $msg_count=0;
            $err_count=0;
            mysqli_query($con,"DELETE FROM event_wise_payment_method WHERE event_id = '".$event_id."'");
            foreach ($_POST['payment_method_unique_id'] as $result) {
                $showsqli= mysqli_real_escape_string($con,  $result);
                $insquery="event_id='".$event_id."',payment_method_id='".$result."',date='".date('Y-m-d')."',status='1'";
                $ins="INSERT INTO event_wise_payment_method SET ".$insquery;
                $insrun=  mysqli_query($con,$ins);
            }
            //payment method end
            
            
            //ticket type start

            mysqli_query($con,"DELETE FROM eventwies_ticket_type WHERE event_id = '".$event_id."'");
            foreach ($_POST['ticket_type_id'] as $result) {
                $showsqli= mysqli_real_escape_string($con,  $result);
                $insquery="event_id='".$event_id."',ttid='".$result."',date='".date('Y-m-d')."',status='1'";
                $ins="INSERT INTO eventwies_ticket_type SET ".$insquery;
                $insrun=  mysqli_query($con,$ins);
            }
             //ticket type start end
            $msg = "Event updated successfully";
            $link = "created_event_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
            redirect($link);
        }
    }
}




$event_query = "SELECT `events`.*, categories.* FROM `events` LEFT JOIN categories ON `events`.event_category_id = categories.category_id WHERE event_id = '$event_id'";
$event_result = mysqli_query($con, $event_query);
$count_event = mysqli_num_rows($event_result);
if ($count_event > 0) {
    while ($row = mysqli_fetch_object($event_result)) {
        //debug($row);

        $event_title = $row->event_title;
        $event_category_id = $row->event_category_id;
        $event_web_logo = $row->event_web_logo;
        $event_web_banner = $row->event_web_banner;
        $event_eticket_banner = $row->event_eticket_banner;
        $event_is_featured = $row->event_is_featured;
        $event_featured_priority = $row->event_featured_priority;
        $event_is_coming = $row->event_is_coming;
        $event_coming_priority = $row->event_coming_priority;
        $event_is_private = $row->event_is_private;
        $event_is_free = $row->event_is_free;
        $event_is_seat_plan = $row->event_is_seat_plan;
        $event_is_eticket = $row->event_is_eticket;
        $event_is_pticket = $row->event_is_pticket;
        $event_is_home_delivery = $row->event_is_home_delivery;
        $event_is_collectable = $row->event_is_collectable;
        $event_is_pickable = $row->event_is_pickable;
        $event_is_pickable_from_office = $row->event_is_pickable_from_office;
        $event_is_pickable_type = $row->event_is_pickable_type;
        $event_pick_details = $row->event_pick_details;
        $event_is_COD = $row->event_is_COD;
        $event_is_online_payable = $row->event_is_online_payable;
        $event_is_cancel = $row->event_is_cancel;
        $event_cancel_policy = $row->event_cancel_policy;
        $event_is_delivery_cost = $row->event_is_delivery_cost;
        $event_description = $row->event_description;
        $event_terms_conditions = $row->event_terms_conditions;
        $event_tag = $row->event_tag;
        $event_status = $row->event_status;
        $event_organizer_details = $row->event_organizer_details;
        $event_tag_list = explode(",", $event_tag);
        
       
        
    }
}

//payment mathod edit update sql start


//payment mathod edit update show sql start
$paymentedarray =array();
$sqliedit = mysqli_query($con, "SELECT a.*,p.payment_method_id as pmid  FROM payment_method as a 
LEFT JOIN event_wise_payment_method as p on p.event_id='$event_id' AND p.payment_method_id=a.id");
$checkedit =  mysqli_num_rows($sqliedit);
if ($checkedit != 0) {
    while ($paymentrows = mysqli_fetch_object($sqliedit)):
        $paymentedarray []= $paymentrows;
        endwhile;
    }
 
  //echo var_dump($checkedit);
//exit();

//payment mathod edit update show sql end

//Ticket Type sql start
$tictypearray = array();
$sqltictype = mysqli_query($con, "
 SELECT a.*,IFNULL(p.ttid,0) as ttid
 FROM
 ticket_type as a 
 LEFT JOIN eventwies_ticket_type as p 
 on
 p.event_id='$event_id'
 AND
 p.ttid=a.id");
$chktictype = mysqli_num_rows($sqltictype);
if ($chktictype != 0) {
    while ($rowtictype = mysqli_fetch_object($sqltictype)):
        $tictypearray [] = $rowtictype;
    endwhile;
}
//ticket Type sql end
    
    
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
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                jQuery.getJSON("<?php echo baseUrl('admin/category/get_category.php'); ?>", function (data) {
                    console.log(data);
                    if (data !== "[]") {
                        var inlineDefault = new kendo.data.HierarchicalDataSource({
                            data: data
                        });
                        $("#treeview").kendoTreeView({
                            dataSource: inlineDefault,
                            template: kendo.template(jQuery("#treeview-template").html())
                        });
                    } else {
                        $("#treeview").html("");
                    }
                });
            });
        </script>
    </head>
    <body class="">
        <?php include basePath('admin/header.php'); ?>
        <script id="treeview-template" type="text/kendo-ui-template">
            # var eve_catID = '<?php echo $event_category_id; ?>'; #
            # var arrEveCatID = eve_catID.split(","); #
            # console.log(arrEveCatID); #
            <input type='checkbox' id='cat_#= item.category_id #' # if(arrEveCatID.indexOf(item.category_id.toString()) > -1){# checked='checked' # } # name='event_category_id[]' 
            value='#= item.category_id #' />&nbsp;#= item.category_title #
        </script>
       
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

        <div id="content" style="padding-left: 0px;">
            <h3 class="bg-white content-heading border-bottom strong">Edit Event</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <div class="col-md-12" id="generalInfoError"></div>
                <div id="ticketTypeError" class="col-md-12"></div>
                <div id="deliveryError" class="col-md-12"></div>
                <div id="paymentError" class="col-md-12"></div>
                <div id="cancelmsgError" class="col-md-12"></div>
                <!-- Content Start Here -->
                <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data" id="createEvent">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="createEventKendoTab">
                                <ul>
                                    <li class="k-state-active">General Info</li>
                                    <li>Event Details</li>
                                    <li>Terms and Conditions</li>
                                    <li>Ticket Type</li>
                                    <li>Delivery Method</li>
                                    <li>Payment Method</li>
                                    <li>Organizer</li>
                                    <li>Cancellation Policy</li>
                                </ul>
                                <!-- Event General Information -->
                                <div class="innerAll spacing-x2">
                                    <div style="height: 20px"></div>
                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id; ?>"/>
                                                        <div class="col-md-2">Event Title</div>
                                                        <div class="col-md-4"><input class="form-control" style="height: 20px; width:87%" id="event_title" name="event_title" value="<?php echo $event_title; ?>" type="text" /></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Event Tag</div>
                                                        <div class="col-md-4" >
                                                            <select multiple="multiple" style="height: 25px; width:95%" id="select2_3" name="event_tag[]" >

                                                                <?php if (count($tag) >= 1): ?>
                                                                    <?php foreach ($tag as $Tag): ?>
                                                                        <option value="<?php echo $Tag->tag_title; ?>"  
                                                                        <?php
                                                                        if (in_array($Tag->tag_title, $event_tag_list)) {
                                                                            echo ' selected="selected"';
                                                                        }
                                                                        ?>>
                                                                                    <?php echo $Tag->tag_title; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Event Category</div>
                                                        <div class="col-md-4">
                                                            <ul style="list-style: none;">
                                                                <li><input type="checkbox" name="event_category_id[]" id="event_category_id" value="0"/>&nbsp;Root Category</li>
                                                            </ul>
                                                            <div id="treeview">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div id="result"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Web Logo</div>
                                                        <div class="col-md-4"> 
                                                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                                                <span style="border-color: #799D37;" class="btn btn-default btn-file">
                                                                    <span class="fileupload-new"></span>
                                                                    <span class="fileupload-exists"></span>
                                                                    <input type="file" id="event_web_logo" name="event_web_logo"  style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"><img style="margin-left: 280px; margin-top: -58px;" src="<?php echo baseUrl("upload/event_web_logo/") ?><?php echo $event_web_logo; ?>" width="80px"  /></span>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Web Banner</div>
                                                        <div class="col-md-4"> 
                                                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                                                <span style="border-color: #799D37;" class="btn btn-default btn-file">
                                                                    <span class="fileupload-new"></span>
                                                                    <span class="fileupload-exists"></span>
                                                                    <input type="file" id="event_web_banner" name="event_web_banner"  style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"></span>
                                                                <img style="margin-left: 280px; margin-top: -58px;" src="<?php echo baseUrl("upload/event_web_banner/") ?><?php echo $event_web_banner; ?>" width="80px"  />

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Ticket Banner</div>
                                                        <div class="col-md-4"> 
                                                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                                                <span style="border-color: #799D37;" class="btn btn-default btn-file">
                                                                    <span class="fileupload-new"></span>
                                                                    <span class="fileupload-exists"></span>
                                                                    <input type="file" id="event_eticket_banner" name="event_eticket_banner"  style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"></span>
                                                                <img style="margin-left: 280px; margin-top: -58px;" src="<?php echo baseUrl("upload/event_eticket_banner/") ?><?php echo $event_eticket_banner; ?>" width="80px"  />

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Featured ?</div>
                                                        <div class="col-md-4">
                                                            <input onchange="javascript:checkFeatured();" type="checkbox" name="event_is_featured" id="event_is_featured" value="yes" <?php
                                                            if ($event_is_featured == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                            <span id="featShow" <?php
                                                            if ($event_is_featured === 'no') {
                                                                echo 'style="display:none"';
                                                            }
                                                            ?> >
                                                                <input class="form-control" style="width: 230px;height: 20px;" id="event_featured_priority" name="event_featured_priority" value="<?php echo $event_featured_priority; ?>" type="number" placeholder="featured priority"/>
                                                            </span>    
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Upcoming ?</div>
                                                        <div class="col-md-4">
                                                            <input onchange="javascript:checkUpcoming();" type="checkbox" name="event_is_coming" id="event_is_coming" value="yes" <?php
                                                            if ($event_is_coming == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                            <span id="upShow" <?php
                                                            if ($event_is_coming === 'no') {
                                                                echo 'style="display:none"';
                                                            }
                                                            ?> >
                                                                <input class="form-control" style="width: 230px;height: 20px;" id="event_coming_priority" name="event_coming_priority" value="<?php echo $event_coming_priority; ?>" type="number" placeholder="upcoming priority"/>
                                                            </span>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Free ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_free" id="event_is_free" value="yes" <?php
                                                            if ($event_is_free == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Private ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_private" id="event_is_private" value="yes" <?php
                                                            if ($event_is_private == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Free Delivery Cost ?</div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="event_is_delivery_cost" id="event_is_delivery_cost" value="yes" <?php
                                                            if ($event_is_delivery_cost == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Seat Plan ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_seat_plan" id="event_is_seat_plan" value="yes" <?php
                                                            if ($event_is_seat_plan == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <?php // if (checkPermission('event', 'status', getSession('admin_type'))):  ?>   
                                                    <!--                                                        <div class="form-group">
                                                                                                                <div class="col-md-2">Is Event Active ?</div>
                                                                                                                <div class="col-md-4"><input type="checkbox" name="event_status" id="event_status" value="active" <?php
//                                                                if ($event_status == 'active') {
//                                                                    echo 'checked="checked"';
//                                                                }
                                                    ?>/>
                                                                                                                </div> 
                                                                                                            </div>-->
                                                    <?php // endif;  ?>
                                                    <?php if (checkPermission('event', 'status', getSession('admin_type'))): ?>
                                                        <div class="form-group">
                                                            <div class="col-md-2">Is Event Active ?</div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" id="event_status" name="event_status" style="height: 20px; width:87%">
                                                                    <option value="0">Select Status</option>
                                                                    <option value="active" <?php
                                                                    if ($event_status == 'active') {
                                                                        echo ' selected="selected"';
                                                                    }
                                                                    ?>>Active</option>
                                                                    <option value="inactive"<?php
                                                                    if ($event_status == 'inactive') {
                                                                        echo ' selected="selected"';
                                                                    }
                                                                    ?>>Inactive</option>
                                                                    <option value="archived"<?php
                                                                    if ($event_status == 'archived') {
                                                                        echo ' selected="selected"';
                                                                    }
                                                                    ?>>Archived</option>
                                                                    <option value="delete"<?php
                                                                    if ($event_status == 'delete') {
                                                                        echo ' selected="selected"';
                                                                    }
                                                                    ?>>Delete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="form-actions">
                                                        <button type="button" id="btnGeneralInfoNext" name="btnGeneralInfoNext" class="btn btn-primary" style="margin-left: -5px;"><i class="fa fa-check-circle"></i> Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Event General Information -->
                                <!-- Event Details -->
                                <div>
                                    <div class="row">
                                        <div style="height: 20px"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11.5">
                                            <textarea id="event_description" name="event_description" rows="3" cols="30"><?php echo html_entity_decode($event_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div style="height: 20px"></div>
                                    <div class="form-actions">
                                        <button  type="button" id="btnEventDescriptionNext" name="btnEventDescriptionNext" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                    </div>
                                </div>
                                <!-- Event Details -->
                                <!-- Event Terms and Conditions -->
                                <div>
                                    <div class="row">
                                        <div style="height: 20px"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11.5">
                                            <textarea id="event_terms_conditions" name="event_terms_conditions" rows="3" cols="30"><?php echo html_entity_decode($event_terms_conditions, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div style="height: 20px"></div>
                                    <div class="form-actions">
                                        <button type="button" id="btnEventTermsAndCondiotnNext" name="btnEventTermsAndCondiotnNext" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                    </div>
                                </div>
                                <!-- Event Terms and Conditions -->
                                 <!-- Ticket Type Start -->
                                <div class="innerAll spacing-x2">
                                    <div style="height: 20px"></div>

                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div style="height: 15px;"></div>
                                                <div class="col-md-12">
                                                   <?php foreach ($tictypearray as $crtshow) {
                                                            ?>
                                                    <div class="form-group">
                                                        <div class="col-md-2"><?php echo $crtshow->name; ?></div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="ticket_type_id[]" id="ticket_type_id" <?php if($crtshow->ttid!=0){ ?> checked="checked" <?php }  ?> value="<?php echo $crtshow->id; ?>" />
                                                           
                                                            
                                                        </div> 
                                                    </div>
                                                  
                                                      <?php } ?>
<!--                                                    <div class="form-group">
                                                        
                                                        <div class="col-md-2"><?php //echo $crtshow->name; ?></div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="event_is_pticket" id="event_is_pticket" value="<?php //echo $crtshow->id; ?>"/>
                                                           
                                                        </div> 
                                                    </div>-->
                                                    
                                                    <div style="height: 20px"></div>
                                                    <div class="form-actions">
                                                        <button  type="button" id="btnTicketTypeNext" name="btnTicketTypeNext" style="margin-left: -7px;" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                                <!-- Ticket Type End -->
                                <!-- Delivery Method Start -->
                                <div class="innerAll spacing-x2">
                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Home Delivery ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_home_delivery" id="event_is_home_delivery" value="yes" <?php
                                                            if ($event_is_home_delivery == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Collectable ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_collectable" id="event_is_collectable" value="yes" <?php
                                                            if ($event_is_collectable == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Pickable From Ticketchai Office ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_pickable_from_ticketchai" id="event_is_pickable_from_ticketchai" value="yes" <?php
                                                            if ($event_is_pickable_from_office
                                                                    == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Pickable ?</div>
                                                        <div class="col-md-4">
                                                            <input onchange="javascript:checkPickable();" type="checkbox" name="event_is_pickable" id="event_is_pickable" value="yes" <?php
                                                            if ($event_is_pickable == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                        <div style="height: 40px"></div>
                                                        <div style="display: none" id="pickDetailsShowDropdown">
                                                            <input type="hidden" id="pickDetailsShowDropdown_list_id" value="0">
                                                            <div class="col-md-8 text-center"><strong>Select Pick Point Data List</strong></div>
                                                            <div style="height: 30px;"></div>
                                                            <div class="col-md-11.3">
                                                                <label class="col-md-4 text-center"><input onclick="detailpick()" value="1" <?php if($event_is_pickable_type==1){ ?> checked="checked" <?php } ?> type="radio" name="event_is_pickable_type" id="single_1" /> From One Point</label>
                                                                <label class="col-md-4 text-center"><input onclick="detailpick()" value="2" <?php if($event_is_pickable_type==2){ ?> checked="checked" <?php } ?>  type="radio" name="event_is_pickable_type" id="multiple_1" /> From Multiple Point</label>
                                                            </div> 
                                                        </div>

                                                        <div style="display: none" id="pickDetailsShow">

                                                            <div class="col-md-6">Pick Point Details</div>
                                                            <div style="height: 30px;"></div>
                                                            <div class="col-md-11.3">
                                                                <textarea id="event_pick_details" name="event_pick_details" rows="3" cols="20"><?php echo html_entity_decode($event_pick_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                    
                                                    
                                                    
                                                </div>
                                                <div style="height: 20px"></div>
                                                <div class="form-actions">
                                                    <button type="button" id="btnDeliveryMethodNext" name="btnDeliveryMethodNext" style="margin-left: 2px;" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delivery Method End -->
                                <!-- Payment Method Start -->
                                <div class="innerAll spacing-x2">
                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                 
                                                        <?php foreach ( $paymentedarray as $editpay){?>
                                                     <div class="form-group">
                                                        <div class="col-md-2"><?php echo $editpay->name; ?></div>
                                                        <div class="col-md-4"><input type="checkbox" name="payment_method_unique_id[]" id="event_edit" value="<?php echo $editpay->id; ?>"
                                                            <?php
//                                                            if ($event_is_COD == 'yes') {
//                                                             echo 'checked="checked"';
//                                                            }
//                                                            ?>
                                                             />                        
                                                        </div> 
                                                     </div>  
                                                    <?php } ?>
                                                    
                                                  
                                                    
<!--                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Cash On Delivery ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_COD" id="event_is_COD" value="yes" <?php
                                                            //if //($event_is_COD == 'yes') {
                                                                //echo 'checked="checked"';
                                                            //}
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Online Payable ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_online_payable" id="event_is_online_payable" value="yes" <?php
                                                            //if// ($event_is_online_payable == 'yes') {
                                                                //echo 'checked="checked"';
                                                            //}
                                                            ?>/>
                                                        </div> 
                                                    </div>-->
                                                </div>
                                                <div style="height: 20px"></div>
                                                <div class="form-actions">
                                                    <button  type="button" id="btnPaymentMethodNext" name="btnPaymentMethodNext" style="margin-left: -7px;" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Payment Method End -->
                                <!-- Organizer Details -->
                                <div>
                                    <div class="row">
                                        <div style="height: 20px"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11.5">
                                            <textarea id="event_organizer_details" name="event_organizer_details" rows="3" cols="30"><?php echo html_entity_decode($event_organizer_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                    <div style="height: 20px"></div>
                                    <div class="form-actions">
                                        <button type="button" id="btnOrganizerNext" name="btnOrganizerNext" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                    </div>
                                </div>
                                <!-- Organizer Details -->
                                <!-- Cancellation Policy Start -->
                                <div class="innerAll spacing-x2">
                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Cancel Policy ?</div>
                                                        <div class="col-md-4">
                                                            <input onchange="javascript:checkCancel();" type="checkbox" name="event_is_cancel" id="event_is_cancel" value="yes" <?php
                                                            if ($event_is_cancel == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                        <div style="height: 40px"></div>
                                                        <div <?php
                                                        if ($event_is_cancel === 'no') {
                                                            echo 'style="display:none"';
                                                        }
                                                        ?> id="cancelPolicyShow">
                                                            <div class="col-md-6">Cancellation Policy Details</div>
                                                            <div style="height: 30px;"></div>
                                                            <div class="col-md-11.3">
                                                                <textarea id="event_cancel_policy" name="event_cancel_policy" rows="3" cols="20"><?php echo html_entity_decode($event_cancel_policy, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div style="height: 20px"></div>
                                                <div class="form-actions">
                                                    <button type="button"  id="btnSaveEvent" name="btnSaveEvent" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Event</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cancellation Policy End -->

                            </div>
                        </div>
                    </div>
                    <!-- Content End Here -->
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->
    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $(document).ready(function () {
            var createEventTab = $("#createEventKendoTab").kendoTabStrip({
                animation: {
                    open: {
                        effects: "fadeIn"
                    }
                }
            }).data("kendoTabStrip");
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(1)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(2)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(3)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(4)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(5)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(6)"), false);
            createEventTab.enable(createEventTab.tabGroup.children("li:eq(7)"), false);
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#event_organizer_details").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#event_description").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $("#event_terms_conditions").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $("#event_pick_details").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#event_cancel_policy").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>


    <script type="text/javascript">


        function tabControl(id, totalTab) {
            var tabID = id;
            var createEventTab = $("#createEventKendoTab").kendoTabStrip({
                animation: {
                    open: {
                        effects: "fadeIn"
                    }
                }
            }).data("kendoTabStrip");
            createEventTab.select(tabID);

            for (var i = 0; i < totalTab; i++) {
                if (i <= tabID) {
                    createEventTab.enable(createEventTab.tabGroup.children("li:eq(" + i + ")"), true);
                } else {
                    createEventTab.enable(createEventTab.tabGroup.children("li:eq(" + i + ")"), false);
                }
            }
        }

        $(document).ready(function () {
            $("#btnGeneralInfoNext").click(function () {
                var event_title = $("#event_title").val();
                var event_category_id = $("input[name='event_category_id[]']:checked").val();

                if (event_title === "" || typeof event_category_id === "undefined") {
                    if (event_title === "") {
                        $("#generalInfoError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Event title required</em></strong></div>');
                    } else if (typeof event_category_id === "undefined") {
                        $("#generalInfoError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select a category</em></strong></div>');
                    }
                } else {
                    $("#generalInfoError").html('');
                    tabControl(1, 7);
                }

            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnEventDescriptionNext").click(function () {
                tabControl(2, 7);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnEventTermsAndCondiotnNext").click(function () {
                tabControl(3, 7);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnTicketTypeNext").click(function () {
                var event_is_eticket = $("input[name='event_is_eticket']:checked").val();
                var event_is_pticket = $("input[name='event_is_pticket']:checked").val();

                if (typeof event_is_eticket === "undefined" && typeof event_is_pticket === "undefined") {

                    $("#ticketTypeError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one ticket type</em></strong></div>');
                } else if (typeof event_is_eticket != "undefined" && typeof event_is_pticket != "undefined") {
                    $("#ticketTypeError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>You have to select one ticket type</em></strong></div>');
                } else {
                    $("#ticketTypeError").html('');
                    tabControl(4, 7);
                }
            });
        });
    </script>
    <script type="text/javascript">
       $(document).ready(function () {
            $("#btnDeliveryMethodNext").click(function () {
                var event_is_home_delivery = $("input[name='event_is_home_delivery']:checked").val();
                var event_is_collectable = $("input[name='event_is_collectable']:checked").val();
                var event_is_pickable_from_office = $("input[name='event_is_pickable_from_ticketchai']:checked").val();
                var event_is_pickable = $("input[name='event_is_pickable']:checked").val();
                var event_pick_details = $("#event_pick_details").val();

                if (typeof event_is_home_delivery === "undefined" && typeof event_is_collectable === "undefined" && typeof event_is_pickable === "undefined" && typeof event_is_pickable_from_office === "undefined") {
                    $("#deliveryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one delivery method</em></strong></div>');
                }
                else {
                    if (typeof event_is_pickable !== "undefined") {
                        if (document.getElementById('single_1').checked && event_pick_details === "") {
                            $("#deliveryError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter pick point details</em></strong></div>');
                        } else {
                            $("#deliveryError").html('');
                            tabControl(5, 7);
                        } 
                    }
                    else {
                        $("#deliveryError").html('');
                        tabControl(5, 7);
                    }
                }

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnPaymentMethodNext").click(function () {
                var event_is_COD = $("input[name='event_is_COD']:checked").val();
                var event_is_online_payable = $("input[name='event_is_online_payable']:checked").val();

//                if (typeof event_is_COD === "undefined" && typeof event_is_online_payable === "undefined") {
//
//                    $("#paymentError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one payment method</em></strong></div>');
//                } else {
                    $("#paymentError").html('');
                    tabControl(6, 7);
                //}
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnOrganizerNext").click(function () {
                tabControl(7, 7);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnSaveEvent").click(function () {
                var event_is_cancel = $("input[name='event_is_cancel']:checked").val();
                var event_cancel_policy = $("#event_cancel_policy").val();

                if (typeof event_is_cancel !== "undefined") {
                    if (event_cancel_policy === "") {
                        $("#cancelmsgError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter event cancellation policy details</em></strong></div>');
                    } else {
                        $("#cancelmsgError").html('');
                        $('#createEvent').submit();
                    }
                }
                else {
                    $("#cancelmsgError").html('');
                    $('#createEvent').submit();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(checkPickable(),1000);
            setInterval(detailpick(),1000);
        });
        
        
        function checkFeatured() {
            if ($('input[name="event_is_featured"]:checked').length > 0) {
                $("#featShow").fadeIn();
            } else {
                $("#featShow").fadeOut();
            }
        }
        function checkUpcoming() {
            if ($('input[name="event_is_coming"]:checked').length > 0) {
                $("#upShow").fadeIn();
            } else {
                $("#upShow").fadeOut();
            }
        }

//        function checkPickable() {
//            if ($('input[name="event_is_pickable"]:checked').length > 0) {
//                $("#pickDetailsShow").fadeIn();
//            } else {
//                $("#pickDetailsShow").fadeOut();
//            }
//        }

        function checkPickable() {
            if ($('input[name="event_is_pickable"]:checked').length > 0) {
                $("#pickDetailsShowDropdown").fadeIn();
                
            } else {
                //$("#pickDetailsShow").fadeOut();
                $("#pickDetailsShowDropdown").fadeOut();
            }
        }
        
        function detailpick()
        {
            
            if (document.getElementById('single_1').checked) {
                $("#pickDetailsShow").fadeIn();
            } else {
                $("#pickDetailsShow").fadeOut();
            }
        }

        function checkCancel() {
            if ($('input[name="event_is_cancel"]:checked').length > 0) {
                $("#cancelPolicyShow").fadeIn();
            } else {
                $("#cancelPolicyShow").fadeOut();
            }
        }
    </script>

    <script type="text/javascript">
        $("#evelist").addClass("active");
        $("#evelist").parent().parent().addClass("active");
        $("#evelist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
