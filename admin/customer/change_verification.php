<?php

include '../../config/config.php';

extract($_POST);
$UserID = 0;
$user_verification = '';
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
}
if (isset($_GET['user_verification'])) {
    $user_verification = $_GET['user_verification'];
}

//echo $userID;
//echo $user_verification;


if ($user_verification === 'yes') {
    $sqlUpdateStatus = "UPDATE users SET user_verification='no' WHERE user_id=$userID";
    $resultUserStatus = mysqli_query($con, $sqlUpdateStatus);
    if ($resultUserStatus) {
        $msg = "Status changed successfully";
        $link = "user_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "resultUserStatus error: " . mysqli_error($con);
        } else {
            $err = "resultUserStatus query failed.";
        }
    }
} else {
    $sqlUpdateStatus = "UPDATE users SET user_verification='yes' WHERE user_id=$userID";
    $resultUserStatus = mysqli_query($con, $sqlUpdateStatus);
    if ($resultUserStatus) {
        $msg = "Status changed successfully";
        $link = "user_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "resultUserStatus error: " . mysqli_error($con);
        } else {
            $err = "resultUserStatus query failed.";
        }
    }
}
?>
