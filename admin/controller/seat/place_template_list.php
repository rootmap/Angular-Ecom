<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $templateArray = array();
    $sqlPlaceTemplate = "SELECT seat_template.ST_id,seat_template.ST_user_limit,"
            . "seat_place_coordinate.SPC_title,seat_place.SP_title"
            . " FROM seat_template"
            . " LEFT JOIN seat_place_coordinate ON seat_template.ST_SPC_id = seat_place_coordinate.SPC_id"
            . " LEFT JOIN seat_place ON seat_template.ST_SP_id = seat_place.SP_id"
            . " ORDER BY seat_template.ST_id DESC";
    $resultPlaceTemplate = mysqli_query($con, $sqlPlaceTemplate);
    if ($resultPlaceTemplate) {
        while ($objTemplate = mysqli_fetch_object($resultPlaceTemplate)) {
            $templateArray[] = $objTemplate;
        }
    } else {
        if (DEBUG) {
            $err = "resultPlaceTemplate error: " . mysqli_error($con);
        } else {
            $err = "resultPlaceTemplate query failed";
        }
    }
    echo "{\"data\":" . json_encode($templateArray) . "}";
}

if ($verb == "POST") {
    extract($_POST);

    $ST_id = mysqli_real_escape_string($con, $ST_id);

    $sqlDelTemplate = "DELETE FROM seat_template WHERE ST_id = '" . $ST_id . "'";
    $resultDelTemplate = mysqli_query($con, $sqlDelTemplate);
    if ($resultDelTemplate) {
        echo json_encode($resultDelTemplate);
    } else {
        if (DEBUG) {
            $err = "resultDelTemplate error: " . mysqli_error($con);
        } else {
            $err = "resultDelTemplate query failed";
        }
    }
}
?>