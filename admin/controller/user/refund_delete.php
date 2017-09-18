<?php
include '../../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}


$id = $_POST['id'];  
$sql = "DELETE FROM refund_request WHERE id='$id'"; 
$DeleteResult=mysqli_query($con, $sql);
if($DeleteResult)
{
    echo json_encode($DeleteResult);
}
else
{
  if(DEBUG){
      $err="resultDelAdmin error:".mysql_errno($con);
  }  else {
     $err="resultDelAdmin query failed";   
  }
}