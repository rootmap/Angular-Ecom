<?php
if (!isset($_SESSION)) { session_start(); }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Don't change without consult with me : Fahad Bhuyian
 * Developed By : SM
 */

 if(!isset($_SESSION['USER_DASHBOARD_USER_ID']) || empty(trim($_SESSION['USER_DASHBOARD_USER_ID'])))
{
    header('location: ../signin.php');
    exit();
}

// if(isset($_SESSION['USER_DASHBOARD_USER_ID']) || empty(trim($_SESSION['USER_DASHBOARD_USER_ID'])))
//{
    $login_user_id=$_SESSION['USER_DASHBOARD_USER_ID'];
    $login_user_name=$_SESSION['USER_DASHBOARD_USER_FULLNAME'];
    $login_user_img=$_SESSION['USER_DASHBOARD_USER_IMG'];
    $login_user_status=$_SESSION['USER_DASHBOARD_USER_STATUS'];
           
           
           if(empty($login_user_img)){
               $defimage = "default-avatar.png";
           }else{
               $defimage = $login_user_img;
           }
           
//}

if(isset($_GET['logout']))
{
    session_destroy();
    header('location:../signin.php');
    exit();
}


