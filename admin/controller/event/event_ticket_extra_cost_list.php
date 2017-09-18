<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") 
{

        $arrayOrderList = array();
//        $sql = "SELECT a.*, "
//                . "CASE deduction_type WHEN 1 THEN 'Amount'"
//                . "ELSE CASE deduction_type  WHEN 2 THEN 'Percent'"
//                . "ELSE 'None' END END AS deduction_type"
//                . " FROM event_ticket_extra_cost as a"; 
$sql = "SELECT 
etecl.id,
e.event_title,
etecl.event_id,
etecl.cost_title,
etecl.cost_amount,
etecl.deduction_type,
etecl.date,
etecl.status, CASE deduction_type 
WHEN 1 THEN 'Amount' 
ELSE CASE deduction_type  WHEN 2 THEN 'Percent' 
ELSE 'None' 
END END AS deduction_type
    FROM 
event_ticket_extra_cost as etecl
LEFT JOIN events as e on e.event_id = etecl.event_id";
        $resultOrderList = mysqli_query($con, $sql);
        if ($resultOrderList) {
            while ($obj = mysqli_fetch_object($resultOrderList)) {
                $arrayOrderList[] = $obj;
            }
        } else {
            if (DEBUG) {
                $err = "Event movie extra cost error: " . mysqli_error($con);
            } else {
                $err = "Event movie extra cost query failed";
            }
        }
    
    echo "{\"data\":" . json_encode($arrayOrderList) . "}";
    
}


if ($verb == "POST") {

    extract($_POST);
    $id = mysqli_real_escape_string($con, $id);
    $delete_sql = "DELETE FROM event_ticket_extra_cost WHERE id = '".$id."'";
    $resultDelete = mysqli_query($con, $delete_sql);
    
    if ($resultDelete) {
        echo 1;
    } else {
        if (DEBUG) {
            $err = "resultDelete error: " . mysqli_error($con);
        } else {
            $err = "resultDelete query failed";
        }
    }
}
?>