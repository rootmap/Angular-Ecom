<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayBanner = array();
    $get_sql = "SELECT banner_id,banner_title,banner_image,banner_priority,banner_buy_ticket,banner_link,banner_link_type FROM banner ORDER BY banner_id DESC";
    $resultBannerQuery = mysqli_query($con, $get_sql);
    if ($resultBannerQuery) {
        while ($objBanner = mysqli_fetch_object($resultBannerQuery)) {
            $arrayBanner[] = $objBanner;
        }
    } else {
        if (DEBUG) {
            $err = "resultBannerQuery error: " . mysqli_error($con);
        } else {
            $err = "resultBannerQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayBanner) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arrayImage = array();
    $banner_id = mysqli_real_escape_string($con, $banner_id);
    $sqlBannerImage = "select banner_image from banner where banner_id = $banner_id";
    $resultBannerImage = mysqli_query($con, $sqlBannerImage);
    if ($resultBannerImage) {
        $arrayImage = mysqli_fetch_array($resultBannerImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/banner_image/' . $arrayImage["banner_image"]);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/banner_image/desktop/' . $arrayImage["banner_image"]);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/banner_image/mobile/' . $arrayImage["banner_image"]);
    } else {
        if (DEBUG) {
            $err = "resultBannerImage error: " . mysqli_error($con);
        } else {
            $err = "resultBannerImage query failed";
        }
    }

    $delete_sql = "DELETE FROM banner WHERE banner_id = '" . $banner_id . "'";

    $resultBannerDelete = mysqli_query($con, $delete_sql);

    if ($resultBannerDelete) {
        echo json_encode($resultBannerDelete);
    } else {
        if (DEBUG) {
            $err = "resultBannerDelete error: " . mysqli_error($con);
        } else {
            $err = "resultBannerDelete query failed";
        }
    }
}
?>