<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
session_start();
@$user_name =$data->name;
@$user_email =$data->email;
@$user_password =$data->pass;
@$user_conPass =$data->con_pass;
$user_hash =session_id();
$return_array = array();
$countUser = 0;


if ($user_email != "") {
    $checkUser = "SELECT * FROM users WHERE user_email = '$user_email'";
    $checkResult = mysqli_query($con, $checkUser);
    $countUser = mysqli_num_rows($checkResult);
    if ($countUser >= 1) {
        $return_array = array("output" => "error", "msg" => "Customer already exists");
        echo json_encode($return_array);
        exit();
    } else {
       
        $user_verification = "no";


        $insertUserArray = '';
        $insertUserArray .=' user_first_name = "' . $user_name . '"';
        $insertUserArray .=', user_email = "' . $user_email . '"';
        $insertUserArray .=', user_password = "' . $user_password . '"';
        $insertUserArray .=', user_verification = "' . $user_verification . '"';
        $insertUserArray .=', user_hash = "' . $user_hash . '"';
        $insertUserArray .=', user_agree_tc = "' . "I AGREE" . '"';

        $runUserArray = "INSERT INTO users SET $insertUserArray";
        $result = mysqli_query($con, $runUserArray);

        if ($result) {
            $userID = mysqli_insert_id($con);
            // setSession('user_id', $userID);
            // setSession('user_email', $user_email);
            // setSession('user_first_name', $user_first_name);
            // setSession('user_verification', $user_verification);
            // setSession('user_hash', $user_hash);
            
            //temporary json return success for signup this part may be removed
            /*==================================================================*/
        
            $return_array = array("output" => "success", "user_first_name" => $user_name, "msg" => "Customer saved successfully");
            echo json_encode($return_array);


            //updating temp cart if exist with user id
            echo$sqlUpdateTmpCart = "UPDATE event_temp_cart SET ETC_user_id=$userID WHERE ETC_session_id='$user_hash'";
            $resulltUpdateTmpCart = mysqli_query($con, $sqlUpdateTmpCart);


        } else {
            $return_array = array("output" => "error", "msg" => "Customer is not inserted");
            echo json_encode($return_array);
            exit();
        }
    }
}
//echo json_encode(array_merge($arrTmpCartBigItem, $arrCartSelectedTicket ));
//echo json_encode($arrTmpCartBigItem);
	?>