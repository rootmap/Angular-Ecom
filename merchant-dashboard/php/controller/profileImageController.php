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

define('Homepage_Top_Banner', '../../../upload/merchent_images/');
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

//function GenerateImageMove($img, $path, $pre, $width, $height) {
//    $extension = getImageMimeType($img);
//    $data = CleanImage($img);
//    $data = base64_decode($data);
//    $filename = $pre . time() . '.' . $extension;
//    $linkfile = $path . $filename;
//    $success = file_put_contents($linkfile, $data);
//
//    return upload_image($width, $height, $path, $linkfile, $pre, $extension);
//
//    //return $filename;
//}
//
//function upload_image($width, $height, $destination, $img_name, $pre, $extension) {
//    $image_mime = image_type_to_mime_type(exif_imagetype($img_name));
//
//    list($w, $h) = getimagesize($img_name);
//
//    $custom_extension = $extension;
//
//    $ret_name = $pre . '_' . time() . '.' . $custom_extension;
//    $paths = $destination . '/' . $ret_name;
//    $imgString = file_get_contents($img_name);
//    $image = imagecreatefromstring($imgString);
//    $tmp = imagecreatetruecolor($width, $height);
//
//    imagealphablending($tmp, false);
//    imagesavealpha($tmp, true);
//    $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
//    imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
//
//    imagecopyresized($tmp, $image, 0, 0, 0, 0, $width, $height, $w, $h);
//
//    switch ($image_mime) {
//        case 'image/jpeg':
//            imagejpeg($tmp, $paths, 75);
//            break;
//        case 'image/jpg':
//            imagejpeg($tmp, $paths, 75);
//            break;
//        case 'image/png':
//            imagepng($tmp, $paths, 0);
//            break;
//        case 'image/gif':
//            imagegif($tmp, $paths);
//            break;
//        default:
//            exit;
//            break;
//    }
//    return $ret_name;
//    imagedestroy($image);
//    imagedestroy($tmp);
//    imagedestroy($img_name);
//}
function GenerateImageMove($imageData, $path, $pre,$width, $height){
    $data = 'data:image/png;base64,AAAFBfj42Pj4';
    list($type, $imageData) = explode(';', $imageData);
    list(,$extension) = explode('/',$type);
    list(,$imageData)      = explode(',', $imageData);
    
 
    $fileName=$pre . time() . '.' . $extension;
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

    $image = imagecreatefromjpeg($linkfile) ;
    imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight) ;

    imagejpeg($imNew, $re_linkfile, 100) ;
    
    return $fileName;
    imagejpeg($imNew);
    magedestroy($im);
    imagedestroy($imNew);

    
}
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */



//include('../../../cms/uploadImage_Class.php');
//$imagelib = new image_class();
$cover = $data->photo;


if (!empty($cover)) {
    $es = GenerateImageMove($cover, Homepage_Top_Banner, "ES", HTBW, HTBH);
    session_regenerate_id();
    $_SESSION['SESS_MERCHANT_USER_IMAGE'] = $es;
    session_write_close();
    echo $es;
// mysqli_query($con, "INSERT INTO  image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
    mysqli_query($con, "UPDATE  admins SET admin_images='$es' WHERE admin_id='$login_user_id'");
} else {
    echo 0;
}

    






























