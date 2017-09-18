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
//START HERE 
//session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$data = json_decode(file_get_contents("php://input"));
$eid = $data->eid;

//echo $emailOrderID;
//exit();
$result = mysqli_query($con, "SELECT * FROM `event_ticket_types` WHERE `TT_event_id`='$eid'");

while ($row = mysqli_fetch_array($result)):
    $dbdata[] = $row;
endwhile;

$pmchar = mysqli_query($con, "SELECT `pms_id` FROM `payment_gateway_charges_list` WHERE `event_id`='$eid'");
while ($row = mysqli_fetch_array($pmchar)):
    $pmcdata[] = $row;
endwhile;

$btnevnt = mysqli_query($con, "SELECT button_id FROM `event_button_list` WHERE `event_id`='$eid'");
while ($row = mysqli_fetch_array($btnevnt)):
    $btdata[] = $row;
endwhile;

$sqlpayment = mysqli_query($con, "SELECT 
pm.*,
(SELECT count(*) FROM `eventwise_payment_method` as epm WHERE epm.`event_id`='$eid' AND epm.`status`='1' AND epm.`payment_method_id`=pm.id) as chk
FROM `payment_method` as pm 
WHERE pm.`status`!='2'");
while ($row = mysqli_fetch_array($sqlpayment)):
    $pmdata[] = $row;
endwhile;


$sqloflinepayment = mysqli_query($con, "SELECT 
pm.*,
(SELECT count(*) FROM `eventwise_payment_method` as epm WHERE epm.`event_id`='$eid' AND epm.`status`='1' AND epm.`payment_method_id`=pm.id) as chk
FROM `payment_method` as pm 
WHERE pm.`status`='2'");
while ($row = mysqli_fetch_array($sqloflinepayment)):
    $pmofflinedata[] = $row;
endwhile;


$evnttags = mysqli_query($con, "SELECT event_tag FROM `events` WHERE `event_id`='$eid'");
while ($row = mysqli_fetch_array($evnttags)):
    $tagdata = $row[event_tag];
endwhile;
$tagsA = explode(",", $tagdata);

$pickpoint = mysqli_query($con, "SELECT * FROM `event_pick_point` WHERE `event_id`='$eid' AND status='1'");
while ($row = mysqli_fetch_array($pickpoint)):
    $picpointdata[] = $row;
endwhile;




mysqli_close($con);

$array = array("tt" => $dbdata, "pmc" => $pmcdata, "btninfo" => $btdata, "pminfo" => $pmdata, "pmoffline" => $pmofflinedata, "evttags" => $tagsA,"ppdata"=>$picpointdata);

echo json_encode($array);
?>
