<?php

include '../../config/config.php';
$placeID = 0;
$arrGetPlaceTemplate = array();
extract($_POST);

if ($placeID > 0) {
    $sqlGetPlaceTemplate = "SELECT SPC_id,SPC_title FROM seat_place_coordinate WHERE SPC_SP_id=$placeID";
    $resultGetPlaceTemplate = mysqli_query($con, $sqlGetPlaceTemplate);

    if ($resultGetPlaceTemplate) {
        while ($resultGetPlaceTemplateObj = mysqli_fetch_object($resultGetPlaceTemplate)) {
            $arrGetPlaceTemplate[] = $resultGetPlaceTemplateObj;
        }

        $return_array = array("output" => "success", "arrGetPlaceTemplate" => $arrGetPlaceTemplate);
        echo json_encode($return_array);
        exit();
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetPlaceTemplate error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetPlaceTemplate query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}


