<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {

    $arrayPromotion = array();
    $sqlPromotion = "SELECT * FROM promotions ORDER BY promotion_id DESC";
    $resultPromotion = mysqli_query($con, $sqlPromotion);
    if ($resultPromotion) {
        while ($objresultPromotion = mysqli_fetch_object($resultPromotion)) {
            $arrayPromotion[] = $objresultPromotion;
        }
    } else {
        if (DEBUG) {
            $err = "resultPromotion error: " . mysqli_error($con);
        } else {
            $err = "resultPromotion query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayPromotion) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    
    $deletePromotion = "DELETE FROM promotions WHERE promotion_id= '" . $promotion_id . "'";
    $resultPromotionDelete = mysqli_query($con, $deletePromotion);
    if ($resultPromotionDelete) {
        echo json_encode($resultPromotionDelete);
    } else {
        if (DEBUG) {
            $err = "resultPromotionDelete error: " . mysqli_error($con);
        } else {
            $err = "resultPromotionDelete query failed";
        }
    }
}
?>