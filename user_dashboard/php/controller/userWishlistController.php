<?php


//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode



@$uid = $login_user_id;

$sql = "SELECT   
                  wishlists.WL_id,
                  wishlists.WL_created,
                  DATE_FORMAT(DATE(wishlists.WL_created),'%W, %M %e, %Y')AS date,
                  wishlists.WL_product_type,
                  events.event_id,
                  events.event_title,
                  events.event_web_logo,
                  events.event_status                                   
                  From `wishlists` 
                   
                  LEFT JOIN events 
                  ON events.event_id = wishlists.WL_product_id 
                  
                  
                  WHERE wishlists.WL_user_id = '$uid'";


$result = mysqli_query($con, $sql);

$object = array();

while($row = mysqli_fetch_array($result)){
    $object[] = $row;
}

echo json_encode($object);

@$del_id = $data->del_id;
if ($del_id !=0) {
	$query = "DELETE FROM wishlists WHERE WL_id=$del_id";
	mysqli_query($con, $query);
	echo "Delete successfully";
}

?>

