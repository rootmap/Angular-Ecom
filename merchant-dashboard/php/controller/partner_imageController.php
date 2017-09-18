<?php

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */
// Including database connections end here
$event_id = $data->event_id;
//$TT_id = $data->ticket_id;
$cover = $data->photo;

define('TICKET_PARTNER_IMAGE', '../../../upload/ticket_partner/');
define('HTBW', '200');
define('HTBH', '200');

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
    if ($extension == 'png' || $extension == 'PNG') {
        $image = imagecreatefrompng($linkfile);
    } else {
        $image = imagecreatefromjpeg($linkfile);
    }

    imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

    imagejpeg($imNew, $re_linkfile, 100);

    return $fileName;
    if ($extension == 'png' || $extension == 'PNG') {
        imagepng($imNew);
    } else {
        imagejpeg($imNew);
    }

    magedestroy($im);
    imagedestroy($imNew);
}

$image = '';
if (!empty($cover)) {
    $image = GenerateImageMove($cover, TICKET_PARTNER_IMAGE, "TP", HTBW, HTBH);
} else {
    echo 0;
}



//$event_id = $data->event_id;
//$TT_id = $data->ticket_id;
//$cover = $data->photo;


$flag = false;

//if (!empty($event_id) && !empty($TT_id) && !empty($cover)):
if (!empty($event_id) && !empty($cover)):
    $flag = true;
endif;



if ($flag):
//    $selectSql = "SELECT * FROM `partner_image` WHERE e_id = '$event_id' AND TT_id = '$TT_id' ";
    $selectSql = "SELECT * FROM `partner_image` WHERE e_id = '$event_id' ";
    
    $result = mysqli_query($con, $selectSql);

    $count = mysqli_num_rows($result);

    if ($count == 0):
//        mysqli_query($con, "INSERT INTO  partner_image (e_id,TT_id,image) VALUES ('$event_id','$TT_id','$image')");
        mysqli_query($con, "INSERT INTO  partner_image (e_id,image) VALUES ('$event_id','$image')");
        echo '1';
    else:   
//        mysqli_query($con, "UPDATE partner_image SET e_id = '$event_id', TT_id = '$TT_id', image = '$image' ");
        mysqli_query($con, "UPDATE partner_image SET e_id = '$event_id', image = '$image' ");
        echo '2'; 
    endif;
endif;    





    






























