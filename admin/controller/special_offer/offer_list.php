<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

if ($verb == "GET") {

    $arr = array();
    $get_sql = "SELECT event_special_offer.*, "
            . "CASE WHEN event_special_offer.SO_to_event_id = 0 THEN 'ALL EVENT' ELSE eve_to.event_title END AS event_title_to, "
            . "CASE WHEN event_special_offer.SO_to_venue_id = 0 THEN 'ALL VENUE' ELSE venues_to.venue_title END AS venue_title_to, "
            . "CASE WHEN event_special_offer.SO_on_event_id = 0 THEN 'ALL EVENT' ELSE eve_on.event_title END AS event_title_on, "
            . "CASE WHEN event_special_offer.SO_on_venue_id = 0 THEN 'ALL VENUE' ELSE venues_on.venue_title END AS venue_title_on "
            . "FROM event_special_offer "
            . "LEFT JOIN `events` AS eve_on ON event_special_offer.SO_on_event_id = eve_on.event_id "
            . "LEFT JOIN `events` AS eve_to ON event_special_offer.SO_to_event_id = eve_to.event_id "
            . "LEFT JOIN event_venues AS venues_on ON event_special_offer.SO_on_venue_id = venues_on.venue_id "
            . "LEFT JOIN event_venues AS venues_to ON event_special_offer.SO_to_venue_id = venues_to.venue_id ";
    if ($adminEventPermission == "created") {
        $get_sql .= "WHERE `events`.event_created_by=$adminID ";
    } elseif ($adminEventPermission == "selected") {
        $get_sql .= "WHERE `events`.event_id IN ($adminEventID) ";
    }
    $get_sql .= "ORDER BY event_special_offer.SO_id DESC";

    $resultOffer = mysqli_query($con, $get_sql);
    if ($resultOffer) {
        while ($obj = mysqli_fetch_object($resultOffer)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultOffer error: " . mysqli_error($con);
        } else {
            $err = "resultOffer query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arrayImage = array();
    $SO_id = mysqli_real_escape_string($con, $SO_id);
    $sqlOfferImage = "SELECT SO_image FROM event_special_offer WHERE SO_id = $SO_id";
    $resultOfferImage = mysqli_query($con, $sqlOfferImage);
    if ($resultOfferImage) {
        $arrayImage = mysqli_fetch_array($resultOfferImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/SO_image/' . $arrayImage["SO_image"]);
    } else {
        if (DEBUG) {
            $err = "resultOfferImage error: " . mysqli_error($con);
        } else {
            $err = "resultOfferImage query failed";
        }
    }

    $delete_sql = "DELETE FROM event_special_offer WHERE SO_id = $SO_id";

    $resultOfferDelete = mysqli_query($con, $delete_sql);

    if ($resultOfferDelete) {
        echo json_encode($resultOfferDelete);
    } else {
        if (DEBUG) {
            $err = "resultOfferDelete error: " . mysqli_error($con);
        } else {
            $err = "resultOfferDelete query failed";
        }
    }
}
?>