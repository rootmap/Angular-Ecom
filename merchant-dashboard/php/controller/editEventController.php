<?php
//ini_set('max_execution_time', 0);
//error_reporting(0);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';

define('Homepage_Top_Banner', '../../../upload/slider/');
define('HTBW', '1300');
define('HTBH', '200');
define('Homepage_Event_Thumbs', '../../../upload/event_web_logo/');
define('HETW', '320');
define('HETH', '250');
define('Event_Top_Banner', '../../../upload/event_web_banner/');
define('ETBW', '1170');
define('ETBH', '370');
define('Event_List_Thumbs', '../../../upload/event_list_thumb/');
define('ELTW', '120');
define('ELTH', '120');

function CleanLink($imagelink) {
    $data = str_replace("../", "", $imagelink);
    return $data;
}

function getImageMimeType($data) {
    $sepaimage = explode("/", $data);
    $sepsplit = explode(";", $sepaimage[1]);

    $extension = $sepsplit[0];
    if ($extension == "png") {
        return $extension;
    } elseif ($extension == "jpeg") {
        return $extension;
    } else {
        return $extension;
    }
}

function CleanImage($data) {
    $data = str_replace('data:image/png;base64,', 'AAAFBfj42Pj4');
    $data = str_replace('data:image/jpeg;base64,', 'AAAFBfj42Pj4');
    $data = str_replace('data:image/JPEG;base64,', 'AAAFBfj42Pj4');
    $data = str_replace('data:image/jpg;base64,', 'AAAFBfj42Pj4');
    $data = str_replace('data:image/JPG;base64,', 'AAAFBfj42Pj4');
    $data = str_replace(' ', '+', $data);
    return $data;
}
function GenerateImageMove($imageData, $path, $pre, $width, $height) {
    $data = 'data:image/png;base64,AAAFBfj42Pj4';
    list($type, $imageData) = explode(';', $imageData);
    list(, $extension) = explode('/', $type);
    list(, $imageData) = explode(',', $imageData);


    $fileName = $pre . time() . '.' . $extension;
    $imageData = base64_decode($imageData);
    $linkfile = $path . $fileName;

    file_put_contents($linkfile, $imageData);

    //return upload_image($width, $height, $path, $linkfile, $pre, $extension);
    #############################  resize image #############################


    $ret_name = $pre . '_' . time() . '.' . $extension;
    $re_linkfile = $path . $ret_name;
// Requires string image as parm, returns image resource
    $im = imagecreatefromstring($imageData);

// Get width and height of original image resource
    $origWidth = imagesx($im);
    $origHeight = imagesy($im);

// Create new destination image resource for new 24 x 24 image
    $imNew = imagecreatetruecolor($width, $height);

// Re-sample image to smaller size and display

    if (strtolower($extension) == 'png') {
        $image = imageCreateFromPng($linkfile);
        imageAlphaBlending($image, true);
        imageSaveAlpha($image, true);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagepng($imNew, $re_linkfile, 5);
        imagedestroy($imNew);
        unlink($linkfile);
    } elseif (strtolower($extension) == 'jpg') {

        $image = imagecreatefromjpeg($linkfile);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagejpeg($imNew, $re_linkfile, 50);
        imagedestroy($imNew);
        unlink($linkfile);
    } elseif (strtolower($extension) == 'jpeg') {

        $image = imagecreatefromjpeg($linkfile);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagejpeg($imNew, $re_linkfile, 50);
        imagedestroy($imNew);
        unlink($linkfile);
    } elseif (strtolower($extension == 'gif')) {
        $image = imagecreatefromgif($linkfile);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagegif($imNew, $re_linkfile, 50);
        imagedestroy($imNew);
        unlink($linkfile);
    }


    return $ret_name;
}
//
//function upload_image ($pre, $extension,$img_data,$path,$ori_filepath,$width, $height) {
//     $path2 =  $pre .'_'. time() . '.' . $extension;
//   
//    $linkfile2 = $path . $path2;
//// Requires string image as parm, returns image resource
//    $im = imagecreatefromstring($img_data);
//
//// Get width and height of original image resource
//    $origWidth = imagesx($im);
//    $origHeight = imagesy($im);
//
//// Create new destination image resource for new 24 x 24 image
//$imNew = imagecreatetruecolor(100, 200);
//
//// Re-sample image to smaller size and display
//
//    $image = imagecreatefromjpeg($ori_filepath) ;
//    imagecopyresampled($imNew, $image, 0, 0, 0, 0, 100, 200, $origWidth, $origHeight) ;
//
//    imagejpeg($imNew, $linkfile2, 100) ;
//    //return $fileName;
//    imagejpeg($imNew);
//    magedestroy($im);
//    imagedestroy($imNew);
//}

$EventURL = '';
$EventT_C = '';
$EventCategory = '';
$EventSubCategory = '';
$Organize_details='';
$EventType = '';
$OrganizedBy = ''; /* 1st step working data submit end here */

/* 2nd step working data submit start here */
 $StartDate = '';
 $StartTime = '';
 $EndDate = '';
 $EndTime = ''; /* 2st step working data submit end here */

/* 3rd step working data submit start here */
$NameOfVenue ='';
$StreetLine1 ='';
$StreetLine2 ='';
$CityFrom ='';
$venueZip ='';
$CountryFiled = ''; /* 3rd step working data submit end here */

