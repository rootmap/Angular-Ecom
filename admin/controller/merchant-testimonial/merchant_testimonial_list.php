<?php
include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT 
                mt.id,
                mt.merchant_id,
                mt.title,
                mt.photo,
                mt.testimonial_des,
                clients.clients_name
                FROM merchant_testimonial as mt
                LEFT JOIN clients ON clients.clients_id = mt.merchant_id
                ORDER BY mt.id DESC";
    $resultMerchantTestimonial = mysqli_query($con, $get_sql);
    if ($resultMerchantTestimonial) {
        while ($obj = mysqli_fetch_object($resultMerchantTestimonial)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultMerchantTestimonial error: " . mysqli_error($con);
        } else {
            $err = "resultMerchantTestimonial query failed";
        }
    }

    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    //echo ($_POST);
   // exit();


    $id = mysqli_real_escape_string($con,$id);
   // echo '$id';
   // exit();

    $delete_sql = "DELETE FROM merchant_testimonial WHERE id = '" . $id. "'";

    $resultDelTestimonial = mysqli_query($con, $delete_sql);

    if ($resultDelTestimonial) {
        echo json_encode($resultDelTestimonial);
    } else {
        if (DEBUG) {
            $err = "resultDelImage error: " . mysqli_error($con);
        } else {
            $err = "resultDelImage query failed";
        }
    }
}
?>