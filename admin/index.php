<?php

include '../config/config.php';
$ipAddress = $_SERVER['REMOTE_ADDR'];
$sqlChkBlock = "SELECT * FROM admin_blocked_ip WHERE ABI_ip='$ipAddress'";
$resultChkBlock = mysqli_query($con, $sqlChkBlock);
if (mysqli_num_rows($resultChkBlock) > 0) {
    $link = baseUrl();
    redirect($link);
} else {
    if(getSession('LOGIN_ATTMPT')){
        unsetSession('LOGIN_ATTMPT');
    }
    header("location:login.php");
}
?>