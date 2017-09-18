<?php
if (!isset($_SESSION)) { session_start(); }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Don't change without consult with me : Fahad Bhuyian
 * Developed By : SM
 */


// index page log out
if(isset($_GET['signout']))
{
    session_destroy();
    header('location:./signin.php');
    exit();
}
//exit();