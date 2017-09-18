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



 @$userID = $login_user_id;
 @$userEMAIL = $data->uEmail;
 @$userFIRSTNAME = $data->uFname;
 @$userLASTNAME = $data->uLname;
 @$userADDRESS = $data->uAddress;
 @$userZIP = $data->uZip;
 @$userPHONE = $data->uPhone;
// @$userPASS = $data->uPass;
 @$userCITY = $data->uCity;
 @$userCOUNTRY = $data->uCountry;
 
 
 $msg = '';
 
 
// function MakePass($pass){
//     $byte = 044;
//     $salt = base64_encode($byte);
//     $hash = hash('sha512', $salt . $pass);
//     return md5($hash);
// }

//   AND $userPASS != ''
 if($userEMAIL != '' AND $userFIRSTNAME != '' AND $userLASTNAME != '' AND $userADDRESS != '' AND $userZIP != '' AND $userPHONE != '' ){
     
//     $pass = MakePass($userPASS);
     
//     user_password = '$pass',
     
     $sql = "
            UPDATE users SET 
            user_email = '$userEMAIL',
            user_first_name = '$userFIRSTNAME',
            user_last_name = '$userLASTNAME',    
            user_zip = '$userZIP',
            user_phone = '$userPHONE',
            
            user_city = '$userCITY',
            user_country = '$userCOUNTRY'
            WHERE user_id = '$userID'    
            ";
     
     
     $result = mysqli_query($con, $sql);
     
     if($result == true){
         $q="SELECT `UA_address` FROM `user_addresses` WHERE `UA_user_id`='$userID'";
         $res=mysqli_query($con, $q);
          $slect=  mysqli_num_rows($res);
         if($slect==0){
         echo $sql4 = " 
                 INSERT INTO user_addresses SET
                 UA_address = '$userADDRESS',UA_user_id='$userID'
                  
                 ";
         $result4 = mysqli_query($con, $sql4);
         echo "ok";
     }else{
 
          $sql2 = "
                  UPDATE user_addresses SET
                  UA_address = '$userADDRESS'
                  WHERE UA_user_id = '$userID'    
                 ";
         $result2 = mysqli_query($con, $sql2);
         
         echo '1'; 
     }
     }else{
         echo '2'; 
     }
 }else{
     
//      user_password = '$pass',
     
     $sql3 = "
            INSERT INTO users SET 
            user_email = '$userEMAIL',
            user_first_name = '$userFIRSTNAME',
            user_last_name = '$userLASTNAME',    
            user_zip = '$userZIP',
            user_phone = '$userPHONE',
           
            user_city = '$userCITY',
            user_country = '$userCOUNTRY'
            WHERE user_id = '$userID'    
            ";
     $result3 = mysqli_query($con, $sql3);
 
     
 }
  


?>