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
//json data encoding passing start here
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here

$st = $data->st;

if ($st == 1) {

    $query = "Select 
                                        e.`event_id`,
                                        e.`event_title`,

                                        count(o.order_id) as `ordersAmount`

                                        FROM `events` as e
                                        INNER JOIN `order_events` as oe ON oe.OE_event_id=e.event_id
                                        INNER JOIN `orders` as o ON o.order_id=oe.OE_order_id

                                        WHERE e.`event_created_by`='$login_user_id'

                                        GROUP BY e.event_id";
    $xsql = mysqli_query($con, $query);
    $chk = mysqli_num_rows($xsql);

//print_r($xsql);
//echo "QUERY=".$chk;
    $strjson = '';
    $array=[];
    if ($chk != 0) {
        
        while ($row = mysqli_fetch_object($xsql)) {
            //$strjson .="{name:'" . $row['event_title'] . "', y:" . $row['ordersAmount'] . "},";
            $array[]=$row;
        }
    }
    
    //$data=rtrim($strjson,",");
    echo json_encode($array);
    
}
       