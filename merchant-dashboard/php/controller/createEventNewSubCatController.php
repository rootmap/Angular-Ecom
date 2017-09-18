<?php
include '../../DBconnection/auth.php';
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
$subcatname = $data->name;
$parent = $data->parent;
//json data encoding passing start here
//json data encoding passing end here

$chkeckexists = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `categories` WHERE `category_title`='$subcatname'"));
if ($chkeckexists == 0) {
    $sql = "INSERT INTO `categories` SET `category_title`='$subcatname',`category_parent_id`='$parent'";
    $result = mysqli_query($con, $sql);

    if ($result == 1) {
        $sqls = "SELECT * FROM `categories` WHERE `category_title`='$subcatname' AND `category_parent_id`='$parent'";
        $results = mysqli_query($con, $sqls);
        $chkres = mysqli_num_rows($results);

        if ($chkres != 0) {
            $row = mysqli_fetch_array($results);
            echo $row['category_id'];
        }
    }
} else {
    $sqls = "SELECT * FROM `categories` WHERE `category_title`='$subcatname'";
    $results = mysqli_query($con, $sqls);
    $chkres = mysqli_num_rows($results);

    if ($chkres != 0) {
        $row = mysqli_fetch_array($results);
        echo $row['category_id'];
    }
}
