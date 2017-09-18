<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayMerEvnt = array();
    $get_sql = "SELECT 
                mwed.id,
                mwed.merchant_id,
                mwed.event_id,
                ci.clients_name AS merchant_name,
                ei.event_title
                FROM  merchant_wise_event_data AS mwed
                LEFT JOIN clients AS ci ON ci.clients_id = mwed.merchant_id
                LEFT JOIN events AS ei ON ei.event_id = mwed.event_id
                ORDER BY mwed.id DESC";
    $resultMerEvntQuery = mysqli_query($con, $get_sql);
    if ($resultMerEvntQuery) {
        while ($objMerEvnt = mysqli_fetch_object($resultMerEvntQuery)) {
            $arrayMerEvnt[] = $objMerEvnt;
            //echo var_dump($arrayMerEvnt);
           // exit();
        }
    } else {
        if (DEBUG) {
            $err = "resultMerEvntQuery error: " . mysqli_error($con);
        } else {
            $err = "resultMerEvntQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayMerEvnt) . "}";
}


if ($verb == "POST") {

    extract($_POST);

//    $arrayImage = array();
//    $clients_id = mysqli_real_escape_string($con, $clients_id);
//    $sqlClientImage = "select clients_image from clients where clients_id = $clients_id";
//    $resultClientImage = mysqli_query($con, $sqlClientImage);
//    if ($resultClientImage) {
//        $arrayImage = mysqli_fetch_array($resultClientImage);
//        unlink($config['IMAGE_UPLOAD_PATH'] . '/clients_image/' . $arrayImage["clients_image"]);
//    } else {
//        if (DEBUG) {
//            $err = "resultClientImage error: " . mysqli_error($con);
//        } else {
//            $err = "resultClientImage query failed";
//        }
//    }

    $delete_sql = "DELETE FROM merchant_wise_event_data WHERE id = '" . $id . "'";

    $resultMerEvntDelete = mysqli_query($con, $delete_sql);

    if ($resultMerEvntDelete) {
        echo json_encode($resultMerEvntDelete);
    } else {
        if (DEBUG) {
            $err = "resultMerEvntDelete error: " . mysqli_error($con);
        } else {
            $err = "resultMerEvntDelete query failed";
        }
    }
}
?>