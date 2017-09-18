<?php


//database connection
require_once '../../DBconnection/database_connections.php';
//database connection
//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode


@$eitcId = $data->EITC_item_id;

$sql = " DELETE FROM event_item_temp_cart WHERE EITC_item_id =$eitcId  ";

$result = mysqli_query($con, $sql);

if($result == true){
    $checkItemCartSql = "SELECT * FROM event_item_temp_cart WHERE EITC_item_id=delEventItemCartID ";
    $resultCheckItemCart = mysqli_query($con, $checkItemCartSql);
    if ($resultCheckItemCart) {
         $countCartItem = mysqli_num_rows($resultCheckItemCart);
        if ($countCartItem == 0) {
            $deleteEventItemSql = "DELETE FROM event_temp_cart WHERE ETC_id=$delCartID";
            $resultDeleteEventItem = mysqli_query($con, $deleteEventItemSql);
 
        }
    } 
}

?>

