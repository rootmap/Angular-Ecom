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


$username = $data->username;
$emailaddress = $data->emailaddress;
$firstName = $data->firstName;
$lastName = $data->lastName;
$address = $data->address;
$city = $data->city;
$country = $data->country;
$postalCode = $data->postalCode;
$company = $data->company;

$adminfullname= $firstName." ".$lastName;/** same field one data save so concat**/


   $sql= "UPDATE admins SET admin_user='$username',admin_email='$emailaddress',
       admin_full_name='$adminfullname',admin_address='$address',
       admin_city='$city',admin_country='$country',postal_code='$postalCode',admin_company='$company' WHERE admin_id='$login_user_id'";
       mysqli_query($con,"UPDATE  merchant_info SET MI_first_name='$firstName',MI_last_name='$lastName',MI_address='$address',MI_post_code='$postalCode'WHERE admin_id='$login_user_id'" );

$result=  mysqli_query($con, $sql);
if ($result == 1) {
    echo json_encode(1);
} else {
    echo "2";
}

