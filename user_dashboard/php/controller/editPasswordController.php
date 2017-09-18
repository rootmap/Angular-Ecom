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



@$oldPass = $data->oldPass;
@$newPass = $data->newPass;
@$rePass = $data->rePass;


function MakePass($pass){
    $byte = 044;
    $salt = base64_encode($byte);
    $hash = hash('sha512', $salt . $pass);
    return md5($hash);
}
@$NoldPass = MakePass($oldPass); 
@$NnewPass = MakePass($newPass); 
@$NrePass = MakePass($rePass); 

if(!empty($oldPass) && !empty($newPass) && !empty($rePass )){
    
    $sql1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE user_id = '$login_user_id' AND user_password = '$NoldPass'"));
    
    if($sql1 == 0){
        echo 0;
    }else{
        
        if($newPass == $rePass){
               $sql2 = mysqli_query($con, "UPDATE `users` SET user_password = '$NnewPass' WHERE user_id = '$login_user_id'");
               if($sql2 == 1){
                   echo 1;
               }else{
                   echo 2;
               }
        }else{
            echo 3;
        }
        
    }
    
} else{
    echo 4;
}





?>

