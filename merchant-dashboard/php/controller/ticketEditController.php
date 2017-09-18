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

$tid=$data->id;
$object = array();
//TT_id, TT_type_title,TT_ticket_quantity,TT_type_id,TT_startDate,TT_endDate
 $sql = "Select ett.*,
e.event_title

FROM event_ticket_types as ett
LEFT JOIN events as e ON e.event_id=ett.TT_event_id
WHERE TT_id='$tid' ORDER BY TT_id DESC";


$result = mysqli_query($con, $sql);
   while ($row = mysqli_fetch_array($result)) {
       $object[]=$row;
    
}
echo json_encode($object); 


//D-BAG
//$chk = mysqli_num_rows($query);
//
//if ($chk != "0") {
//    $data=array();
//    while ($rw=  mysqli_fetch_array($query))
//    {
//        $data[]=$rw;
//    }
//    
//    
//    $ss=json_encode($data);
//
//    echo $ss;
//    
//} else {
//    echo 0;
//}