/* 4th step working data submit start here */
/* @var $data type */
$EventDescription = '';
$EventTerms = '';
//@$EventTags = $tagName;
$PaymentGatewayAndServiceCharge = '';
$ChangetheLabel = ''; /* 4th step working data submit end here */

$tick_availability = '';
$tick_currency = '';
$tick_end_date = '';
$tick_end_time = '';
$tick_fee_from = '';
$tick_max_quan = '';
$tick_min_quan = '';
$tick_name = '';
$tick_price = '';
$tick_quantity = '';
$tick_start_date = '';
$tick_start_time = '';
$tick_type = '';
$tick_desc = '';
$tick_mess_atten = '';

$check_name_ID = '';
$check_namest = '';

// Including database connections end here
$data = json_decode(file_get_contents("php://input"));
echo $EventDescription = $data->evt_desc;
echo $EventTerms = $data->evt_terms;
echo $tick_desc = $data->tick_desc;
echo $tick_mess_atten = $data->tick_mess_atten;

$success = 0;
$paymentMethod = $data->paymentMethod;

$offlinePaymentMethod = $data->offlinePaymentMethod;

$eventDetails = $data->event;
$ticketDetails = $data->ticket;

print_r($ticketDetails );
print_r($eventDetails );

$pick_point = $data->pick_point;
$tags = $data->tags;

print_r($tags );

@$coverD_img=$data->coverD_img;
@$thambD_img=$data->thambD_img;

@$cover = $data->imageOne;
@$thumb = $data->imageTwo;

 @$e_status=$data->e_status;
$tagName = '';
$venueID = 0;
$geo_address='';
$geocode='';
$f = 1;
$tagstring = "";




foreach ($tags as $index => $value) {
     //$tagName = $index->tag;
     $tagstring=implode(", ",$tags);
    if ($f == 1) {
        //$index .=$tagName;
        $tagstring=implode(" ",$tags);
    } else {
        //$tagstring .="," . $tagName;
        $tagstring=implode(", ",$tags);
    }
    $f++;
}
function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

function Get_LatLng_From_Google_Maps($address) {
    $address = urlencode($address);
    $geocode='';
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

    // Make the HTTP request
    $data = @file_get_contents($url);
    // Parse the json response
    $jsondata = json_decode($data,true);

    // If the json data is invalid, return empty array
    if (!check_status($jsondata))   return $geocode .='23.8751027,90.39067810000006';;

    $LatLng = array(
        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
    );
     //$geocode .=implode(",",$LatLng);
     return $geocode .=implode(",",$LatLng);
   
}
 

  
   

 $EventName = $eventDetails->EventName;

