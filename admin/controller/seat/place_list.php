<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayPlace = array();
    $sqlPlaceList = "SELECT seat_place.*,admins.admin_full_name FROM seat_place"
            . " LEFT JOIN admins ON seat_place.SP_created_by = admins.admin_id"
            . " ORDER BY seat_place.SP_id DESC";
    $resultPlaceList = mysqli_query($con, $sqlPlaceList);
    if ($resultPlaceList) {
        while ($objPlaceList = mysqli_fetch_object($resultPlaceList)) {
            $arrayPlace[] = $objPlaceList;
        }
    } else {
        if (DEBUG) {
            $err = "resultPlaceList error: " . mysqli_error($con);
        } else {
            $err = "resultPlaceList query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayPlace) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    
    $arrayImage = array();
    $SP_id = mysqli_real_escape_string($con, $SP_id);
    $sqlPlaceImage = "SELECT SP_image,SP_image_color from seat_place WHERE SP_id = $SP_id";
    $resultPlaceImage = mysqli_query($con, $sqlPlaceImage);
    if ($resultPlaceImage) {
        $arrayImage = mysqli_fetch_array($resultPlaceImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/place_layout/' . $arrayImage["SP_image"]);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/place_color_image/' . $arrayImage["SP_image_color"]);
    } else {
        if (DEBUG) {
            $err = "resultPlaceImage error: " . mysqli_error($con);
        } else {
            $err = "resultPlaceImage query failed";
        }
    }

    $delete_sql = "DELETE FROM seat_place WHERE SP_id= '" . $SP_id . "'";

    $resultPlaceDelete = mysqli_query($con, $delete_sql);

    if ($resultPlaceDelete) {
        $sqlDelCoordinate = "DELETE FROM seat_place_coordinate WHERE SPC_SP_id='" . $SP_id . "'";
        $resultDelCoordinate = mysqli_query($con, $sqlDelCoordinate);
        if ($resultDelCoordinate) {
            echo json_encode($resultDelCoordinate);
        } else {
            if (DEBUG) {
                $err = "resultDelCoordinate error: " . mysqli_error($con);
            } else {
                $err = "resultDelCoordinate query failed";
            }
        }
    } else {
        if (DEBUG) {
            $err = "resultPlaceDelete error: " . mysqli_error($con);
        } else {
            $err = "resultPlaceDelete query failed";
        }
    }
}
?>