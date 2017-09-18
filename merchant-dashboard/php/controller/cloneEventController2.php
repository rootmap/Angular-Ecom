<?php

include '../../DBconnection/auth.php';

require_once '../../DBconnection/database_connections.php';



$EventURL = '';
$EventT_C = '';
$EventCategory = '';
$EventSubCategory = '';
$EventType = '';
$Organize_details = '';
$OrganizedBy = ''; /* 1st step working data submit end here */

$c = '';
$l = '';

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
$EventDescription = $data->evt_desc;
echo '<pre>';
print_r($EventDescription);
$tick_desc = $data->tick_desc;
$tick_mess_atten = $data->tick_mess_atten;

$success = 0;
$paymentMethod = $data->paymentMethod;
$offlinePaymentMethod = $data->offlinePaymentMethod;
$eventDetails = $data->event;
$ticketDetails = $data->ticket;
$pick_point = $data->pick_point;
$tags = $data->tags;


 @$e_status=$data->e_status;
$tagName = '';
$venueID = 0;
$geo_address='';
$geocode='';
$f = 1;
$tagstring = "";


exit();

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
    $Organize_details = $eventDetails->org_details;
    $OrganizedBy = $eventDetails->OrganizedBy; /* 1st step working data submit end here */

    $c = $eventDetails->banner; 
    $l = $eventDetails->logo; 
    
    /* 2nd step working data submit start here */
    $StartDate = $eventDetails->evt_start_date; 
    $StartTime = $eventDetails->StartTime;
    $EndDate = $eventDetails->evt_end_date;
     $EndTime = $eventDetails->EndTime; /* 2st step working data submit end here */

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
    $EventT_C = $eventDetails->evt_terms;
    $PaymentGatewayAndServiceCharge = $eventDetails->pm_gt_fee;
    $ChangetheLabel = $eventDetails->evt_btn_lbl; /* 4th step working data submit end here */
    $geo_address=$NameOfVenue;
    $geocode= Get_LatLng_From_Google_Maps($geo_address);

    $today = date('Y-m-d');
    /* Data encoding end here */

     if ($EventType == '7') {
        //echo 'if';
        $sql = "INSERT INTO events SET "
                . "event_title='$EventName',"
                . "event_url='$EventURL',"
                . "event_category_id='$EventCategory',"
                . "eventSub_category='$EventSubCategory',"
                . "event_type='$EventType',"
                . "organized_by='$OrganizedBy', "
                . "event_web_banner='$c',"
                . "event_web_logo='$l',"
                . "event_created_on='$StartDate $StartTime',"
                . "event_created_end='$EndDate $EndTime',"
                . "name_of_venue='$NameOfVenue',"
                . "streetLine1='$StreetLine1',"
                . "streetLine2='$StreetLine2',"
                . "city_from='$CityFrom',"
                . "country_filed='$CountryFiled',"
                . " event_description='$EventDescription',"
                . "event_tag='$tagstring',"
                . "event_status='private',"
                . "event_terms_conditions='$EventT_C',"
                . "event_organizer_details='$Organize_details',"
                . "event_created_by='$login_user_id'";
    } else {
        //echo 'else';
        if ($e_status == 'active') {
            $sql = "INSERT INTO events SET "
                    . "event_title='$EventName',"
                    . "event_url='$EventURL',"
                    . "event_category_id='$EventCategory',"
                    . "eventSub_category='$EventSubCategory',"
                    . "event_type='$EventType',"
                    . "organized_by='$OrganizedBy',"
                    . "event_web_banner='$c',"
                    . "event_web_logo='$l',"
                    . "event_created_on='$StartDate $StartTime',"
                    . "event_created_end='$EndDate $EndTime',"
                    . "name_of_venue='$NameOfVenue',"
                    . "streetLine1='$StreetLine1',"
                    . "streetLine2='$StreetLine2',"
                    . "city_from='$CityFrom',"
                    . "country_filed='$CountryFiled',"
                    . "event_description='$EventDescription',"
                    . "event_tag='$tagstring',"
                    . "event_status='active',"
                    . "event_terms_conditions='$EventT_C',"
                    . "event_organizer_details='$Organize_details',"
                    . "event_created_by='$login_user_id'";
        } elseif ($e_status == 'upcoming') {
            $sql = "INSERT INTO events SET "
                    . "event_title='$EventName',"
                    . "event_url='$EventURL',"
                    . "event_category_id='$EventCategory',"
                    . "eventSub_category='$EventSubCategory',"
                    . "event_type='$EventType',"
                    . "organized_by='$OrganizedBy',"
                    . "event_web_banner='$c',"
                    . "event_web_logo='$l',"
                    . "event_created_on='$StartDate $StartTime',"
                    . "event_created_end='$EndDate $EndTime',"
                    . "name_of_venue='$NameOfVenue',"
                    . "streetLine1='$StreetLine1',"
                    . "streetLine2='$StreetLine2',"
                    . "city_from='$CityFrom',"
                    . "country_filed='$CountryFiled',"
                    . " event_description='$EventDescription',"
                    . "event_tag='$tagstring',"
                    . "event_status='upcoming',"
                    . "event_terms_conditions='$EventT_C',"
                    . "event_organizer_details='$Organize_details',"
                    . "event_created_by='$login_user_id'";
        } else {
            $sql = "INSERT INTO events SET "
                    . "event_title='$EventName',"
                    . "event_url='$EventURL',"
                    . "event_category_id='$EventCategory',"
                    . "eventSub_category='$EventSubCategory',"
                    . "event_type='$EventType',"
                    . "organized_by='$OrganizedBy',"
                    . "event_web_banner='$c',"
                    . "event_web_logo='$l',"
                    . "event_created_on='$StartDate $StartTime',"
                    . "event_created_end='$EndDate $EndTime',"
                    . "name_of_venue='$NameOfVenue',"
                    . "streetLine1='$StreetLine1',"
                    . "streetLine2='$StreetLine2',"
                    . "city_from='$CityFrom',"
                    . "country_filed='$CountryFiled',"
                    . "event_description='$EventDescription',"
                    . "event_tag='$tagstring',"
                    . "event_status='pending',"
                    . "event_terms_conditions='$EventT_C',"
                    . "event_organizer_details='$Organize_details',"
                    . "event_created_by='$login_user_id'";
        }
    }
