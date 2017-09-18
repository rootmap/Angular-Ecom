<?php 
//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode

$cityArray = array();

$citySql = "SELECT * FROM cities WHERE city_status = 'allow' ";


$result = mysqli_query($con, $citySql);


   
    
    while($row = mysqli_fetch_object($result)){
        $cityArray[] = $row;
    }
    


echo json_encode($cityArray);

?>
