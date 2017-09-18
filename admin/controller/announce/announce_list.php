<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrAnnounce = array();
    $sqlGetAnnounce = "SELECT * "
            . "FROM announcements "
            . "ORDER BY announcement_id DESC";
    $resultGetAnnounce = mysqli_query($con, $sqlGetAnnounce);
    if ($resultGetAnnounce) {
        while ($resultGetAnnounceObj = mysqli_fetch_object($resultGetAnnounce)) {
            $arrAnnounce[] = $resultGetAnnounceObj;
        }
    } else {
        if (DEBUG) {
            echo "resultGetAnnounce error: " . mysqli_error($con);
        } else {
            echo "resultGetAnnounce query failed.";
        }
    }

    echo "{\"data\":" . json_encode($arrAnnounce) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $announce_id = mysqli_real_escape_string($con, $announce_id);

    $delete_sql = "DELETE FROM announcements WHERE announcement_id = '" . $announce_id . "'";

    $resultDeleteAnnounce = mysqli_query($con, $delete_sql);

    if ($resultDeleteAnnounce) {
        echo json_encode($resultDeleteAnnounce);
    } else {
        if (DEBUG) {
            echo "resultDeleteAnnounce error: " . mysqli_error($con);
        } else {
            echo "resultDeleteAnnounce query failed.";
        }
    }
}
?>