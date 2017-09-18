<?php 
include'../DBconnection/database_connections.php';
@$data = json_decode(file_get_contents("php://input"));

$name=$data->name;
$email=$data->email;
$subject=$data->sub;
$msg=$data->msg;
$date=date('Y,m,d');

$query = "INSERT INTO `contact_us` SET `CU_name`='$name', `CU_email`='$email', `CU_subject`='$subject', `CU_message`='$msg', `CU_created_on`='$date'";
$result = mysqli_query($con,$query);
if ($result==1) {
    echo 1;
}


?>