
<?php
include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT 	id, event_id, payment_method_id, date FROM eventwise_payment_method";



    
    $resultImageGallery = mysqli_query($con, $get_sql);
    if ($resultImageGallery) {
        while ($obj = mysqli_fetch_object($resultImageGallery)) {
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


    $IG_id = mysqli_real_escape_string($con,$IG_id);

    $delete_sql = "DELETE FROM eventwise_payment_method WHERE id = '" . $IG_id. "'";

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