if (!empty($EventName)) {
    
    $EventURL = $eventDetails->EventURL;
    $EventCategory = $eventDetails->EventCategory;
    $EventSubCategory = $eventDetails->EventSubCategory;
    $EventType = $eventDetails->EventType;
    $Organize_details=$eventDetails->org_details;
    $OrganizedBy = $eventDetails->OrganizedBy; /* 1st step working data submit end here */
    
    /* 2nd step working data submit start here */
    $StartDate = $eventDetails->evt_start_date; 
    $StartTime = $eventDetails->evt_start_time;
    $EndDate = $eventDetails->evt_end_date;
    $EndTime = $eventDetails->evt_end_time; /* 2st step working data submit end here */

    /* 3rd step working data submit start here */
    $NameOfVenue = $eventDetails->ven_name;
    $StreetLine1 = $eventDetails->ven_address;
    $StreetLine2 = $eventDetails->ven_addresss;
    $CityFrom = $eventDetails->ven_city;
    $venueZip = $eventDetails->ven_zip;
    $CountryFiled = $eventDetails->ven_country; /* 3rd step working data submit end here */

    /* 4th step working data submit start here */
    /* @var $data type */
    
    //@$EventTags = $tagName;
    $PaymentGatewayAndServiceCharge = $eventDetails->pm_gt_fee;
    $ChangetheLabel = $eventDetails->evt_btn_lbl; /* 4th step working data submit end here */
    $geo_address=$NameOfVenue;
    $geocode= Get_LatLng_From_Google_Maps($geo_address);
    
    $EventT_C=$eventDetails->evt_terms;
    $today = date('Y-m-d');
    /* Data encoding end here */
    exit();
     if ($EventType=='7') {
        //echo 'if';
      $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
        event_description='$EventDescription',event_terms_conditions='$EventTerms', event_organizer_details='$Organize_details',event_tag='$tagstring',event_status='private',event_created_by='$login_user_id'";
       
    }else {
          //echo 'else';
        if ($e_status == 'active') {
            $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
        event_description='$EventDescription',event_terms_conditions='$EventTerms', event_organizer_details='$Organize_details',event_tag='$tagstring',event_status='active',event_created_by='$login_user_id'";
        }elseif ($e_status == 'upcoming') {
            $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
        event_description='$EventDescription',event_tag='$tagstring',event_status='upcoming',event_created_by='$login_user_id'";
        }
        else {
            $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
        event_description='$EventDescription',event_terms_conditions='$EventT_C', event_organizer_details='$Organize_details',event_tag='$tagstring',event_status='pending',event_created_by='$login_user_id'";
        }
    }
//    if($e_status=='active'){
//        $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_terms_conditions='$EventT_C', event_organizer_details='$Organize_details',event_tag='$tagstring',event_status='active',event_created_by='$login_user_id'";
//    }else {
//          $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_terms_conditions='$EventT_C', event_organizer_details='$Organize_details',event_tag='$tagstring',event_status='pending',event_created_by='$login_user_id'";
//    }
    $result = mysqli_query($con, $sql);
    $event_id = mysqli_insert_id($con);

//INSERT PAYMENTGETWAY DATA

    $sqlPaymentGateway = "INSERT INTO  payment_gateway_charges_list SET pms_id='$PaymentGatewayAndServiceCharge',event_id='$event_id',date='$today' ";
    $resultPaymentGateway = mysqli_query($con, $sqlPaymentGateway);

//INSERT BUTTON LEBEL DATA
    
     if (!empty($ChangetheLabel)) {
        $sqlButtonLabel = "INSERT INTO event_button_list SET button_id='$ChangetheLabel',event_id='$event_id',status='1',date='$today' ";
    }  else {
        $ChangetheLabelDefault =1;
        $sqlButtonLabel = "INSERT INTO event_button_list SET button_id='$ChangetheLabelDefault',event_id='$event_id',status='1',date='$today' ";
    }
   
    $resultButtonLabel = mysqli_query($con, $sqlButtonLabel);



    $venueSql = "INSERT INTO event_venues SET venue_event_id='$event_id', venue_title='$NameOfVenue',venue_address='$StreetLine2',city='$CityFrom',country='$CountryFiled',venue_start_date='$StartDate', venue_end_date='$EndDate', venue_start_time='$StartTime', venue_end_time='$EndTime',venue_geo_location='$geocode', venue_zip='$venueZip',venue_created_by='$login_user_id' ";
    $resultVenueSql = mysqli_query($con, $venueSql);




    $event = $event_id;
    $ft = "textbox";
    $qt = "name";
    $vd = "yes";
    $ep = "no";

    $field_name = strtolower(str_replace(" ", "_", $qt));
    $field_id = $field_name;

    $insert_string = "INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";

    $insdata = mysqli_query($con, $insert_string);

    if ($insdata == 1) {
        $success+=1;
    }

    $insert_string = '';




    $event = $event_id;
    $ft = "textbox";
    $qt = "email";
    $vd = "yes";
    $ep = "no";

    $field_name = strtolower(str_replace(" ", "_", $qt));
    $field_id = $field_name;

    $insert_string = "INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";

    $insdata = mysqli_query($con, $insert_string);

    if ($insdata == 1) {
        $success+=1;
    }

    $insert_string = '';
    
     $event = $event_id;
    $ft = "textbox";
    $qt = "phone";
    $vd = "yes";
    $ep = "no";

    $field_name = strtolower(str_replace(" ", "_", $qt));
    $field_id = $field_name;

    $insert_string = "INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";

    $insdata = mysqli_query($con, $insert_string);

    if ($insdata == 1) {
        $success+=1;
    }

    $insert_string = '';

    if (!empty($cover)) {
       
        $es = GenerateImageMove($cover, Homepage_Top_Banner, "ES", HTBW, HTBH);
        $het = GenerateImageMove($cover, Homepage_Event_Thumbs, "HET", HETW, HETH);
        $etb = GenerateImageMove($cover, Event_Top_Banner, "ETB", ETBW, ETBH);
        $elt = GenerateImageMove($cover, Event_List_Thumbs, "ELT", ELTW, ELTH);
        mysqli_query($con, "UPDATE events SET event_web_banner='$etb' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
    }  else {
        mysqli_query($con, "UPDATE events SET event_web_banner='$coverD_img' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");

    }

    if (!empty($thumb)) {
       // echo 'img 2';
        $es_card = GenerateImageMove($thumb, Homepage_Top_Banner, "ES_CARD", HTBW, HTBH);
        $het_card = GenerateImageMove($thumb, Homepage_Event_Thumbs, "HET_CARD", HETW, HETH);
        $etb_card = GenerateImageMove($thumb, Event_Top_Banner, "ETB_CARD", ETBW, ETBH);
        $elt_card = GenerateImageMove($thumb, Event_List_Thumbs, "ELT_CARD", ELTW, ELTH);
        mysqli_query($con, "UPDATE events SET event_web_logo='$het_card' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es_card','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het_card','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb_card','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt_card','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
    }  else {
         mysqli_query($con, "UPDATE events SET event_web_logo='$thambD_img' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
    }
    if ($result == 1 && $resultVenueSql == 1 && $resultPaymentGateway == 1 && $resultButtonLabel == 1) {
        //echo 1;
        
    } else {
        //echo 2;
    }

    $sqlVenueID = "SELECT `venue_id` FROM `event_venues` WHERE `venue_event_id`='$event_id' ";
    $run = mysqli_query($con, $sqlVenueID);
    $venueData = mysqli_fetch_object($run);
    //print_r($venueData);
     $venueID = $venueData->venue_id;

    if ($resultVenueSql == 1) {
  //  print_r($ticketDetails );
        foreach ($ticketDetails as $index => $value) {

  //print_r($ticketDetails );
//exit();

//    $rein = $ticketDetails[$index]->rein;
//    $eddate = $ticketDetails[$index]->eddate;
//    $stdate = $ticketDetails[$index]->stdate;
            $tick_availability = $ticketDetails[$index]->tick_availability;
            $tick_currency = $ticketDetails[$index]->tick_currency;
            $tick_end_date = $ticketDetails[$index]->tick_end_date;
            $tick_end_time = $ticketDetails[$index]->tick_end_date;
            $tick_fee_from = $ticketDetails[$index]->tick_fee_from;
            $tick_max_quan = $ticketDetails[$index]->tick_max_quan;
            $tick_min_quan = $ticketDetails[$index]->tick_min_quan;
            $tick_name = $ticketDetails[$index]->tick_name;
            $tick_price = $ticketDetails[$index]->tick_price;
            $tick_quantity = $ticketDetails[$index]->tick_quantity;
            $tick_start_date = $ticketDetails[$index]->tick_start_date;
            $tick_start_time = $ticketDetails[$index]->tick_start_time;
            $tick_type = $ticketDetails[$index]->tick_type;
         
            $tick_mess_atten = $data->tick_mess_atten;


            $sql = "INSERT INTO event_ticket_types SET "
                    . "TT_event_id='$event_id', "
                    . "TT_venue_id='$venueID', "
                    . "TT_type_id='$tick_type', "
                    . "TT_type_title='$tick_name', "
                    . "TT_price='$tick_price', "
                    . "TT_availability='$tick_availability', "
                    . "TT_WhowillpayTicketchaifee='$tick_fee_from',"
                    . "TT_currency='$tick_currency',"
                    . "TT_MessageToAttendee='$tick_mess_atten',"
                    . "TT_ticket_quantity='$tick_quantity',"
                    . "TTmin_quantity='$tick_min_quan',"
                    . "TT_per_user_limit='$tick_max_quan',"
                    . "TT_startDate='$tick_start_date',"
                    . "TT_endDate='$tick_end_date',"
                    . "TT_startTime='$tick_start_time',"
                    . "TT_endTime='$tick_end_time',"
                    . "TT_type_description='$tick_desc'";
            $sqlTicket = mysqli_query($con, $sql);
            if ($sqlTicket == 1) {
                //echo 1;
            } else {
                echo 'Fail query';
            }
        }

// PAYMENT METHOD DATA INSERT

        foreach ($paymentMethod as $index => $value) {

//         $check_name = $paymentMethod[$index]->check_name;
            $check_name_ID = $paymentMethod[$index]->check_name_ID;
            $check_namest = $paymentMethod[$index]->check_namest;
//         $check_namest = $paymentMethod[$index]->check_namest;


            $sqlPaymentMethod = "INSERT INTO `eventwise_payment_method` SET event_id='$event_id', payment_method_id='$check_name_ID', date='$today', status='$check_namest'";

            $resultPaymentMethod = mysqli_query($con, $sqlPaymentMethod);
            if ($resultPaymentMethod == 1) {
                //echo 1;
            } else {
                //echo 2;
            }
        }

        foreach ($offlinePaymentMethod as $index => $value) {

            $check_name_ID_off = $value->off_check_name_ID;
            $check_namest_off = $value->off_check_namest;


            $sqlPaymentMethod = "INSERT INTO `eventwise_payment_method` SET event_id='$event_id', payment_method_id='$check_name_ID_off', date='$today', status='$check_namest_off'";

            $resultPaymentMethod = mysqli_query($con, $sqlPaymentMethod);
            if ($resultPaymentMethod == 1) {
                //echo 1;
            } else {
                //echo 2;
            }
        }

        foreach ($pick_point as $index => $value) {
            $point_name = $value->point_name;
            $point_address = $value->point_address;
            $point_contact_detail = $value->point_contact_detail;
            $sql = "INSERT INTO event_pick_point SET created_by='$login_user_id', event_id='$event_id', name='$point_name', date='$today', status='1', address='$point_address', point_details='$point_contact_detail'";
        
            $sqlResultpick_point = mysqli_query($con, $sql);
            if ($sqlResultpick_point == 1) {
                //echo 1;
            } else {
                //echo 2;
            }
        }
        
        
        
        
        
        
    }
    echo json_encode($event_id);
   
} else {
    echo 0;
   
}







////ini_set('max_execution_time', 0);
////error_reporting(0);
///*
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
//
//include '../../DBconnection/auth.php';
///*
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
//
//// Including database connections start here
//require_once '../../DBconnection/database_connections.php';
//
//define('Homepage_Top_Banner', '../../../upload/slider/');
//define('HTBW', '1300');
//define('HTBH', '200');
//define('Homepage_Event_Thumbs', '../../../upload/event_web_logo/');
//define('HETW', '320');
//define('HETH', '250');
//define('Event_Top_Banner', '../../../upload/event_web_banner/');
//define('ETBW', '1170');
//define('ETBH', '370');
//define('Event_List_Thumbs', '../../../upload/event_list_thumb/');
//define('ELTW', '120');
//define('ELTH', '120');
//
//function CleanLink($imagelink) {
//    $data = str_replace("../", "", $imagelink);
//    return $data;
//}
//
//function getImageMimeType($data) {
//    $sepaimage = explode("/", $data);
//    $sepsplit = explode(";", $sepaimage[1]);
//
//    $extension = $sepsplit[0];
//    if ($extension == "png") {
//        return $extension;
//    } elseif ($extension == "jpeg") {
//        return $extension;
//    } else {
//        return $extension;
//    }
//}
//
//function CleanImage($data) {
//    $data = str_replace('data:image/png;base64,', 'AAAFBfj42Pj4');
//    $data = str_replace('data:image/jpeg;base64,', 'AAAFBfj42Pj4');
//    $data = str_replace('data:image/JPEG;base64,', 'AAAFBfj42Pj4');
//    $data = str_replace('data:image/jpg;base64,', 'AAAFBfj42Pj4');
//    $data = str_replace('data:image/JPG;base64,', 'AAAFBfj42Pj4');
//    $data = str_replace(' ', '+', $data);
//    return $data;
//}
//
//   
//function GenerateImageMove($imageData, $path, $pre, $width, $height) {
//    $data = 'data:image/png;base64,AAAFBfj42Pj4';
//    list($type, $imageData) = explode(';', $imageData);
//    list(, $extension) = explode('/', $type);
//    list(, $imageData) = explode(',', $imageData);
//
//
//    $fileName = $pre . time() . '.' . $extension;
//    $imageData = base64_decode($imageData);
//    $linkfile = $path . $fileName;
//
//    file_put_contents($linkfile, $imageData);
//
//    //return upload_image($width, $height, $path, $linkfile, $pre, $extension);
//    #############################  resize image #############################
//
//
//    $ret_name = $pre . '_' . time() . '.' . $extension;
//    $re_linkfile = $path . $ret_name;
//// Requires string image as parm, returns image resource
//    $im = imagecreatefromstring($imageData);
//
//// Get width and height of original image resource
//    $origWidth = imagesx($im);
//    $origHeight = imagesy($im);
//
//// Create new destination image resource for new 24 x 24 image
//    $imNew = imagecreatetruecolor($width, $height);
//
//// Re-sample image to smaller size and display
//
//    if (strtolower($extension) == 'png') {
//        $image = imageCreateFromPng($linkfile);
//        imageAlphaBlending($image, true);
//        imageSaveAlpha($image, true);
//        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
//        imagepng($imNew, $re_linkfile, 5);
//        imagedestroy($imNew);
//        unlink($linkfile);
//    } elseif (strtolower($extension) == 'jpg') {
//
//        $image = imagecreatefromjpeg($linkfile);
//        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
//        imagejpeg($imNew, $re_linkfile, 50);
//        imagedestroy($imNew);
//        unlink($linkfile);
//    } elseif (strtolower($extension) == 'jpeg') {
//
//        $image = imagecreatefromjpeg($linkfile);
//        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
//        imagejpeg($imNew, $re_linkfile, 50);
//        imagedestroy($imNew);
//        unlink($linkfile);
//    } elseif (strtolower($extension == 'gif')) {
//        $image = imagecreatefromgif($linkfile);
//        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
//        imagegif($imNew, $re_linkfile, 50);
//        imagedestroy($imNew);
//        unlink($linkfile);
//    }
//
//
//    return $ret_name;
//}
//function upload_image ($pre, $extension,$img_data,$path,$ori_filepath,$width, $height) {
//     $path2 =  $pre .'_'. time() . '.' . $extension;
//   
//    $linkfile2 = $path . $path2;
//// Requires string image as parm, returns image resource
//    $im = imagecreatefromstring($img_data);
//
//// Get width and height of original image resource
//    $origWidth = imagesx($im);
//    $origHeight = imagesy($im);
//
//// Create new destination image resource for new 24 x 24 image
//$imNew = imagecreatetruecolor(100, 200);
//
//// Re-sample image to smaller size and display
//
//    $image = imagecreatefromjpeg($ori_filepath) ;
//    imagecopyresampled($imNew, $image, 0, 0, 0, 0, 100, 200, $origWidth, $origHeight) ;
//
//    imagejpeg($imNew, $linkfile2, 100) ;
//    //return $fileName;
//    imagejpeg($imNew);
//    magedestroy($im);
//    imagedestroy($imNew);
//}
//
//
//
////Image upload process end here
//
//
//$EventURL = '';
//$EventCategory = '';
//$EventSubCategory = '';
//$EventType = '';
//$OrganizedBy = ''; /* 1st step working data submit end here */
//
//$oldCoverImageName = '';
//
///* 2nd step working data submit start here */
//$StartDate = '';
//$StartTime = '';
//$EndDate = '';
//$EndTime = ''; /* 2st step working data submit end here */
//
///* 3rd step working data submit start here */
//$NameOfVenue ='';
//$StreetLine1 ='';
//$StreetLine2 ='';
//$CityFrom ='';
//$venueZip ='';
//$CountryFiled = ''; /* 3rd step working data submit end here */
//
///* 4th step working data submit start here */
//
//$EventDescription = '';
//
////@$EventTags = $tagName;
//
//$PaymentGatewayAndServiceCharge = '';
//$ChangetheLabel = ''; /* 4th step working data submit end here */
//
//$tick_availability = '';
//$tick_currency = '';
//$tick_end_date = '';
//$tick_end_time = '';
//$tick_fee_from = '';
//$tick_max_quan = '';
//$tick_min_quan = '';
//$tick_name = '';
//$tick_price = '';
//$tick_quantity = '';
//$tick_start_date = '';
//$tick_start_time = '';
//$tick_type = '';
//$tick_desc = '';
//$tick_mess_atten = '';
//
//$check_name_ID = '';
//$check_namest = '';
//
//// Including database connections end here
//$data = json_decode(file_get_contents("php://input"));
//
//echo $EvenTID = $data->eventId;
//echo $EventDescription = $data->evt.evt_desc;
//
//echo json_encode($EvenTID);
//echo json_encode($EventDescription);
////$tick_desc = $data->tick_desc;
////$tick_mess_atten = $data->tick_mess_atten;
////
////$success = 0;
//// $paymentMethod = $data->paymentMethod;
//// $offlinePaymentMethod = $data->offlinePaymentMethod;
////
//// 
////
////$eventDetails = $data->event;
////$ticketDetails = $data->ticket;
////$pick_point = $data->pick_point;
////$tags = $data->tags;
////
////@$coverD_img=$data->coverD_img;
////@$thambD_img=$data->thambD_img;
////
////@$cover = $data->imageOne;
////@$thumb = $data->imageTwo;
////
//// @$e_status=$data->e_status;
//
//$tagName = '';
//$venueID = 0;
//$geo_address='';
//$geocode='';
//$f = 1;
//$tagstring = "";
//
//
//
//
//foreach ($tags as $index => $value) {
//     //$tagName = $index->tag;
//     $tagstring=implode(", ",$tags);
//    if ($f == 1) {
//        //$index .=$tagName;
//        $tagstring=implode(" ",$tags);
//    } else {
//        //$tagstring .="," . $tagName;
//        $tagstring=implode(", ",$tags);
//    }
//    $f++;
//}
//function check_status($jsondata) {
//    if ($jsondata["status"] == "OK") return true;
//    return false;
//}
//
//function Get_LatLng_From_Google_Maps($address) {
//    $address = urlencode($address);
//    $geocode='';
//    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
//
//    // Make the HTTP request
//    $data = @file_get_contents($url);
//    // Parse the json response
//    $jsondata = json_decode($data,true);
//
//    // If the json data is invalid, return empty array
//    if (!check_status($jsondata))   return $geocode .='23.8751027,90.39067810000006';;
//
//    $LatLng = array(
//        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
//        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
//    );
//     //$geocode .=implode(",",$LatLng);
//     return $geocode .=implode(",",$LatLng);
//}
//
// 
//
//  
//    
//
//
// $EventName = $eventDetails->EventName;
//
//if (!empty($EventName)) {
//    
//    $EventURL = $eventDetails->EventURL;
//    $EventCategory = $eventDetails->EventCategory;
//    $EventSubCategory = $eventDetails->EventSubCategory;
//    $EventType = $eventDetails->EventType;
//    $OrganizedBy = $eventDetails->OrganizedBy; /* 1st step working data submit end here */
//
//    $oldCoverImageName = $eventDetails->banner; 
//    
//    /* 2nd step working data submit start here */
//    $StartDate = $eventDetails->evt_start_date; 
//     $StartTime = $eventDetails->StartTime;
//    $EndDate = $eventDetails->evt_end_date;
//     $EndTime = $eventDetails->EndTime; /* 2st step working data submit end here */
//
//    /* 3rd step working data submit start here */
//    $NameOfVenue = $eventDetails->ven_name;
//    $StreetLine1 = $eventDetails->ven_address;
//    $StreetLine2 = $eventDetails->ven_addresss;
//    $CityFrom = $eventDetails->ven_city;
//    $venueZip = $eventDetails->ven_zip;
//    $CountryFiled = $eventDetails->ven_country; /* 3rd step working data submit end here */
//
//    /* 4th step working data submit start here */
//    /* @var $data type */
//   
//    //@$EventTags = $tagName;
//    $PaymentGatewayAndServiceCharge = $eventDetails->pm_gt_fee;
//    $ChangetheLabel = $eventDetails->evt_btn_lbl; /* 4th step working data submit end here */
//    $geo_address=$NameOfVenue;
//    $geocode= Get_LatLng_From_Google_Maps($geo_address);
//
//    $today = date('Y-m-d');
//    /* Data encoding end here */
//
//     if ($EventType=='7') {
//        //echo 'if';
//        $sql = "UPDATE events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy', event_web_banner='$oldCoverImageName',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='private',event_created_by='$login_user_id' WHERE event_id = '$EvenTID'";
//        
//    }else {
//         //echo 'else';
//        if ($e_status == 'active') {
//            $sql = "UPDATE events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_web_banner='$oldCoverImageName',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='active',event_created_by='$login_user_id' WHERE event_id = '$EvenTID'";
//        }elseif ($e_status == 'upcoming') {
//            $sql = "UPDATE events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_web_banner='$oldCoverImageName',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='upcoming',event_created_by='$login_user_id' WHERE event_id = '$EvenTID'";
//        }
//        else {
//            $sql = "UPDATE events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_web_banner='$oldCoverImageName',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='pending',event_created_by='$login_user_id' WHERE event_id = '$EvenTID'";
//        }
//    }
////    if($e_status=='active'){
////        $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
////        event_description='$EventDescription',event_tag='$tagstring',event_status='active',event_created_by='$login_user_id'";
////    }else {
////          $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
////        event_description='$EventDescription',event_tag='$tagstring',event_status='pending',event_created_by='$login_user_id'";
////    }
//    $result = mysqli_query($con, $sql);
//    $event_id = mysqli_insert_id($con);
//
////INSERT PAYMENTGETWAY DATA
//
//    $sqlPaymentGateway = "UPDATE  payment_gateway_charges_list SET pms_id='$PaymentGatewayAndServiceCharge',event_id='$EvenTID',date='$today'  WHERE event_id = '$EvenTID'";
//    $resultPaymentGateway = mysqli_query($con, $sqlPaymentGateway);
//
////INSERT BUTTON LEBEL DATA
//    $sqlButtonLabel = "UPDATE event_button_list SET button_id='$ChangetheLabel',event_id='$EvenTID',status='1',date='$today'  WHERE event_id = '$EvenTID'";
//    $resultButtonLabel = mysqli_query($con, $sqlButtonLabel);
//
//
//
//    $venueSql = "UPDATE event_venues SET venue_event_id='$EvenTID', venue_title='$NameOfVenue',venue_address='$StreetLine1',city='$CityFrom',country='$CountryFiled',venue_start_date='$StartDate', venue_end_date='$EndDate', venue_start_time='$StartTime', venue_end_time='$EndTime',venue_geo_location='$geocode', venue_zip='$venueZip',venue_created_by='$login_user_id'  WHERE event_id = '$EvenTID'";
//    $resultVenueSql = mysqli_query($con, $venueSql);
//
//
//
//
//    $event = $event_id;
//    $ft = "textbox";
//    $qt = "name";
//    $vd = "yes";
//    $ep = "no";
//
//    $field_name = strtolower(str_replace(" ", "_", $qt));
//    $field_id = $field_name;
//
//    $insert_string = "INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
//    $insert_string .="form_field_type='$ft',";
//    $insert_string .="form_field_title='$qt',";
//    $insert_string .="form_field_name='$field_name',";
//    $insert_string .="form_field_given_id='$field_id',";
//    $insert_string .="form_field_is_required='$vd',";
//    $insert_string .="entry_pass='$ep',";
//    $insert_string .="version='1'";
//
//    $insdata = mysqli_query($con, $insert_string);
//
//    if ($insdata == 1) {
//        $success+=1;
//    }
//
//    $insert_string = '';
//
//
//
//
//    $event = $event_id;
//    $ft = "textbox";
//    $qt = "email";
//    $vd = "yes";
//    $ep = "no";
//
//    $field_name = strtolower(str_replace(" ", "_", $qt));
//    $field_id = $field_name;
//
//    $insert_string = "INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
//    $insert_string .="form_field_type='$ft',";
//    $insert_string .="form_field_title='$qt',";
//    $insert_string .="form_field_name='$field_name',";
//    $insert_string .="form_field_given_id='$field_id',";
//    $insert_string .="form_field_is_required='$vd',";
//    $insert_string .="entry_pass='$ep',";
//    $insert_string .="version='1'";
//
//    $insdata = mysqli_query($con, $insert_string);
//
//    if ($insdata == 1) {
//        $success+=1;
//    }
//
//    $insert_string = '';
//
//    if (!empty($cover)) {
//       
//        $es = GenerateImageMove($cover, Homepage_Top_Banner, "ES", HTBW, HTBH);
//        $het = GenerateImageMove($cover, Homepage_Event_Thumbs, "HET", HETW, HETH);
//        $etb = GenerateImageMove($cover, Event_Top_Banner, "ETB", ETBW, ETBH);
//        $elt = GenerateImageMove($cover, Event_List_Thumbs, "ELT", ELTW, ELTH);
//        mysqli_query($con, "UPDATE events SET event_web_banner='$etb' WHERE event_id='$event_id'");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
//    }  else {
//        mysqli_query($con, "UPDATE events SET event_web_banner='$coverD_img' WHERE event_id='$event_id'");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$coverD_img','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
//
//    }
//
//    if (!empty($thumb)) {
//       // echo 'img 2';
//        $es_card = GenerateImageMove($thumb, Homepage_Top_Banner, "ES_CARD", HTBW, HTBH);
//        $het_card = GenerateImageMove($thumb, Homepage_Event_Thumbs, "HET_CARD", HETW, HETH);
//        $etb_card = GenerateImageMove($thumb, Event_Top_Banner, "ETB_CARD", ETBW, ETBH);
//        $elt_card = GenerateImageMove($thumb, Event_List_Thumbs, "ELT_CARD", ELTW, ELTH);
//        mysqli_query($con, "UPDATE events SET event_web_logo='$het_card' WHERE event_id='$event_id'");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es_card','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het_card','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb_card','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt_card','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
//    }  else {
//         mysqli_query($con, "UPDATE events SET event_web_logo='$thambD_img' WHERE event_id='$event_id'");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
//        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$thambD_img','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
//    }
//    if ($result == 1 && $resultVenueSql == 1 && $resultPaymentGateway == 1 && $resultButtonLabel == 1) {
//        //echo 1;
//        
//    } else {
//        //echo 2;
//    }
//
//    $sqlVenueID = "SELECT `venue_id` FROM `event_venues` WHERE `venue_event_id`='$event_id' ";
//    $run = mysqli_query($con, $sqlVenueID);
//    $venueData = mysqli_fetch_object($run);
//    //print_r($venueData);
//     $venueID = $venueData->venue_id;
//
//    if ($resultVenueSql == 1) {
//        foreach ($ticketDetails as $index => $value) {
//
//
////    $rein = $ticketDetails[$index]->rein;
////    $eddate = $ticketDetails[$index]->eddate;
////    $stdate = $ticketDetails[$index]->stdate;
//            $tick_availability = $ticketDetails[$index]->tick_availability;
//            $tick_currency = $ticketDetails[$index]->tick_currency;
//            $tick_end_date = $ticketDetails[$index]->tick_end_date;
//            $tick_end_time = $ticketDetails[$index]->tick_end_time;
//            $tick_fee_from = $ticketDetails[$index]->tick_fee_from;
//            $tick_max_quan = $ticketDetails[$index]->tick_max_quan;
//            $tick_min_quan = $ticketDetails[$index]->tick_min_quan;
//            $tick_name = $ticketDetails[$index]->tick_name;
//            $tick_price = $ticketDetails[$index]->tick_price;
//            $tick_quantity = $ticketDetails[$index]->tick_quantity;
//            $tick_start_date = $ticketDetails[$index]->tick_start_date;
//            $tick_start_time = $ticketDetails[$index]->tick_start_time;
//            $tick_type = $ticketDetails[$index]->tick_type;
//         
//            $tick_mess_atten = $data->tick_mess_atten;
//
//
//            $sql = "UPDATE event_ticket_types SET "
//                    . "TT_event_id='$event_id', "
//                    . "TT_venue_id='$venueID', "
//                    . "TT_type_id='$tick_type', "
//                    . "TT_type_title='$tick_name', "
//                    . "TT_price='$tick_price', "
//                    . "TT_availability='$tick_availability', "
//                    . "TT_WhowillpayTicketchaifee='$tick_fee_from',"
//                    . "TT_currency='$tick_currency',"
//                    . "TT_MessageToAttendee='$tick_mess_atten',"
//                    . "TT_ticket_quantity='$tick_quantity',"
//                    . "TTmin_quantity='$tick_min_quan',"
//                    . "TT_per_user_limit='$tick_max_quan',"
//                    . "TT_startDate='$tick_start_date',"
//                    . "TT_endDate='$tick_end_date',"
//                    . "TT_startTime='$tick_start_time',"
//                    . "TT_endTime='$tick_end_time',"
//                    . "TT_type_description='$tick_desc' WHERE TT_event_id = '$EvenTID'";
//            $sqlTicket = mysqli_query($con, $sql);
//            if ($sqlTicket == 1) {
//                //echo 1;
//            } else {
//                echo 'Fail query';
//            }
//        }
//
//// PAYMENT METHOD DATA INSERT
//
//        foreach ($paymentMethod as $index => $value) {
//
////         $check_name = $paymentMethod[$index]->check_name;
//            $check_name_ID = $paymentMethod[$index]->check_name_ID;
//            $check_namest = $paymentMethod[$index]->check_namest;
////         $check_namest = $paymentMethod[$index]->check_namest;
//
//
//            $sqlPaymentMethod = "UPDATE `eventwise_payment_method` SET event_id='$event_id', payment_method_id='$check_name_ID', date='$today', status='$check_namest' WHERE event_id = '$EvenTID'";
//
//            $resultPaymentMethod = mysqli_query($con, $sqlPaymentMethod);
//            if ($resultPaymentMethod == 1) {
//                //echo 1;
//            } else {
//                //echo 2;
//            }
//        }
//
//        foreach ($offlinePaymentMethod as $index => $value) {
//
//            $check_name_ID_off = $value->off_check_name_ID;
//            $check_namest_off = $value->off_check_namest;
//
//
//            $sqlPaymentMethod = "UPDATE `eventwise_payment_method` SET event_id='$event_id', payment_method_id='$check_name_ID_off', date='$today', status='$check_namest_off' WHERE event_id = '$EvenTID'";
//
//            $resultPaymentMethod = mysqli_query($con, $sqlPaymentMethod);
//            if ($resultPaymentMethod == 1) {
//                //echo 1;
//            } else {
//                //echo 2;
//            }
//        }
//
//        foreach ($pick_point as $index => $value) {
//            $point_name = $value->point_name;
//            $point_address = $value->point_address;
//            $point_contact_detail = $value->point_contact_detail;
//            $sql = "UPDATE event_pick_point SET created_by='$login_user_id', event_id='$event_id', name='$point_name', date='$today', status='1', address='$point_address', point_details='$point_contact_detail' WHERE event_id = '$EvenTID'";
//        
//            $sqlResultpick_point = mysqli_query($con, $sql);
//            if ($sqlResultpick_point == 1) {
//                //echo 1;
//            } else {
//                //echo 2;
//            }
//        }
//        
//        
//        
//        
//        
//        
//    }
//    //echo json_encode($event_id);
//   
//} else {
//    echo 0;
//   
//}
