//    if($e_status=='active'){
//        $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='active',event_created_by='$login_user_id'";
//    }else {
//          $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
//        event_description='$EventDescription',event_tag='$tagstring',event_status='pending',event_created_by='$login_user_id'";
//    }
    $result = mysqli_query($con, $sql);
    $event_id = mysqli_insert_id($con);

//INSERT PAYMENTGETWAY DATA

    $sqlPaymentGateway = "INSERT INTO  payment_gateway_charges_list SET pms_id='$PaymentGatewayAndServiceCharge',event_id='$event_id',date='$today' ";
    $resultPaymentGateway = mysqli_query($con, $sqlPaymentGateway);

//INSERT BUTTON LEBEL DATA
    $sqlButtonLabel = "INSERT INTO event_button_list SET button_id='$ChangetheLabel',event_id='$event_id',status='1',date='$today' ";
    $resultButtonLabel = mysqli_query($con, $sqlButtonLabel);



    $venueSql = "INSERT INTO event_venues SET venue_event_id='$event_id', venue_title='$NameOfVenue',venue_address='$StreetLine1',city='$CityFrom',country='$CountryFiled',venue_start_date='$StartDate', venue_end_date='$EndDate', venue_start_time='$StartTime', venue_end_time='$EndTime',venue_geo_location='$geocode', venue_zip='$venueZip',venue_created_by='$login_user_id' ";
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


    $sqlVenueID = "SELECT `venue_id` FROM `event_venues` WHERE `venue_event_id`='$event_id' ";
    $run = mysqli_query($con, $sqlVenueID);
    $venueData = mysqli_fetch_object($run);
    //print_r($venueData);
     $venueID = $venueData->venue_id;

    if ($resultVenueSql == 1) {
        foreach ($ticketDetails as $index => $value) {


//    $rein = $ticketDetails[$index]->rein;
//    $eddate = $ticketDetails[$index]->eddate;
//    $stdate = $ticketDetails[$index]->stdate;
            $tick_availability = $ticketDetails[$index]->tick_availability;
            $tick_currency = $ticketDetails[$index]->tick_currency;
            $tick_end_date = $ticketDetails[$index]->tick_end_date;
            $tick_end_time = $ticketDetails[$index]->tick_end_time;
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


            $sqlPaymentMethod = "INSERT INTO `eventwise_payment_method` SET "
                    . "event_id='$event_id', payment_method_id='$check_name_ID', date='$today', status='$check_namest'";

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


            $sqlPaymentMethod = "INSERT INTO `eventwise_payment_method` SET "
                    . "event_id='$event_id', payment_method_id='$check_name_ID_off', date='$today', status='$check_namest_off'";

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
























