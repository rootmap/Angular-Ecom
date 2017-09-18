<?php
include'../DBconnection/database_connections.php';

//include'../DBconnection/auth.php';
session_start();
include '../lib/helper_functions.php';
$data = json_decode(file_get_contents("php://input"));

 @$user_hash = session_id();
 @$user_first_name = $data->user_first_name;
 @$user_last_name = $data->user_last_name;
 @$email = $data->email;
 @$user_social_id = $data->user_social_id;
 @$user_social_gender = $data->user_social_gender;
 @$user_social_type = $data->user_social_type;
 @$user_verification = $data->user_verification;
 

 $return_array = array();
 @$sessionID = session_id();
//echo $u_name = $data->Email.Username;
 
 
 if($email != "" && $user_social_type != "" && $user_social_id != ""){
     $ckeckSocialUserSql = "SELECT * FROM users WHERE user_email ='$email' AND user_verification = '$user_verification' ";
     
     $ckeckSocialUserResult = mysqli_query($con, $ckeckSocialUserSql);

     //echo $u_mail=$ckeckSocialUserResult->user_email;
     $resultCount = mysqli_num_rows($ckeckSocialUserResult);
     
     if($resultCount == 0){
         $user_first_name = validateInput($user_first_name);  
         $user_last_name = validateInput($user_last_name);
         $email = validateInput($email);
         $user_social_id = validateInput($user_social_id);
         $user_social_type = validateInput($user_social_type);
         $user_hash = validateInput($user_hash);
         
         $socialUserInfoArray = '';
         $socialUserInfoArray .= 'user_first_name = "' .$user_first_name. '"';
         $socialUserInfoArray .= ',user_last_name = "' .$user_last_name. '"';
         $socialUserInfoArray .= ',user_email = "' .$email. '"';
         $socialUserInfoArray .= ',user_social_id = "' .$user_social_id. '"';
         $socialUserInfoArray .= ',user_social_type = "' .$user_social_type. '"';
         $socialUserInfoArray .= ',user_gender ="' .$user_social_gender. '"';
         $socialUserInfoArray .= ',user_hash = "' .$user_hash. '"';
         $socialUserInfoArray .= ',user_verification ="' .$user_verification. '"';
         $socialUserInfoArray .= ',user_agree_tc = "' ."I AGREE". '"';
         
         $runInsertSocialUserSql = "INSERT INTO users SET $socialUserInfoArray";
         $resultSocialArray = mysqli_query($con, $runInsertSocialUserSql);
        echo "2";
         
         }else{
             
             $sqlUpdate = "UPDATE users SET SET user_hash = '$user_hash' WHERE user_email = '$email'"; 
             
             echo '1';
             
             
                
         
         }
        
     }  else {
     echo "empty";
}
 




 

?>

