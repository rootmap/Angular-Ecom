<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $event_id = $_GET["event_id"];
    $arr = array();
    $get_sql = "SELECT event_video_gallery.VG_id, event_video_gallery.VG_title, event_video_gallery.VG_video_link, event_video_gallery.VG_event_id, events.event_id, events.event_title AS VG_event_title FROM event_video_gallery LEFT JOIN events ON event_video_gallery.VG_event_id = events.event_id WHERE event_video_gallery.VG_event_id = $event_id order by event_video_gallery.VG_id DESC";
    $resultVideoGallery = mysqli_query($con, $get_sql);
    if ($resultVideoGallery) {
        while ($obj = mysqli_fetch_object($resultVideoGallery)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultVideoGallery error: " . mysqli_error($con);
        } else {
            $err = "resultVideoGallery query failed";
        }
    }


    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $VG_id = mysqli_real_escape_string($con, $VG_id);

    $delete_sql = "DELETE FROM event_video_gallery WHERE VG_id = '" . $VG_id . "'";

    $resultVideoDelete = mysqli_query($con, $delete_sql);

    if ($resultVideoDelete) {
        echo json_encode($resultVideoDelete);
    } else {
        if (DEBUG) {
            $err = "resultVideoDelete error: " . mysqli_error($con);
        } else {
            $err = "resultVideoDelete query failed";
        }
    }
}
?>