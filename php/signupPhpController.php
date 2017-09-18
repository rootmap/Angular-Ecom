<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
session_start();
@$user_name =$data->name;
@$user_email =$data->email;
@$user_password =$data->pass;
@$user_phone =$data->phone;
@$terms_check =$data->phone;

$countUser = 0;
$user_hash =session_id();
$return_array = array();

 function MakePassword($pass) {
        $bytes=044;
        $salt=base64_encode($bytes);
        $hash=hash('sha512', $salt . $pass);
        return md5($hash);
    }
    
   

if (!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_phone) && !empty($terms_check)) {
    $checkUser = "SELECT * FROM users WHERE user_email = '$user_email'";
    $checkResult = mysqli_query($con, $checkUser);
    $countUser = mysqli_num_rows($checkResult);
    if ($countUser >= 1) {
//        $return_array = array("output" => "error", "msg" => "Customer already exists");
//        echo json_encode($return_array);
        echo 1;
//        User email already exist, Try with another email address
        exit();
    } else {
       $pass=MakePassword($user_password);
        $user_verification = "no";
        $insertUserArray = '';
        $insertUserArray .=' user_first_name = "' . $user_name . '"';
        $insertUserArray .=', user_email = "' . $user_email . '"';
        $insertUserArray .=', user_password = "' . $pass . '"';
        $insertUserArray .=', user_phone = "' . $user_phone . '"';
        $insertUserArray .=', user_verification = "' . $user_verification . '"';
        $insertUserArray .=', user_hash = "' . $user_hash . '"';
        $insertUserArray .=', user_agree_tc = "' . "I AGREE" . '"';

        
        
        $runUserArray = "INSERT INTO users SET $insertUserArray";
        $result = mysqli_query($con, $runUserArray);
        
        if ($result) {
            $checkUserId = "SELECT * FROM users WHERE user_email = '$user_email'";
            $checkResultID = mysqli_query($con, $checkUserId);
            $fetchData= mysqli_fetch_array($checkResultID);
             $user_id=$fetchData['user_id'];
//            $return_array = array("output" => "success", "msg" => "Customer registration successfull");
//            echo json_encode($return_array);
              echo $user_id;
//              User signUp seccessfully done.
        } else {
//            $return_array = array("output" => "error", "msg" => "Registration failed !!");
//            echo json_encode($return_array);
            echo 3;
//            There is problem in signup
            
        }
    }
}else{
    echo 4; 
//    please fill all the fields.
}
//echo json_encode(array_merge($arrTmpCartBigItem, $arrCartSelectedTicket ));
//echo json_encode($arrTmpCartBigItem);
	?>