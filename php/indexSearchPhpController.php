<?php


include'../DBconnection/database_connections.php';
@$data = json_decode(file_get_contents("php://input"));

$dataArray = array();

$sql = "SELECT event_id,event_title FROM events";

$result = mysqli_query($con, $sql);


while($row = mysqli_fetch_object($result)){
    $dataArray[] = $row;
}

echo json_encode($dataArray);


?>

