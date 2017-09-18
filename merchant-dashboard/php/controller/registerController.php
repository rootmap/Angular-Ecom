<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here


/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */


$firstName = $data->firstName;
$lastName = $data->lastName;
$email = $data->email;
$urAddress = $data->yourAddress;
$password = $data->password;
$phoneMobileNo = $data->phoneMobileNo;




$fullname = $firstName . ' ' . $lastName;

function MakePassword($pass) {
    $bytes = 044;
    $salt = base64_encode($bytes);
    $hash = hash('sha512', $salt . $pass);
    return md5($hash);
}

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($phoneMobileNo)) {
    /* if not empty */
    $encrypt_password = MakePassword($password);
    $sqlchecklog = mysqli_query($con, "SELECT * FROM  merchant_info WHERE MI_email_address='$email'");
    $sqlcheck = mysqli_num_rows($sqlchecklog);



    if ($sqlcheck == 0) {
        $signup = mysqli_query($con, "INSERT INTO merchant_info SET MI_first_name='$firstName',MI_last_name='$lastName',MI_email_address='$email',MI_address='$urAddress',
      MI_password='$encrypt_password',MI_number='$phoneMobileNo'");

        if ($signup == 1) {

            $signupdata = mysqli_query($con, "INSERT INTO admins SET admin_user='$email',admin_full_name='$fullname',admin_email='$email',admin_password='$encrypt_password'");
            if ($signupdata == 1) {

                $sqllogin = mysqli_query($con, "SELECT * FROM admins WHERE admin_email='$email' AND admin_password='$encrypt_password'");
                $chklogin = mysqli_num_rows($sqllogin);

                if ($chklogin == 1) {
                    $row = mysqli_fetch_array($sqllogin);
                    $user_id = $row['admin_id'];
                    $user_full_name = $row['admin_full_name'];
                    $admin_images = $row['admin_images'];


                    session_regenerate_id();
                    $_SESSION['SESS_MERCHANT_USER_ID'] = $user_id;
                    $_SESSION['SESS_MERCHANT_USER_IMAGE'] = $admin_images;
                    $_SESSION['SESS_MERCHANT_USER_FULLNAME'] = $user_full_name;
                    session_write_close();

                    echo 1;
                } else {
                    echo 5;
                }

                //echo 1;
            } else {
                echo 4;
            }

            //echo 1;
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }

    /* if not empty */
} else {
    /* if empty */
    echo 0;
    /* if empty */
}




//$adminName = $firstName." ".$lastName;/** same field one data save so concat**/


