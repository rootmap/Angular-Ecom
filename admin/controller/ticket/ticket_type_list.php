<?php
include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT * FROM ticket_type";
    $resultTicket = mysqli_query($con, $get_sql);
    if ($resultTicket) {
        while ($obj = mysqli_fetch_object($resultTicket)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultImageGallery error: " . mysqli_error($con);
        } else {
            $err = "resultImageGallery query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
    
}


if ($verb == "POST") {

    extract($_POST);


    $id = mysqli_real_escape_string($con,$id);

    $delete_sql = "DELETE FROM ticket_type WHERE id = '" . $id. "'";

    $resultDelImage = mysqli_query($con, $delete_sql);

    if ($resultDelImage) {
        echo json_encode($resultDelImage);
    } else {
        if (DEBUG) {
            $err = "resultDelImage error: " . mysqli_error($con);
        } else {
            $err = "resultDelImage query failed";
        }
    }
}
?>