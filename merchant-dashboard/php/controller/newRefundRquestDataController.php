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


/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */

$marchentid = $data->marchentid;
$AvailableAmount = $data->AvailableAmount;
$RequestAmount = $data->RequestAmount;
$RemarksNote = $data->RemarksNote;
$RefundMethodnew = $data->RefundMethodnew;
$sqlextra='';
if ($RefundMethodnew != 3) {
    if ($RefundMethodnew == 2) {
        $bankname = $data->BankName;
        $AcNumberfunds = $data->AcNumber;
        $sqlextra=",bank_name='$bankname',ac_number='$AcNumberfunds'";
    } elseif($RefundMethodnew == 1) {
        $mobilenumbers = $data->mobilenumber;
        $sqlextra=",mobile_number='$mobilenumbers'";
    }
    
}
//$adminName = $firstName." ".$lastName;/** same field one data save so concat**/

$sql = "INSERT INTO refund_request SET  merchant_id='$marchentid',available_amount='$AvailableAmount',
      request_amount='$RequestAmount',remarks='$RemarksNote',refund_method='$RefundMethodnew'".$sqlextra;


$result = mysqli_query($con, $sql);
if ($result == 1) {
    echo 1;
} else {
    echo 2;
}