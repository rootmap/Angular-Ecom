<?php
include '../../config/config.php';
extract($_POST);
if($st==1)
{
    $sqlfet=  mysqli_query($con,"SELECT event_id,event_is_eticket_user_image as status FROM events WHERE event_id='".$event_id."'");
    $chk=  mysqli_num_rows($sqlfet);
    if($chk!=0)
    {
        while($row=  mysqli_fetch_object($sqlfet)):
            $dd[]=$row;
        endwhile;
        
        echo $dd[0]->status;
        
    }
}
 else {
     $dd=array();
     $sqlfet=  mysqli_query($con, $query);
     $chk=  mysqli_num_rows($sqlfet);
     if($chk!=0)
     {
         while($row=  mysqli_fetch_object($sqlfet)):
             $dd[]=$row;
         endwhile;
         
     }
     
     echo var_dump($dd);
     
}
?>