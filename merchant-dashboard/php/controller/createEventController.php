<?php
include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';

// Including database connections end here

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
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace('data:image/jpeg;base64,', '', $data);
    $data = str_replace('data:image/JPEG;base64,', '', $data);
    $data = str_replace('data:image/jpg;base64,', '', $data);
    $data = str_replace('data:image/JPG;base64,', '', $data);
    $data = str_replace(' ', '+', $data);

    return $data;
}

function GenerateImageMove($img, $path, $pre, $width, $height) {
    $extension = getImageMimeType($img);
    $data = CleanImage($img);
    $data = base64_decode($data);
    $filename = $pre . time() . '.' . $extension;
    $linkfile = $path . $filename;
    $success = file_put_contents($linkfile, $data);

    return upload_image($width, $height, $path, $linkfile, $pre, $extension);

    //return $filename;
}

function upload_image($width, $height, $destination, $img_name, $pre, $extension) {
    $image_mime = image_type_to_mime_type(exif_imagetype($img_name));

    list($w, $h) = getimagesize($img_name);

    $custom_extension = $extension;

    $ret_name = $pre . '_' . time() . '.' . $custom_extension;
    $paths = $destination . '/' . $ret_name;
    $imgString = file_get_contents($img_name);
    $image = imagecreatefromstring($imgString);
    $tmp = imagecreatetruecolor($width, $height);

    imagealphablending($tmp, false);
    imagesavealpha($tmp, true);
    $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
    imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);

    imagecopyresized($tmp, $image, 0, 0, 0, 0, $width, $height, $w, $h);

    switch ($image_mime) {
        case 'image/jpeg':
            imagejpeg($tmp, $paths, 75);
            break;
        case 'image/jpg':
            imagejpeg($tmp, $paths, 75);
            break;
        case 'image/png':
            imagepng($tmp, $paths, 0);
            break;
        case 'image/gif':
            imagegif($tmp, $paths);
            break;
        default:
            exit;
            break;
    }
    return $ret_name;
    imagedestroy($image);
    imagedestroy($tmp);
    imagedestroy($img_name);
}

$EventTags = '';
/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */



//include('../../../cms/uploadImage_Class.php');
//$imagelib = new image_class();
    $cover = $data->cover;
    $thumb = $data->card;



    /* Data encoding start here */
    /* 1st step working data submit start here */
    $EventName = $data->EventName;
    
    if (!empty($EventName) && !empty($cover) && !empty($thumb)) {
    
    
    $EventURL = $data->EventURL;
    $EventCategory = $data->EventCategory;
    $EventSubCategory = $data->EventSubCategory;
    $EventType = $data->EventType;
    $OrganizedBy = $data->OrganizedBy; /* 1st step working data submit end here */

    /* 2nd step working data submit start here */

    $StartDate = $data->StartDate;
    $StartTime = $data->StartTime;
    $EndDate = $data->EndDate;
    $EndTime = $data->EndTime; /* 2st step working data submit end here */

    /* 3rd step working data submit start here */
    $NameOfVenue = $data->NameOfVenue;
    $StreetLine1 = $data->StreetLine1;
    $StreetLine2 = $data->StreetLine2;
    $CityFrom = $data->CityFrom;
    $CountryFiled = $data->CountryFiled; /* 3rd step working data submit end here */

    /* 4th step working data submit start here */
    /* @var $data type */
    $EventDescription = $data->EventDescription;
    @$EventTags = $data->EventTags;
    $PaymentGatewayAndServiceCharge = $data->PaymentGatewayAndServiceCharge;
    $ChangetheLabel = $data->ChangetheLabel; /* 4th step working data submit end here */


    /* Data encoding end here */

    $sql = "INSERT INTO events SET event_title='$EventName',event_url='$EventURL',event_category_id='$EventCategory',eventSub_category='$EventSubCategory',event_type='$EventType',organized_by='$OrganizedBy',event_created_on='$StartDate $StartTime',event_created_end='$EndDate $EndTime',name_of_venue='$NameOfVenue',streetLine1='$StreetLine1',streetLine2='$StreetLine2',city_from='$CityFrom',country_filed='$CountryFiled',
        event_description='$EventDescription',event_tag='$EventTags',payment_servicecge='$PaymentGatewayAndServiceCharge',change_Label='$ChangetheLabel',event_status='active',event_created_by='$login_user_id'";


    $result = mysqli_query($con, $sql);
    
    $event_id = mysqli_insert_id($con);
    
    
    

    

    $today = date('Y-m-d');
    
    
    $event=$event_id;
    $ft="textbox";
    $qt="name";
    $vd="yes";
    $ep="no";
    
    $field_name=  strtolower(str_replace(" ","_",$qt));
    $field_id=$field_name;
    
    $insert_string="INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";
    
    $insdata=mysqli_query($con,$insert_string);
    
    if($insdata==1)
    {
        @$success+=1;
    }
    
    $insert_string='';
    
    
    
    
    $event=$event_id;
    $ft="textbox";
    $qt="email";
    $vd="yes";
    $ep="no";
    
    $field_name=  strtolower(str_replace(" ","_",$qt));
    $field_id=$field_name;
    
    $insert_string="INSERT INTO event_dynamic_forms SET form_event_id='$event',form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";
    
    $insdata=mysqli_query($con,$insert_string);
    
    if($insdata==1)
    {
        $success+=1;
    }
    
    $insert_string='';

    if (!empty($cover)) {
        $es = GenerateImageMove($cover, Homepage_Top_Banner, "ES", HTBW, HTBH);
        $het = GenerateImageMove($cover, Homepage_Event_Thumbs, "HET", HETW, HETH);
        $etb = GenerateImageMove($cover, Event_Top_Banner, "ETB", ETBW, ETBH);
        $elt = GenerateImageMove($cover, Event_List_Thumbs, "ELT", ELTW, ELTH);
        mysqli_query($con,"UPDATE events SET event_web_banner='$etb' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
    }

    if (!empty($thumb)) {
        $es_card = GenerateImageMove($thumb, Homepage_Top_Banner, "ES_CARD", HTBW, HTBH);
        $het_card = GenerateImageMove($thumb, Homepage_Event_Thumbs, "HET_CARD", HETW, HETH);
        $etb_card = GenerateImageMove($thumb, Event_Top_Banner, "ETB_CARD", ETBW, ETBH);
        $elt_card = GenerateImageMove($thumb, Event_List_Thumbs, "ELT_CARD", ELTW, ELTH);
        mysqli_query($con,"UPDATE events SET event_web_logo='$het_card' WHERE event_id='$event_id'");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$es_card','" . CleanLink(Homepage_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het_card','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$etb_card','" . CleanLink(Event_Top_Banner) . "','" . $today . "')");
        mysqli_query($con, "INSERT INTO image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$elt_card','" . CleanLink(Event_List_Thumbs) . "','" . $today . "')");
    }
    if ($result == 1) {
        echo 1;
    } else {
        echo 2;
    }
}
else
{
    echo 0;
}





























