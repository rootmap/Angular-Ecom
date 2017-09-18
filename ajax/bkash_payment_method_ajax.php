<?php
//include'../DBconnection/database_connections.php';
include "../admin/event/blockbuster_api_class/GenerateSecretKey.php";
$obj = new configtoapi();
include "../config/config.php";
extract($_POST);
$status = "";
$dd = "";
if ($st == 1) {

//    function respons($trxid = '') {
//        $user = 'TICKETCHAILTD';
//        $pass = 't1cK3t@247';
//        $merchat = '01733557757';
//        //$url = "http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg";
//        $url = "http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg";
//        $generateaurl = $url . "?user=" . $user . "&pass=" . $pass . "&msisdn=" . $merchat;
//        ;
//        if (!empty($trxid)) {
//            $gensndurl = $generateaurl . "&trxid=" . $trxid;
//        } else {
//            $gensndurl = $generateaurl . "&trxid=000000";
//        }
//
//        $parseurl = file_get_contents($gensndurl);
//        return $parseurl;
//    }
    $trxid=$verifydata;
    $user = 'TICKETCHAILTD';
    $pass = 't1cK3t@247';
    $merchat = '01733557757';
    //$url = "http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg";
    $url = "http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg";
     $generateaurl = $url . "?user=" . $user . "&pass=" . $pass . "&msisdn=" . $merchat;
    
    if (!empty($trxid)) {
        $gensndurl = $generateaurl . "&trxid=" . $trxid;
    } else {
        $gensndurl = $generateaurl . "&trxid=000000";
    }

     $parseurl = file_get_contents($gensndurl);
    echo $parseurl;

    //echo respons($verifydata);
} elseif ($st == 2) {

    //print_r($_POST);
    //echo base64_decode($_POST['oid']);
    //exit();
    $did=  base64_decode($_POST['oid']);
    $rowarray = array();
    $verifydata=str_replace(" ","",trim($_POST['verifydata']));
   //$conn = mysqli_connect("localhost", "ticketch_test_se", "@minul@2017", "ticketch_test_server");
 
     $sql = "Select * FROM bkash_transaction_module WHERE order_id='" . $did . "' AND transaction_id='".$verifydata."'";
    $chk = $obj->FlyQuery($sql,2);
   
//  $row = mysqli_fetch_object($sqlquery);
//  print_r($row);
    //echo $chk;
    //e/xit();
    if ($chk != 0) {
        $rowarray=$obj->FlyQuery($sql,1);
        /*while ($row = mysqli_fetch_array($sqlquery)):
            $rowarray[] = $row;
        endwhile;*/

        //print_r($rowarray);
        ///exit();

        //print_r($rowarray);
        $statusd = $rowarray[0]->status;
        $order_id = $rowarray[0]->order_id;

        if (($statusd == "pending" || $statusd == "")) {
            $sqlup = "UPDATE bkash_transaction_module SET status='aprove',paid_amount='" . $amount . "' WHERE transaction_id='" . $verifydata . "' AND order_id='" . $did . "'";
            $upquery = $obj->FlyPrepare($sqlup);
            if ($upquery == 1) {
                $status = 1;
            } else {
                $status = mysqli_errno($con);
            }
        } else {
            $status = $statusd;
        }

        $sqlsumtotal = "SELECT sum(paid_amount) as order_total FROM bkash_transaction_module WHERE order_id='" . $did. "' GROUP BY order_id";
        $sumarray = $obj->FlyQuery($sqlsumtotal,1);
        //$sumarray = mysqli_fetch_array($sumquery);
       // print_r($sumarray);
       //echo $dd = $sumarray['order_total'];
    } else {
        $status = 0;
    }

    $array = array("status" => $status, "order_id" => $did, "amount" => $dd);
    echo json_encode($array);
}
?>








