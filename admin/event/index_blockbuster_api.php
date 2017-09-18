<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
include '../../lib/Zebra_Image.php';

include './blockbuster_api_class/GenerateSecretKey.php';
$secure = new GenerateKeySecret();
$xmljson = new XmlToJson();

//echo "<pre>";
$current_index = 0;
$st = 0;
$newarray = $xmljson->getMovieName($current_index, 1);
//echo var_dump($newarray);
//$current_index = $newarray['index_value'];
//echo "</pre>";
//
//exit();

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
$event_is_private = "";
$event_is_eticket = "";
$event_is_pticket = "";
$event_is_home_delivery = "";
$event_is_collectable = "";
$event_is_pickable_from_ticketchai = "";
$event_is_pickable = "";
$event_is_pickable_type = "";
$event_pick_details = "";
$event_is_COD = "";
$event_is_online_payable = "";
$event_status = "";
$event_is_cancel = "";
$event_cancel_policy = "";
$event_organizer_details = "";
$event_is_seat_plan = "";
$event_is_delivery_cost = "";
$event_tag = array();


// Event Tag Code Start Here //
$tag = array();
$getEventTag = "SELECT * FROM tags";
$resultTag = mysqli_query($con, $getEventTag);
if ($resultTag) {
    while ($obj = mysqli_fetch_object($resultTag)) {
        $tag[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultTag error: " . mysqli_error($con);
    } else {
        $err = "resultTag query failed.";
    }
}

// Event Tag Code End Here //

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

    if (!$event_is_eticket OR $event_is_eticket != "yes") {
        $event_is_eticket = 'no';
    }

    if (!$event_is_pticket OR $event_is_pticket != "yes") {
        $event_is_pticket = 'no';
    }
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

    if (!$event_is_pickable_type) {
        $event_is_pickable_type = "no";
    }

    if (!$event_is_COD OR $event_is_COD != "yes") {
        $event_is_COD = 'no';
    }
    if (!$event_is_online_payable OR $event_is_online_payable != "yes") {
        $event_is_online_payable = 'no';
    }
    if (!$event_is_cancel OR $event_is_cancel != "yes") {
        $event_is_cancel = 'no';
    }

    if (!$event_is_delivery_cost OR $event_is_delivery_cost != "yes") {
        $event_is_delivery_cost = 'no';
    }
    /*     * ************** Event Web Logo Image Code start Here *********************** */
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

        $zebra_web_logo = new Zebra_Image();
        $zebra_web_logo->source_path = $_FILES["event_web_logo"]["tmp_name"]; /* original image path */
        $zebra_web_logo->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/' . $event_web_logo_name;

        if (!$zebra_web_logo->resize(1300)) {
            zebraImageErrorHandaling($zebra_web_logo->error);
        }
//        
//        if (!(move_uploaded_file($event_web_logo_source, $image_target_path))) {
//            $err = "Web Logo upload failed.";
//        }
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

        //        if (!(move_uploaded_file($event_web_logo_source, $image_target_path_mobile))) {
        //            $err = "Web Logo upload failed for mobile.";
        //        }
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
        $image_target_path_banner = $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/' . $event_web_banner_name;

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

        $event_eticket_banner = basename($_FILES['event_eticket_banner']['name']);
        $info = pathinfo($event_eticket_banner, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $event_eticket_banner_name = 'eetb_' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $event_eticket_banner_source = $_FILES["event_eticket_banner"]["tmp_name"];

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/', 0777, TRUE);
        }
        $image_target_path_ticket = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/' . $event_eticket_banner_name;
        $zebra_ticket = new Zebra_Image();
        $zebra_ticket->source_path = $_FILES["event_eticket_banner"]["tmp_name"]; /* original image path */
        $zebra_ticket->target_path = $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/' . $event_eticket_banner_name;

//        if (!(move_uploaded_file($event_eticket_banner_source, $image_target_path))) {
//            $err = "eTicket Banner upload failed.";
//        }
        if (!$zebra_ticket->resize(1300)) {
            zebraImageErrorHandaling($zebra_ticket->error);
        }

        // mobile

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
    $event_featured_priority = mysqli_real_escape_string($con, $event_featured_priority);
    $event_is_coming = mysqli_real_escape_string($con, $event_is_coming);
    $event_coming_priority = mysqli_real_escape_string($con, $event_coming_priority);
    $event_is_private = mysqli_real_escape_string($con, $event_is_private);
    $event_is_free = mysqli_real_escape_string($con, $event_is_free);
    $event_is_seat_plan = mysqli_real_escape_string($con, $event_is_seat_plan);
    $event_is_eticket = mysqli_real_escape_string($con, $event_is_eticket);
    $event_is_pticket = mysqli_real_escape_string($con, $event_is_pticket);
    $event_is_home_delivery = mysqli_real_escape_string($con, $event_is_home_delivery);
    $event_is_collectable = mysqli_real_escape_string($con, $event_is_collectable);
    $event_is_pickable = mysqli_real_escape_string($con, $event_is_pickable);
    $event_is_pickable_type = mysqli_real_escape_string($con, $event_is_pickable_type);
    $event_is_pickable_from_ticketchai = mysqli_real_escape_string($con, $event_is_pickable_from_ticketchai);
    $event_pick_details = mysqli_real_escape_string($con, $event_pick_details);
    $event_is_COD = mysqli_real_escape_string($con, $event_is_COD);
    $event_is_online_payable = mysqli_real_escape_string($con, $event_is_online_payable);
    $event_is_cancel = mysqli_real_escape_string($con, $event_is_cancel);
    $event_cancel_policy = mysqli_real_escape_string($con, $event_cancel_policy);
    $event_tag = mysqli_real_escape_string($con, $event_tag);
    $event_organizer_details = mysqli_real_escape_string($con, $event_organizer_details);
    $event_is_delivery_cost = mysqli_real_escape_string($con, $event_is_delivery_cost);
    $event_created_by = getSession("admin_id");
    $event_created_on = date("Y-m-d H:i:s");
    $event_status = "inactive";


    $check_Event = "select * from events where event_title = '$event_title'";
    $check_EventRun = mysqli_query($con, $check_Event);
    $countEvent = mysqli_num_rows($check_EventRun);
    if ($countEvent >= 1) {
        $err = "Event title already exists";
    } else {

        
                
        $insert_EventArray = '';
        $insert_EventArray .= ' event_title = "' . $event_title . '"';
        $insert_EventArray .= ', event_category_id = "' . $event_category_id . '"';
        $insert_EventArray .= ', event_description = "' . $event_description . '"';
        $insert_EventArray .= ', event_terms_conditions = "' . $event_terms_conditions . '"';
        $insert_EventArray .= ', event_web_logo = "' . $event_web_logo . '"';
        $insert_EventArray .= ', event_web_banner = "' . $event_web_banner . '"';
        $insert_EventArray .= ', event_eticket_banner = "' . $event_eticket_banner . '"';
        $insert_EventArray .= ', event_is_featured = "' . $event_is_featured . '"';
        $insert_EventArray .= ', event_featured_priority = "' . $event_featured_priority . '"';
        $insert_EventArray .= ', event_is_coming = "' . $event_is_coming . '"';
        $insert_EventArray .= ', event_coming_priority = "' . $event_coming_priority . '"';
        $insert_EventArray .= ', event_is_private = "' . $event_is_private . '"';
        $insert_EventArray .= ', event_is_free = "' . $event_is_free . '"';
        $insert_EventArray .= ', event_is_blockbuster = "yes"';
        $insert_EventArray .= ', event_is_seat_plan = "' . $event_is_seat_plan . '"';
        $insert_EventArray .= ', event_is_eticket = "' . $event_is_eticket . '"';
        $insert_EventArray .= ', event_is_pticket = "' . $event_is_pticket . '"';
        $insert_EventArray .= ', event_is_home_delivery = "' . $event_is_home_delivery . '"';
        $insert_EventArray .= ', event_is_collectable = "' . $event_is_collectable . '"';
        $insert_EventArray .= ', event_is_pickable_from_office = "' . $event_is_pickable_from_ticketchai . '"';
        $insert_EventArray .= ', event_is_pickable = "' . $event_is_pickable . '"';
        $insert_EventArray .= ', event_is_pickable_type = "' . $event_is_pickable_type . '"';
        $insert_EventArray .= ', event_pick_details = "' . $event_pick_details . '"';
        $insert_EventArray .= ', event_is_COD = "' . $event_is_COD . '"';
        $insert_EventArray .= ', event_is_online_payable = "' . $event_is_online_payable . '"';
        $insert_EventArray .= ', event_is_cancel = "' . $event_is_cancel . '"';
        $insert_EventArray .= ', event_cancel_policy = "' . $event_cancel_policy . '"';
        $insert_EventArray .= ', event_tag = "' . $event_tag . '"';
        $insert_EventArray .= ', event_organizer_details = "' . $event_organizer_details . '"';
        $insert_EventArray .= ', event_is_delivery_cost = "' . $event_is_delivery_cost . '"';
        $insert_EventArray .= ', event_created_by = "' . $event_created_by . '"';
        $insert_EventArray .= ', event_created_on = "' . $event_created_on . '"';
        $insert_EventArray .= ', event_status = "' . $event_status . '"';

        $run_insert_query = "INSERT INTO events SET $insert_EventArray";
        $result = mysqli_query($con, $run_insert_query);
        if (!$result) {
            if (DEBUG) {
                $err = "run_insert_query` error: " . mysqli_error($con);
            } else {
                $err = "run_insert_query query failed.";
            }
        } else {
            
            
            
            $event_id = mysqli_insert_id($con);
            
            
            $movarray='';
            $movarray .='name="'.$newarray['MovieName'].'",';
            $movarray .='movie_id="'.$newarray['MovieID'].'",';
            $movarray .='event_id="'.$event_id.'",';
            $movarray .='releasedate="'.$newarray['ReleaseDate'].'",';
            $movarray .='moviestartdate="'.$newarray['MovieStartDate'].'",';
            $movarray .='movieenddate="'.$newarray['MovieEndDate'].'",';
            $movarray .='movietype="'.$newarray['MovieType'].'",';
            $movarray .='date="'.date('Y-m-d').'",';
            $movarray .='status="'.$newarray['MovieStatus'].'"';



            $run_insert_query_mov = "INSERT INTO event_movie_list SET $movarray";
            $result_mov = mysqli_query($con, $run_insert_query_mov);
            
            
            
            $msg = "Event saved successfully";
            $link = "created_event_list_blockbuster_api.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
            redirect($link);
        }
    }
}
//$err = "ERROR";
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
        <script type="text/javascript">
            function callchnageimage(img)
            {
                var textimagelink = '';
                var cat = false;
                //<!--/-->
                if (document.getElementById('rdo_0').checked == true)
                {
                    var textimagelink = img;
                    var cat = true;
                }

                if (document.getElementById('rdo_1').checked == true)
                {
                    var textimagelink = img;
                    var cat = true;
                }
                
                if (document.getElementById('rdo_2').checked == true)
                {
                    $('.load_from_api').hide('slow');
                    $('#load_from_manual').show('slow');
                    var cat = false;
                }

                if (cat == true)
                {
                    
                    $('#load_from_manual').css("display","none");
                    $('.load_from_api').show('slow');
                    $('#event_web_logo,#event_web_banner,#event_web_banner').val(img);
                    //alert(textimagelink);
                }
                


            }
        </script>
    </head>
    <body class="">

        <?php include basePath('admin/header.php'); ?>
        <script id="treeview-template" type="text/kendo-ui-template">
            <input type='checkbox' name='event_category_id[]' id='event_category_id'
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
            <h3 class="bg-white content-heading border-bottom strong">Create Event</h3>
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
                                                        <div class="col-md-2">Event Title</div>
                                                        <div class="col-md-4">
                                                            <input class="form-control" readonly="readonly" style="height: 20px; width:87%"  id="event_title" name="event_title" value="<?php echo $newarray['MovieName']; ?>" type="text" />
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Event Tag</div>
                                                        <div class="col-md-4" >
                                                            <select multiple="multiple" style="height: 25px; width:95%" id="select2_3" name="event_tag[]" >

                                                                <?php if (count($tag) >= 1): ?>
                                                                    <?php foreach ($tag as $at): ?>
                                                                        <option value="<?php echo $at->tag_title; ?>"  
                                                                        <?php
                                                                        if ($at->tag_id) {
                                                                            
                                                                        }
                                                                        ?>>
                                                                                    <?php echo $at->tag_title; ?>
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
                                                        <div class="col-md-2">Choose Image</div>
                                                        <?php

                                                        function save_image($inPath, $outPath) { //Download images from remote server
                                                            $in = fopen($inPath, "rb");
                                                            $out = fopen($outPath, "wb");
                                                            while ($chunk = fread($in, 8192)) {
                                                                fwrite($out, $chunk, 8192);
                                                            }
                                                            fclose($in);
                                                            fclose($out);
                                                        }

                                                        $img1 = "../../upload/event_web_logo/" . $newarray['MovieID'] . '_' . time() . '.jpg';
                                                        $img2 = "../../upload/event_web_logo/" . $newarray['MovieID'] . '_1_' . time() . '.png';
                                                        @save_image('http://image.blockbusterbd.net/' . $newarray['Banner'], $img1);
                                                        @save_image('http://image.blockbusterbd.net/' . $newarray['MovieID'], $img2);
                                                        ?>

                                                        <div class="col-md-4">
                                                            <div class="col-sm-3">
                                                                <div class="col-md-12">
                                                                    <label>Auto 1 <input type="radio" onclick="callchnageimage('<?php echo substr($img1, 28, 100000) ?>')" name="rdoimage" id="rdo_0"></label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <img src="<?php echo $img1; ?>"   class="img-responsive">
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="col-md-12">
                                                                    <label>Auto 2 <input type="radio" onclick="callchnageimage('<?php echo substr($img2, 28, 100000) ?>')" name="rdoimage" id="rdo_1"></label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <img src="<?php echo $img2; ?>" class="img-responsive">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="col-md-12">
                                                                    <label>Manual <input type="radio" onclick="callchnageimage('2')" name="rdoimage" id="rdo_2"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                    </div>
                                                    <div class="form-group load_from_api">
                                                        <div class="col-md-2">Web Logo</div>                                                            
                                                        <div class="col-md-4">
                                                            <input class="form-control" readonly="readonly" style="height: 20px; width:87%"  id="event_web_logo" name="event_web_logo" value="<?php echo substr($img1,28,10000); ?>" type="text" />
                                                        </div>
                                                        <div class="clearfix"></div>

                                                    </div>

                                                    <div class="form-group load_from_api">
                                                        <div class="col-md-2">Web Banner</div>
                                                        <div class="col-md-4">
                                                            <input class="form-control" readonly="readonly" style="height: 20px; width:87%"  id="event_web_banner" name="event_web_banner" value="<?php echo substr($img1,28,10000); ?>" type="text" />
                                                        </div>

                                                    </div>
                                                    <div class="form-group load_from_api">
                                                        <div class="col-md-2">Ticket Banner</div>
                                                        <div class="col-md-4">
                                                            <input class="form-control" readonly="readonly" style="height: 20px; width:87%"  id="event_web_banner" name="event_eticket_banner" value="<?php echo substr($img1,28,10000); ?>" type="text" />
                                                        </div>
                                                    </div>

                                                    <span  id="load_from_manual" style="display: none;">

                                                    <div class="form-group">
                                                        <div class="col-md-2">Web Logo</div>
                                                        <div class="col-md-4"> 
                                                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                                                <span style="border-color: #799D37;" class="btn btn-default btn-file">
                                                                    <span class="fileupload-new"></span>
                                                                    <span class="fileupload-exists"></span>
                                                                    <input type="file" id="event_web_logo" name="event_web_logo" style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Web Banner</div>
                                                        <div class="col-md-4"> 
                                                            <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                                                <span style="border-color: #799D37;" class="btn btn-default btn-file">
                                                                    <span class="fileupload-new"></span><span class="fileupload-exists"></span>
                                                                    <input type="file" id="event_web_banner" name="event_web_banner" style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"></span>
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
                                                                    <input type="file" id="event_eticket_banner" name="event_eticket_banner" style="width:86%"/>
                                                                </span>
                                                                <span class="fileupload-preview"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                    </span>

                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Featured ?</div>
                                                        <div class="col-md-4">
                                                            <input onchange="javascript:checkFeatured();" type="checkbox" name="event_is_featured" id="event_is_featured" value="yes" <?php
                                                            if ($event_is_featured == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                            <span style="display: none" id="featShow">
                                                                <input class="form-control" style="width: 230px;height: 20px;" id="event_featured_priority" name="event_featured_priority" value="<?php echo $event_featured_priority; ?>" type="number" min="0" placeholder="featured priority"/>
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
                                                            <span style="display: none" id="upShow">
                                                                <input class="form-control" style="width: 230px;height: 20px;" id="event_coming_priority" name="event_coming_priority" value="<?php echo $event_coming_priority; ?>" type="number" min="0" placeholder="upcoming priority"/>
                                                            </span>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Free ?</div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="event_is_free" id="event_is_free" value="yes" <?php
                                                            if ($event_is_free == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Private ?</div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="event_is_private" id="event_is_private" value="yes" <?php
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
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="event_is_seat_plan" id="event_is_seat_plan" value="yes" <?php
                                                            if ($event_is_seat_plan == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
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

                                                    <div class="form-group">
                                                        <div class="col-md-2">Is E-Ticket ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_eticket" id="event_is_eticket" value="yes" <?php
                                                            if ($event_is_eticket == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Printed-Ticket ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_pticket" id="event_is_pticket" value="yes" <?php
                                                            if ($event_is_pticket == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
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
                                                            if ($event_is_collectable == 'yes') {
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
                                                                <label class="col-md-4 text-center"><input onclick="detailpick()" value="1" type="radio" name="event_is_pickable_type" id="single_1" /> From One Point</label>
                                                                <label class="col-md-4 text-center"><input onclick="detailpick()" value="2" type="radio" name="event_is_pickable_type" id="multiple_1" /> From Multiple Point</label>
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
                                <!-- Payment method start -->
                                <div class="innerAll spacing-x2">
                                    <div class="widget widget-inverse">
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Cash On Delivery ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_COD" id="event_is_COD" value="yes" <?php
                                                            if ($event_is_COD == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-2">Is Online Payable ?</div>
                                                        <div class="col-md-4"><input type="checkbox" name="event_is_online_payable" id="event_is_online_payable" value="yes" <?php
                                                            if ($event_is_online_payable == 'yes') {
                                                                echo 'checked="checked"';
                                                            }
                                                            ?>/>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div style="height: 20px"></div>
                                                <div class="form-actions">
                                                    <button  type="button" id="btnPaymentMethodNext" name="btnPaymentMethodNext" style="margin-left: -7px;" class="btn btn-primary"><i class="fa fa-check-circle"></i> Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Payment method end -->
                                <!-- Organizer Details-->
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
                                <!-- Organizer Details-->
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
                                                        <div style="display: none" id="cancelPolicyShow">

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
                                                    <button type="button"  id="btnSaveEvent" name="btnSaveEvent" class="btn btn-primary"><i class="fa fa-check-circle"></i> Create Event</button>
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
        });</script>
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

                if (typeof event_is_COD === "undefined" && typeof event_is_online_payable === "undefined") {

                    $("#paymentError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Select atleast one payment method</em></strong></div>');
                } else {
                    $("#paymentError").html('');
                    tabControl(6, 7);
                }
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

        var cloneCount = 1;
        var cloneCountd = 0;
        function cloneTableRow(table)
        {
            var increval = cloneCount++;
            var increvald = cloneCountd++;
            var $tr = $(table + ' tbody:first').children("tr:last").clone();

            $tr.find("input[type!='hidden'][name*=first_name],select,button").clone();
            //$(table+' tbody:first').children("tr:last").after($tr);
            $(table + ' tbody:first').children("tr:last").after($tr);
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
