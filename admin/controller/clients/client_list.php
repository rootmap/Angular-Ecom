<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayClient = array();
    $get_sql = "SELECT clients_id,clients_name,clients_image,clients_link FROM clients ORDER BY clients_id DESC";
    $resultClientQuery = mysqli_query($con, $get_sql);
    if ($resultClientQuery) {
        while ($objClient = mysqli_fetch_object($resultClientQuery)) {
            $arrayClient[] = $objClient;
        }
    } else {
        if (DEBUG) {
            $err = "resultClientQuery error: " . mysqli_error($con);
        } else {
            $err = "resultClientQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayClient) . "}";
}


if ($verb == "POST") {

    extract($_POST);

    $arrayImage = array();
    $clients_id = mysqli_real_escape_string($con, $clients_id);
    $sqlClientImage = "select clients_image from clients where clients_id = $clients_id";
    $resultClientImage = mysqli_query($con, $sqlClientImage);
    if ($resultClientImage) {
        $arrayImage = mysqli_fetch_array($resultClientImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/clients_image/' . $arrayImage["clients_image"]);
    } else {
        if (DEBUG) {
            $err = "resultClientImage error: " . mysqli_error($con);
        } else {
            $err = "resultClientImage query failed";
        }
    }

    $delete_sql = "DELETE FROM clients WHERE clients_id = '" . $clients_id . "'";

    $resultClientDelete = mysqli_query($con, $delete_sql);

    if ($resultClientDelete) {
        echo json_encode($resultClientDelete);
    } else {
        if (DEBUG) {
            $err = "resultClientDelete error: " . mysqli_error($con);
        } else {
            $err = "resultClientDelete query failed";
        }
    }
}
?>