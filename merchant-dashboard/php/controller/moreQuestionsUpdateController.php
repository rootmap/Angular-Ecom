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
/*./Data convert by jeson end here*/

$fids=$data->data;
//echo $fids;
$i=0;
$success=0;
foreach ($fids AS $dataval)
{
    $ft=$dataval->ft;
    $qt=$dataval->qt;
    $vd=$dataval->vd;
    $ep=$dataval->ep;
    
    $field_name=  strtolower(str_replace(" ","_",$qt));
    $field_id=$field_name;
    
    $insert_string="INSERT INTO event_dynamic_forms SET form_type='info',";
    $insert_string .="form_field_type='$ft',";
    $insert_string .="form_field_title='$qt',";
    $insert_string .="form_field_name='$field_name',";
    $insert_string .="form_field_given_id='$field_id',";
    $insert_string .="form_field_is_required='$vd',";
    $insert_string .="entry_pass='$ep',";
    $insert_string .="version='1'";
    
    $insdata=mysqli_query($con,$insert_string);
    
    if($insdata==1)
    {
        $success+=1;
    }
    
    $insert_string='';
    $i++;
}


if($success!=0)
{
    echo 1;
}
else
{
    echo 0;
}


//print_r($data);

//$sql="INSERT INTO  SET";
