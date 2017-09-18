<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT * FROM tags ORDER BY tag_id DESC";
    $resultTag = mysqli_query($con, $get_sql);
    if ($resultTag) {
        while ($obj = mysqli_fetch_object($resultTag)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultTag error: " . mysqli_error($con);
        } else {
            $err = "resultTag query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);


    $tag_id = mysqli_real_escape_string($con, $tag_id);

    $delete_sql = "DELETE FROM tags WHERE tag_id = '" . $tag_id . "'";

    $resultDelTag = mysqli_query($con, $delete_sql);

    if ($resultDelTag) {
        echo json_encode($resultDelTag);
    } else {
        if (DEBUG) {
            $err = "resultDelTag error: " . mysqli_error($con);
        } else {
            $err = "resultDelTag query failed";
        }
    }
}
?>