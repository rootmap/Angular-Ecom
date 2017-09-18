<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Don't change without consult with me : Fahad Bhuyian
 * Developed By : SM
 */

if(!isset($_SESSION['SESS_MERCHANT_USER_ID']) || empty(trim($_SESSION['SESS_MERCHANT_USER_ID'])))
{
    header('location: login.php');
    exit();
}

$login_user_id=$_SESSION['SESS_MERCHANT_USER_ID'];
$login_user_name=$_SESSION['SESS_MERCHANT_USER_FULLNAME'];
$login_user_image=$_SESSION['SESS_MERCHANT_USER_IMAGE'];


if(empty($login_user_image))
{
    $defimage="default-avatar.png";
}
else
{
    $defimage=$login_user_image;
}

if(isset($_GET['logout']))
{
    session_destroy();
    header('location: login.php');
    exit();
}


//exit();