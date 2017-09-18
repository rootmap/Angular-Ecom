<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$id = "";
if (isset($_POST["btnMerGalDel"])) {

    extract($_POST);
	$msg_count=0;
	$err_count=0;
	foreach($_POST['id'] as $ids):
		$idd = mysqli_real_escape_string($con,$ids);
		$delete_sql = "DELETE FROM merchant_wise_event_gallery WHERE id = '" .$idd. "'";
		$resultDelImage = mysqli_query($con, $delete_sql);
		if($resultDelImage==1)
		{
			$msg_count+=1;	
		}
		else
		{
			$err_count+=1;
		}
	endforeach;
    
    if ($msg_count!=0) {
        $msg="Deleted".$msg_count." Item Successfully.";
		$link = "merchant_wise_gallery_list.php?msg=" . base64_encode($msg)."&merchant_id=".$_POST['mer_id'];
		redirect($link);	
    } else {
        $err="Sorry! Failed to delete";
		$link = "merchant_wise_gallery_list.php?msg=" . base64_encode($err)."&merchant_id=".$_POST['mer_id'];
		redirect($link);	
    }
}
?>


