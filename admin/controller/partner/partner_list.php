<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayPartner = array();
    $get_sql = "SELECT partner_id,partner_name,partner_image,partner_link FROM partner ORDER BY partner_id DESC";
    $resultPartnerQuery = mysqli_query($con, $get_sql);
    if ($resultPartnerQuery) {
        while ($objPartner = mysqli_fetch_object($resultPartnerQuery)) {
            $arrayPartner[] = $objPartner;
        }
    } else {
        if (DEBUG) {
            $err = "resultPartnerQuery error: " . mysqli_error($con);
        } else {
            $err = "resultPartnerQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayPartner) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arrayImage = array();
    $partner_id = mysqli_real_escape_string($con, $partner_id);
    $sqlPartnerImage = "select partner_image from partner where partner_id = $partner_id";
    $resultPartnerImage = mysqli_query($con, $sqlPartnerImage);
    if ($resultPartnerImage) {
        $arrayImage = mysqli_fetch_array($resultPartnerImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/partner_image/' . $arrayImage["partner_image"]);
    } else {
        if (DEBUG) {
            $err = "resultPartnerImage error: " . mysqli_error($con);
        } else {
            $err = "resultPartnerImage query failed";
        }
    }

    $delete_sql = "DELETE FROM partner WHERE partner_id= '" . $partner_id . "'";

    $resultPartnerDelete = mysqli_query($con, $delete_sql);

    if ($resultPartnerDelete) {
        echo json_encode($resultPartnerDelete);
    } else {
        if (DEBUG) {
            $err = "resultPartnerDelete error: " . mysqli_error($con);
        } else {
            $err = "resultPartnerDelete query failed";
        }
    }
}
?>