<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Including database connections start here
require_once '../../DBconnection/database_connections.php';
include '../../DBconnection/auth.php';
// Including database connections end here




/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */

$oldPassword = $data->OldPassword;
$c_password = $data->NewPassword;
$ReTypePassword = $data->ReTypePassword;

function MakePassword($pass) {
    $bytes = 044;
    $salt = base64_encode($bytes);
    $hash = hash('sha512', $salt . $pass);
    return md5($hash);
}

$encrypt_password=MakePassword($c_password);
$encrypt_old_password=MakePassword($oldPassword);

if (!empty($oldPassword) && !empty($c_password) && !empty($ReTypePassword)) {
    $adminchk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM admins WHERE admin_id='$login_user_id' AND admin_password='$encrypt_old_password'"));
    if ($adminchk == 0) {
        echo 0; //password mismatch with current password
    } else {
        if ($c_password == $ReTypePassword) {
            //update process start
            $updatesql = mysqli_query($con, "UPDATE admins SET admin_password='$encrypt_password' WHERE admin_id='$login_user_id'");
            if ($updatesql == 1) {
                echo 1; 
                // success status for update password
            } else {
                echo 2; 
                //failed to update current password
            }
            //update process end
        } else {
            echo 3; 
            //password mismatch with retype password
        }
    
    }
}
else
{
    echo 4; // some field is empty 
}
//$Subscri = $data->Subscri;
//print_r($data); //all data show is print_r
//if (!empty($OldPassword) && !empty($NewPassword)) {
//
//    $encrypt_password = md5($Password);
//    $sqllogin = mysqli_query($con, "SELECT * FROM admins WHERE admin_email='$EmailAddress' AND admin_password='$Password'");
//    $chklogin = mysqli_num_rows($sqllogin);
//
//    if ($chklogin == 1) {
//        $row = mysqli_fetch_array($sqllogin);
//        $user_id = $row['admin_id'];
//        $user_full_name = $row['admin_full_name'];
//        $admin_images = $row['admin_images'];
//
//
//        session_regenerate_id();
//        $_SESSION['SESS_MERCHANT_USER_ID'] = $user_id;
//        $_SESSION['SESS_MERCHANT_USER_IMAGE'] = $admin_images;
//        $_SESSION['SESS_MERCHANT_USER_FULLNAME'] = $user_full_name;
//        session_write_close();
//
//        echo 1;
//    } else {
//        echo 2;
//    }
//} else {
//    echo 0;
//}


