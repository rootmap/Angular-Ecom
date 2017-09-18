

<?php
include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT
ome.id,
ome.customer_id,
ome.order_id,
ome.verified_order_id,
ome.movie_id,
ome.movie_name,
ome.seat_number,
ome.seat,
ome.seat_unit_price,
ome.seat_type,
ome.request_date,
ome.fullname,
ome.email,
ome.mobile,
ome.sex,
ome.datetime, 
concat(u.user_first_name,' ',u.user_last_name) as customer_name,
eml.event_id,
e.event_title
FROM 
order_movie_event as ome
LEFT JOIN users as u on u.user_id=ome.customer_id
LEFT JOIN event_movie_list as eml on eml.movie_id=ome.movie_id
LEFT JOIN events as e on e.event_id=eml.event_id";



    
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

    $delete_sql = "DELETE FROM order_movie_event WHERE id = '" . $IG_id. "'";

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