<?php

//database connection
require_once '../../DBconnection/database_connections.php';
//database connection
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection


define('Homepage_Top_Banner', '../../../upload/user_images/');
define('HTBW', '400');
define('HTBH', '400');

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
        imagejpeg($imNew, $re_linkfile, 75);
        imagedestroy($imNew);
        unlink($linkfile);
    } elseif (strtolower($extension) == 'jpeg') {

        $image = imagecreatefromjpeg($linkfile);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagejpeg($imNew, $re_linkfile, 75);
        imagedestroy($imNew);
        unlink($linkfile);
    } elseif (strtolower($extension == 'gif')) {
        $image = imagecreatefromgif($linkfile);
        imagecopyresampled($imNew, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagegif($imNew, $re_linkfile, 75);
        imagedestroy($imNew);
        unlink($linkfile);
    }


    return $ret_name;
}

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

$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */



//include('../../../cms/uploadImage_Class.php');
//$imagelib = new image_class();
$cover = $data->photo;


if (!empty($cover)) {
    $es = GenerateImageMove($cover, Homepage_Top_Banner, "ES", HTBW, HTBH);
    session_regenerate_id();
    $_SESSION['USER_DASHBOARD_USER_IMG'] = $es;
    session_write_close();
    echo $es;
// mysqli_query($con, "INSERT INTO  image_log (event_id,image_name,image_link,date) VALUES ('$event_id','$het','" . CleanLink(Homepage_Event_Thumbs) . "','" . $today . "')");
    $run = mysqli_query($con, "UPDATE  users SET user_images='$es' WHERE user_id='$login_user_id'");

    if ($run == 1) {
        echo 1;
    } else {
        echo 2;
    }
} else {
    echo 0;
}

    






























