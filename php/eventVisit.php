<?php 
header("Access-Control-Allow-Origin: *");

session_start();

include'../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
@$data = json_decode(file_get_contents("php://input"));

$return_array = array();
@$event_id =$data->id;
@$page_name =$data->page;


// $UA_user_id = $_SESSION['USER_DASHBOARD_USER_ID'];

if (!empty($event_id) AND !empty($page_name)) {



    $sqlPageVisit = "INSERT INTO `event_visit_page`( event_id, page_name) VALUES ('$event_id ','$page_name')";
    $resultUserAddress = mysqli_query($con, $sqlPageVisit);
    if ($resultUserAddress) {
         echo 1;
        exit();
    }else {
    echo 0; 
    exit();
}
  

   
} 


 ?>