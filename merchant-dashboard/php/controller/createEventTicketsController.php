<?php
include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here
$TicketName ="";
$MinQty ="";
$MaxQty ="";
$TicketType ="";
$T_Currency ="";
$Price ="";
$T_ability ="";
$T_tictfee ="";
$T_begiDate ="";
$T_finishDate ="";
$T_topTime ="";
$T_murderTime ="";
$TicketDescription ="";
$MessageToAttendee ="";


$data = json_decode(file_get_contents("php://input"));
$event_id = $data->event_id;
 $ticket_id=$data->ticket_id;
 $eventId=$data->eventid;
@$TicketName = $data->TicketName;
$Qty = $data->Qty;
@$MinQty = $data->MinQty;
@$MaxQty = $data->MaxQty;
@$TicketType = $data->TicketType;
@$T_Currency = $data->Currency;
@$Price = $data->Price;
@$T_ability = $data->Availability;
@$T_tictfee = $data->WhowillpayTicketchaifee;
@$T_begiDate = $data->StartDate;
@$T_finishDate = $data->EndDate;
@$T_topTime = $data->StartTime;
@$T_murderTime = $data->EndTime;
@$TicketDescription = $data->TicketDescription;
@$MessageToAttendee = $data->MessageToAttendee;

 @$editRequest=$data->checkIfedit;
// $editRequest=$_GET['tid'];
$today=  date('Y-m-d');
if(!empty($editRequest)){

//print_r($_POST); //(all data show of console)
//echo $TicketName$;(single data show of console)
   $sql = "UPDATE  event_ticket_types SET TT_event_id='$eventId',TT_type_title='$TicketName',TT_ticket_quantity='$Qty',TTmin_quantity='$MinQty',TT_per_user_limit='$MaxQty',
         TT_type_id='$TicketType',TT_currency='$T_Currency',TT_price='$Price',TT_availability='$T_ability',TT_WhowillpayTicketchaifee='$T_tictfee',TT_startDate='$T_begiDate',TT_endDate='$T_finishDate',TT_startTime='$T_topTime',TT_endTime='$T_murderTime',
         TT_type_description='$TicketDescription',TT_MessageToAttendee='$MessageToAttendee',TT_created_by='$login_user_id',TT_created_on='$today' WHERE TT_id='$ticket_id'";
}  else {
    $sql = "INSERT INTO event_ticket_types (TT_event_id,TT_type_title,TT_ticket_quantity,TTmin_quantity,TT_per_user_limit,TT_type_id,TT_currency,TT_price,TT_availability,TT_WhowillpayTicketchaifee,TT_startDate,TT_endDate,TT_startTime,TT_endTime,TT_type_description,TT_MessageToAttendee,TT_created_by,TT_created_on) VALUES 
        ('$event_id','$TicketName','$Qty','$MinQty','$MaxQty',
         '$TicketType','$T_Currency','$Price','$T_ability','$T_tictfee','$T_begiDate','$T_finishDate','$T_topTime','$T_murderTime',
         '$TicketDescription','$MessageToAttendee','$login_user_id','$today')";
}

$result = mysqli_query($con, $sql);
