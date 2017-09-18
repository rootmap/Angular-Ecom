<?php

include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

@$email = $data->email;
$user_id='';
$user_name='';
$user_pass='';
if ($email != '') {

     $selSql = "SELECT * FROM users WHERE user_email = '$email' ORDER BY `user_id` DESC LIMIT 1";
    $selrun = mysqli_query($con, $selSql);
    $numrow = mysqli_num_rows($selrun);
	if($numrow > 0){
		while($row =mysqli_fetch_array($selrun)){
			$user_id=$row['user_id'];
			$user_name=$row['user_first_name'];
			$user_pass=$row['user_password'];
		}
		echo $user_id;
	}else{
		echo '0';
	}	
}
?>