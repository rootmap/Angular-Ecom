<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayContact = array();
    $get_sql = "SELECT * FROM bkash_transaction_module";
    $resultContactQuery = mysqli_query($con, $get_sql);
    if ($resultContactQuery) {
        while ($objContact = mysqli_fetch_object($resultContactQuery)) {
            $arrayContact[] = $objContact;
        }
    } else {
        if (DEBUG) {
            $err = "resultContactQuery error: " . mysqli_error($con);
        } else {
            $err = "resultContactQuery query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayContact) . "}";
}





if ($verb == "POST") {

    extract($_POST);

    $arrayImage = array();
    $id = mysqli_real_escape_string($con, $id);
    $sqlClientImage = "select contact_us from contact_us where id = $id";
    $resultClientImage = mysqli_query($con, $sqlClientImage);
    if ($resultClientImage) {
        $arrayImage = mysqli_fetch_array($resultClientImage);
        unlink($config['IMAGE_UPLOAD_PATH'] . '/clients_image/' . $arrayImage["clients_image"]);
    } else {
        if (DEBUG) {
            $err = "resultContactQuery error: " . mysqli_error($con);
        } else {
            $err = "resultContactQuery query failed";
        }
    }

    $delete_sql = "DELETE FROM bkash_transaction_module WHERE id = '" . $id . "'";

    $resultContact_usDelete = mysqli_query($con, $delete_sql);

    if ($resultContact_usDelete) {
        echo json_encode($resultContact_usDelete);
    } else {
        if (DEBUG) {
            $err = "resultContactUsDelete error: " . mysqli_error($con);
        } else {
            $err = "resultContactUsDelete query failed";
        }
    }
}
?>