<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

 echo $user_id=$data->user_id;
 $pass = $data->pass;
 $c_pass = $data->c_pass;
function MakePassword($pass) {
       $bytes=044;
       $salt=base64_encode($bytes);
       $hash=hash('sha512', $salt . $pass);
       return md5($hash);
   }
   
	if($pass==$c_pass){
		$password=MakePassword($c_pass);
		 $sql="UPDATE `users` SET `user_password`='$password' WHERE `user_id`='700'";
		$result=mysqli_query($con,$sql);
	
		if($result==1){
			echo 1;
		}else{
			echo 2;
		}
	}
	else{
		echo 0;
	}



?>