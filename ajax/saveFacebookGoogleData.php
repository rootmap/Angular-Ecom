<?php

header("Access-Control-Allow-Origin: *");
include'.././DBconnection/database_connections.php';
include '../lib/helper_functions.php';
$user_hash = session_id();

$uesr_email = "";
$user_first_name = "";
$user_last_name = "";
$user_social_id = "";
$user_social_type = "";
$user_verification = "";
$user_gender = "";
$user_social_types = '';
$countUserInfo = 0;
$countGetUser = 0;
$link_dir = "./user_dashboard/dashboard.php";
$return_array = array();
$sessionID = session_id();
extract($_POST);


if ($user_email != "" && $user_social_types != "" && $user_social_id != "") {
    $checkSocialUserSql = "SELECT * FROM users WHERE user_email = '$user_email' AND"
            . " user_social_id = '$user_social_id' AND user_social_type = '$user_social_types'";

    $checkSocialUserResult = mysqli_query($con, $checkSocialUserSql);
    $countSocialUser = mysqli_num_rows($checkSocialUserResult);

    if ($countSocialUser == 0) {
        $user_first_name = validateInput($user_first_name);
        $user_last_name = validateInput($user_last_name);
        $user_email = validateInput($user_email);
        $user_social_id = validateInput($user_social_id);
        $user_social_types = validateInput($user_social_types);
        $user_hash = validateInput($user_hash);

        $insertSocialUserArray = '';
        $insertSocialUserArray .=' user_first_name = "' . $user_first_name . '"';
        $insertSocialUserArray .=',user_last_name = "' . $user_last_name . '"';
        $insertSocialUserArray .=',user_email = "' . $user_email . '"';
        $insertSocialUserArray .=',user_social_id = "' . $user_social_id . '"';
        $insertSocialUserArray .=',user_social_type = "' . $user_social_types . '"';
        $insertSocialUserArray .=',user_gender = "' . $user_gender . '"';
        $insertSocialUserArray .=',user_hash = "' . $user_hash . '"';
        $insertSocialUserArray .=',user_verification = "' . $user_verification . '"';
        $insertSocialUserArray .=',user_agree_tc = "' . "I AGREE" . '"';

        $runInsertSocialUserSql = "INSERT INTO users SET $insertSocialUserArray";
        $resultSocialArray = mysqli_query($con, $runInsertSocialUserSql);


        if ($resultSocialArray) {
            $userInfoSql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_social_type='$user_social_types'";
            $resultUserInfo = mysqli_query($con, $userInfoSql);
            $countUserInfo = mysqli_num_rows($resultUserInfo);
            if ($countUserInfo >= 1) {
                while ($row = mysqli_fetch_object($resultUserInfo)) {
                    $userID = $row->user_id;
                    $user_email = $row->user_email;
                    $user_first_name = $row->user_first_name;
                    $user_verification = $row->user_verification;
                    $user_hash = $row->user_hash;
                    session_regenerate_id();
                    $_SESSION['USER_DASHBOARD_USER_ID'] = $userID;
                    $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $user_first_name;
                    session_write_close();

                    $return_array = array("output" => "success", "user_first_name" => $user_first_name, "msg" => "Customer saved successfully", "link" => $link_dir, "send_mail" => "yes");
                    echo json_encode($return_array);

                    exit();
                }
            }
        } else {
            $return_array = array("output" => "error", "msg" => "User registration failed.");
            echo json_encode($return_array);
            exit();
        }
    } else {

        $user_first_name = validateInput($user_first_name);
        $user_last_name = validateInput($user_last_name);
        $user_email = validateInput($user_email);
        $user_social_id = validateInput($user_social_id);
        $user_social_types = validateInput($user_social_types);
        $user_hash = validateInput($user_hash);

        $updateSocialUserArray = '';
        $updateSocialUserArray .=' user_first_name = "' . $user_first_name . '"';
        $updateSocialUserArray .=',user_last_name = "' . $user_last_name . '"';
        $updateSocialUserArray .=',user_email = "' . $user_email . '"';
        $updateSocialUserArray .=',user_social_id = "' . $user_social_id . '"';
        $updateSocialUserArray .=',user_social_type = "' . $user_social_types . '"';
        $updateSocialUserArray .=',user_gender = "' . $user_gender . '"';
        $updateSocialUserArray .=',user_hash = "' . $user_hash . '"';
        $updateSocialUserArray .=',user_verification = "' . $user_verification . '"';
        $updateSocialUserArray .=',user_agree_tc = "' . "I AGREE" . '"';

        $runUpdateSocialUserSql = "UPDATE users SET $updateSocialUserArray WHERE user_email = $user_email ";
        $resultSocialArray = mysqli_query($con, $runUpdateSocialUserSql);

        $getUserSql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_social_type = '$user_social_types' AND user_social_id = '$user_social_id'";
        $resultGetUser = mysqli_query($con, $getUserSql);
        $countGetUser = mysqli_num_rows($resultGetUser);
        if ($countGetUser >= 1) {
            while ($getUser = mysqli_fetch_object($resultGetUser)) {
                $userID = $getUser->user_id;
                $user_email = $getUser->user_email;
                $user_first_name = $getUser->user_first_name;
                $user_verification = $getUser->user_verification;
                $user_hash = $getUser->user_hash;



                session_regenerate_id();
                $_SESSION['USER_DASHBOARD_USER_ID'] = $userID;
                $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $user_first_name;
                session_write_close();

                //temporary code starts
                $return_array = array("output" => "success", "user_first_name" => $user_first_name, "msg" => "Successfully logged in ", "link" => $link_dir, "send_mail" => "no");
                echo json_encode($return_array);
                exit();
            }
        } else {
            $return_array = array("output" => "error", "msg" => "Login failed.");
            echo json_encode($return_array);
            exit();
        }
    }
} else {
    $return_array = array("output" => "error", "msg" => "Registration failed.");
    echo json_encode($return_array);
    exit();
}
?>
