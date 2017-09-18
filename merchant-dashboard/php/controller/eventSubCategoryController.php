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

//json data encoding passing start here
//json data encoding passing end here

 $sql = "select `category_id` as id,`category_title` as name,`category_parent_id` FROM `categories` WHERE `category_parent_id`!='0'"; 
$result=mysqli_query($con, $sql);
$object=array();
while ($row=  mysqli_fetch_array($result)){
    /* @var $row type */
    $object[]= $row;
}

echo json_encode($object);