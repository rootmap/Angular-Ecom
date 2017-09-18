<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
session_start();
@$delCartID =$data->ETC_id;
@$delEventItemCartID =$data->EITC_item_id;
$delCartSession = session_id();

$deleteItemCartSql = "DELETE FROM event_item_temp_cart WHERE EITC_item_id='$delEventItemCartID' ";
$resultdeleteItemCart = mysqli_query($con, $deleteItemCartSql);
if ($resultdeleteItemCart) {

    $checkItemCartSql = "SELECT * FROM event_item_temp_cart WHERE EITC_item_id='$delEventItemCartID' ";
    $resultCheckItemCart = mysqli_query($con, $checkItemCartSql);
    if ($resultCheckItemCart) {
         $countCartItem = mysqli_num_rows($resultCheckItemCart);
        if ($countCartItem == 0) {
            $deleteEventItemSql = "DELETE FROM event_temp_cart WHERE ETC_id=$delCartID";
            $resultDeleteEventItem = mysqli_query($con, $deleteEventItemSql);
 
        }
    } 
}
//echo json_encode(array_merge($arrTmpCartBigItem, $arrCartSelectedTicket ));
//echo json_encode($arrTmpCartBigItem);
	?>