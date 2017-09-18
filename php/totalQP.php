<?php

include'../DBconnection/database_connections.php';
session_start();

$data = json_decode(file_get_contents("php://input"));

$sessionId = session_id();

$ticketdata = $data->ticket;
//print_r($ticketdata);
$includedata = $data->include;
//print_r($includedata);

$freetdata = $data->free;
//print_r($freetdata);

$Quantity_inc=0;
foreach ($includedata as $index => $ticket) {

     $Quantity_inc += $includedata[$index]->quantity;
}



$ordercreated = date('Y-m-d H:i:s');

//$ticketQuantity_free = 0;
//$ticketTotalAmount_free = 0;

$ticketQuantity_tic = 0;
$ticketTotalAmount_tic = 0;
$ticketQuantity_inc = 0;
$ticketTotalAmount_inc = 0;
$totalquantity = 0;
$totalAmount = 0;
$o_user_id = '';

if (!empty($ticketdata) || !empty($freetdata)) {
//echo 'if';
    foreach ($ticketdata as $index => $ticket) {

        $ticketQuantity_tic +=$ticket->quantity;
        //echo $ticket->quantity;
        $ticketTotalAmount_tic +=$ticketdata[$index]->price * $ticketdata[$index]->quantity; // or try this $ticketTotalAmount_tic += $ticket->price * $ticketQuantity_tic;
    }
    foreach ($includedata as $index => $ticket) {
        // $ticketQuantity_inc += $includedata[$index]->quantity;
        $ticketQuantity_inc += $includedata->quantity;
        //$ticketTotalAmount_inc += $includedata[$index]->price;
        $ticketTotalAmount_inc += $includedata[$index]->price * $includedata[$index]->quantity;
    }

    foreach ($freetdata as $index => $ticket) {
        $ticketQuantity_free += $freetdata[$index]->quantity;
     
        $ticketTotalAmount_free += $freetdata[$index]->price * $freetdata[$index]->quantity;
    }

    //$totalquantity = $ticketQuantity_tic+ $ticketQuantity_inc;
    $totalquantity = $ticketQuantity_tic + $ticketQuantity_free;
    $totalAmount = $ticketTotalAmount_tic + $ticketTotalAmount_inc + $ticketTotalAmount_free;
//		  $array_return = array("total_amount" =>$totalAmount, "total_qnty" =>$totalquantity);
    $array_return = array("total_amount" => $totalAmount, "total_qnty" => $totalquantity, 'tck_q' => $ticketQuantity_tic, 'tck_inc_q' => $Quantity_inc);
    echo json_encode($array_return);
}
?>