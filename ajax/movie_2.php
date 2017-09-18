<?php
include'../DBconnection/database_connections.php';
session_start();
extract($_POST);
$request_type = $_SERVER['REQUEST_METHOD'];
if ($request_type == "POST") {
    include "../config/config.php";
    $get_amount=  mysqli_real_escape_string($con,$amount);
    echo number_format($get_amount,2);
   
} else {
    echo "...OFF";
}
