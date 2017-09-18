<?php 
include'../DBconnection/database_connections.php';

session_start();

$data = json_decode(file_get_contents("php://input"));
@$user_email=$data->Emailaddress;

@$user_pass=$data->Password;


function MakePassword($pass) {
       $bytes=044;
       $salt=base64_encode($bytes);
       $hash=hash('sha512', $salt . $pass);
       return md5($hash);
   }

if (!empty($user_email) && !empty($user_pass)) {
   $username = $user_email;
   $password = MakePassword($user_pass);
//echo "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$password'";
   $sqlapiuser = mysqli_query($con, "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$password'");
  
if ($sqlapiuser != false) {
  $chkuser = mysqli_num_rows($sqlapiuser);
 if ($chkuser >0) {
   $row = mysqli_fetch_array($sqlapiuser);
       $user_id = $row['user_id'];
       $user_name= $row['user_first_name'];
       $user_img= $row['user_images'];
       $user_status = $row['user_status'];
       if ($user_status == 'active') {
           session_regenerate_id();
           $_SESSION['USER_DASHBOARD_USER_ID'] = $user_id;
           $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $user_name;
           $_SESSION['USER_DASHBOARD_USER_IMG'] = $user_img;
           $_SESSION['USER_DASHBOARD_USER_STATUS'] = $user_status;
           session_write_close();

           //echo 'Api User Successfully Authenticated!';
           echo "1";
       } else {
           //echo 'Api User Status Is Inactive. Please Contact With Ticketchai Authority!';
           echo "2";
       } 
   }else {
   //echo 'Empty Api Key(Username/Password/Hash)!';
    echo "0";
   }
}
}




 ?>
