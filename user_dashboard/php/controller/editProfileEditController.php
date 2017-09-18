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


//session user id

//session user id

@$uId = $login_user_id;

$objectArray = array();

$sql = "SELECT 
u.user_id,
u.user_email,
u.user_password,
u.user_first_name,
u.user_last_name,
ua.UA_address,
c.city_name,
co.country_name,
u.user_zip,
u.user_phone

FROM `users` AS u 
LEFT JOIN `user_addresses` AS ua
ON u.user_id = ua.UA_user_id 
LEFT JOIN `cities` AS c
ON u.user_city = c.city_id
LEFT JOIN `countries` AS co
ON u.user_country = co.country_id
WHERE u.user_id='$uId'
        ";

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_object($result)){
    $objectArray[] = $row;
}

echo json_encode($objectArray);

?>