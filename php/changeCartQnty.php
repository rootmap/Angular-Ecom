<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

@$EITC_id =$data->EITC_id;
@$newQnty =$data->qnty;
$delCartSession = session_id();
$newTotalPrice = 0;
$newDiscountPrice = 0;

if ($EITC_id > 0 AND $newQnty > 0) {
    $sqlGetTmpCartItem = "SELECT EITC_id,EITC_unit_price,EITC_unit_discount,EITC_quantity FROM event_item_temp_cart WHERE EITC_id=$EITC_id";
    $resultGetTmpCartItem = mysqli_query($con, $sqlGetTmpCartItem);
    if ($resultGetTmpCartItem) {
        $resultGetTmpCartItemObj = mysqli_fetch_object($resultGetTmpCartItem);
        if (isset($resultGetTmpCartItemObj->EITC_id)) {
            $unitPrice = $resultGetTmpCartItemObj->EITC_unit_price;
            $unitDiscount = $resultGetTmpCartItemObj->EITC_unit_discount;

            if ($unitPrice > 0) {
                $newTotalPrice = $unitPrice * $newQnty;
                $newDiscountPrice = $unitDiscount * $newQnty;

                $updateTmpCartItem = '';
                $updateTmpCartItem .=' EITC_quantity = "' .$newQnty . '"';
                $updateTmpCartItem .=', EITC_total_price = "' . $newTotalPrice . '"';
                $updateTmpCartItem .=', EITC_total_discount = "' .$newDiscountPrice . '"';

                $sqlUpdateTmpCartItem = "UPDATE event_item_temp_cart SET $updateTmpCartItem WHERE EITC_id=$EITC_id";
                $resultUpdateTmpCartItem = mysqli_query($con, $sqlUpdateTmpCartItem);

                
        }
    } else {
         
            $return_array = array("output" => "error", "msg" => "resultGetTmpCartItem query failed.");
            echo json_encode($return_array);
            exit();
        
    }
}
}
//echo json_encode(array_merge($arrTmpCartBigItem, $arrCartSelectedTicket ));
//echo json_encode($arrTmpCartBigItem);
    ?>