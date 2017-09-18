<?php 
include'../DBconnection/database_connections.php';
include "../config/config.php";
include "../admin/event/blockbuster_api_class/GenerateSecretKey.php";
$obj = new configtoapi();
$api = new XmlToJson();
$data=  json_decode(file_get_contents("php://input"));
$movie_id=$data->Mid;
$chkdate=$data->date;
$theatrequery = $api->getShowTime($movie_id, $chkdate);
$MovieSchedule='';
foreach($theatrequery as $key => $value) {
     $MovieSchedule=$value;
}
 echo json_encode($MovieSchedule);
?>