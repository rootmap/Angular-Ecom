<?php

include '../../config/config.php';
extract($_POST);
$userID = 0;
$userStatus = '';
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
}

if (isset($_GET['user_status'])) {
    $userStatus = $_GET['user_status'];
}

//echo $userID;
//echo $userStatus;

if ($userStatus === 'active') {
    $sqlUpdateStatus = "UPDATE users SET user_status='inactive' WHERE user_id=$userID";
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
    $sqlUpdateStatus = "UPDATE users SET user_status='active' WHERE user_id=$userID";
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