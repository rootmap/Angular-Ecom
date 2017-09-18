<?php 
include'../DBconnection/database_connections.php';

@$data = json_decode(file_get_contents("php://input"));
$checkID =2;
$return_array = array();
$cost =array();
$countRow = 0;
$eventID = 0;
$array = array();
$delCost = '';
$delCity = '';
$sessionID = session_id();
$deb=0;
//added by shanto starts
$os = array("94", "95", "96", "97", "98");
//added by shanto ends
$cdeb = "SELECT ETC_event_id as event_id FROM event_temp_cart WHERE ETC_session_id='$sessionID' LIMIT 1";
$qcdev=  mysqli_query($con,$cdeb);
if(!empty($qcdev))
{
    while($mm=  mysqli_fetch_array($qcdev))
    {
        $deb=$mm['event_id'];
    }
}
if ($checkID != "") {
    
    $getDeliveryCostSql = "SELECT cities.city_delivery_charge FROM cities WHERE cities.city_id= $checkID";
    $getDeliveryCostResult = mysqli_query($con, $getDeliveryCostSql);

    if ($getDeliveryCostResult) {
       // $row = mysqli_fetch_object($getDeliveryCostResult);
       
        while ($resultObj=mysqli_fetch_object($getDeliveryCostResult)) {
            $cost[]=$resultObj;
        }
         echo json_encode($cost);
        //var_dump($cost);
    } else {
        if (true) {
            $err = "getDeliveryCostResult error: " . mysqli_error($con);
        } else {
            $err = "getDeliveryCostResult query failed";
        }
    }
}

?>