<?php
include '../../config/config.php';

include './blockbuster_api_class/GenerateSecretKey.php';
$secure = new GenerateKeySecret();
$xmljson = new XmlToJson();

//echo "<pre>";
$current_index = 0;
$st = 0;
$newarray = $xmljson->getMovieName($current_index, 1);
//echo var_dump($newarray);
$current_index = $newarray['index_value'];




$nmov_id=$newarray['MovieID'];
$nbanner_id=$newarray['Banner'];
$event_title = $newarray['MovieName'];
$chk=  mysqli_num_rows(mysqli_query($con,"SELECT * FROM events WHERE event_title='".$event_title."'"));
if($chk==0)
{

    $img2_extension=pathinfo("http://image.blockbusterbd.net/".$nbanner_id, PATHINFO_EXTENSION);
    $img1_extension=$img2_extension;


$defualtgrabimage=$nmov_id . '_' . time() .".". $img1_extension;

$img1 = "../../upload/event_web_logo/" . $defualtgrabimage;
copy('http://image.blockbusterbd.net/' . $nbanner_id, $img1);





$makedescription='&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;DIRECTOR&lt;/h4&gt;&lt;p class="text_align_style_center" style="margin-bottom:0;font-size:15px;"&gt;'.$newarray['DirName'].' &lt;/p&gt;&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;CAST&lt;/h4&gt;&lt;p class="text_align_style_center" style="margin-bottom:0;font-size:15px;"&gt;Not Mention Yet &lt;/p&gt;&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;RUNTIME&lt;/h4&gt;&lt;p class="text_align_style_center" style="margin-bottom:0;font-size:15px;"&gt;2:45 Min &lt;/p&gt;&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;RELEASE DATE&lt;/h4&gt;&lt;p class="text_align_style_center" style="margin-bottom:0;font-size:15px;"&gt;'.$newarray['ReleaseDate'].' &lt;/p&gt;&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;RATING&lt;/h4&gt;&lt;p class="text_align_style_center" style="margin-bottom:0;font-size:15px;"&gt;Not-Available &lt;/p&gt;&lt;h4 class="uppercase_style text_align_style_center" style="margin-bottom:0;"&gt;GENRE&lt;/h4&gt;&lt;p class="text_align_style_center" style="font-size:15px;"&gt;Not Mention &lt;/p&gt;&lt;div class="row" style="border-top:1px solid #f2f2f2;margin-top:0px;padding-left:10px;"&gt;&lt;h4&gt;SYNOPSIS&lt;/h4&gt;&lt;/div&gt;&lt;p&gt;None.&lt;/p&gt;&lt;p class="text_align_style_center" style="font-size:15px;"&gt;&lt;br /&gt;&lt;/p&gt;&lt;p class="text_align_style_center" style="font-size:15px;"&gt;&lt;br /&gt;&lt;/p&gt;';

$event_description = $makedescription;
$event_terms_conditions = "Not Mentioned";


// Event Tag Code Start Here //

// Event Tag Code End Here //

        $event_tag = "0,4,10";
        $event_is_featured = 'no';
        $event_is_seat_plan = 'no';
        $event_is_coming = 'no';
        $event_is_free = 'no';
        $event_is_private = 'no';
       $event_is_eticket = 'no';
        $event_is_pticket = 'no';
        $event_is_home_delivery = 'no';
        $event_is_collectable = 'no';
        $event_is_pickable_from_ticketchai = 'no';
        $event_is_pickable = 'no';
        $event_is_pickable_type = "no";
        $event_is_COD = 'no';
        $event_is_online_payable = 'yes';
        $event_is_cancel = 'no';
        $event_is_delivery_cost = 'no';
    /*     * ************** Event Web Logo Image Code start Here *********************** */

        //get image and relocate from text field
        $event_web_logo_api=$defualtgrabimage;
        $event_web_logo_name = $defualtgrabimage;
        $event_web_banner_name = $defualtgrabimage;
        $event_eticket_banner_name = $defualtgrabimage;
        
        $source_url_image=baseUrl()."upload/event_web_logo/".$event_web_logo_api;
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/mobile/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_web_logo/desktop/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/mobile/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_web_banner/desktop/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/mobile/' . $event_web_logo_api);
        copy($source_url_image, $config['IMAGE_UPLOAD_PATH'] . '/event_eticket_banner/desktop/' . $event_web_logo_api);
    
    /*     * *************** Event Ticket Image Code End Here *********************** */



    $strEventCatID = $event_tag;

    $event_title = mysqli_real_escape_string($con, $event_title);
    $event_category_id = mysqli_real_escape_string($con, $strEventCatID);
    $event_description = mysqli_real_escape_string($con, $event_description);
    $event_terms_conditions = mysqli_real_escape_string($con, $event_terms_conditions);
    $event_web_logo = mysqli_real_escape_string($con, $event_web_logo_name);
    $event_web_banner = mysqli_real_escape_string($con, $event_web_banner_name);
    $event_eticket_banner = mysqli_real_escape_string($con, $event_eticket_banner_name);
    $event_is_featured = mysqli_real_escape_string($con, $event_is_featured);
    $event_featured_priority = "0";
    $event_is_coming = mysqli_real_escape_string($con, $event_is_coming);
    $event_coming_priority = "0";
    $event_is_private = mysqli_real_escape_string($con, $event_is_private);
    $event_is_free = mysqli_real_escape_string($con, $event_is_free);
    $event_is_seat_plan = mysqli_real_escape_string($con, $event_is_seat_plan);
    $event_is_eticket = mysqli_real_escape_string($con, $event_is_eticket);
    $event_is_pticket = mysqli_real_escape_string($con, $event_is_pticket);
    $event_is_home_delivery = mysqli_real_escape_string($con, $event_is_home_delivery);
    $event_is_collectable = mysqli_real_escape_string($con, $event_is_collectable);
    $event_is_pickable = mysqli_real_escape_string($con, $event_is_pickable);
    $event_is_pickable_type = "";
    $event_is_pickable_from_ticketchai = mysqli_real_escape_string($con, $event_is_pickable_from_ticketchai);
    $event_pick_details = "";
    $event_is_COD = mysqli_real_escape_string($con, $event_is_COD);
    $event_is_online_payable = mysqli_real_escape_string($con, $event_is_online_payable);
    $event_is_cancel = "";
    $event_cancel_policy = "";
    $event_tag = mysqli_real_escape_string($con, $event_tag);
    $event_organizer_details = "Blockbuster";
    $event_is_delivery_cost = "";
    $event_created_by = "";
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
            $err="erro";
        } else {



            $event_id = mysqli_insert_id($con);


            $movarray = '';
            $movarray .='name="' . $newarray['MovieName'] . '",';
            $movarray .='movie_id="' . $newarray['MovieID'] . '",';
            $movarray .='event_id="' . $event_id . '",';
            $movarray .='releasedate="' . $newarray['ReleaseDate'] . '",';
            $movarray .='moviestartdate="' . $newarray['MovieStartDate'] . '",';
            $movarray .='movieenddate="' . $newarray['MovieEndDate'] . '",';
            $movarray .='movietype="' . $newarray['MovieType'] . '",';
            $movarray .='date="' . date('Y-m-d') . '",';
            $movarray .='status="' . $newarray['MovieStatus'] . '"';



          $run_insert_query_mov = "INSERT INTO event_movie_list SET $movarray";
            $result_mov = mysqli_query($con, $run_insert_query_mov);


        }
    }
}
