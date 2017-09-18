<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$merchant_id = "";
$event_id = "";


if (isset($_POST["btnMerGal"])) {
    //extract($_POST);
	$merchant_id=$_POST['mer_id'];
	$countpost=count($_POST['event_id']);
	//echo $countpost;
	$msg_count=0;
	$err_count=0;
	if($countpost!=0)
	{
		mysqli_query($con,"DELETE FROM merchant_wise_event_gallery WHERE merchant_id = '" . $merchant_id . "'");
		foreach($_POST['event_id'] as $event_id):
			
			$merchant_id = mysqli_real_escape_string($con, $merchant_id);
			$event_id = mysqli_real_escape_string($con, $event_id);
			$merchant_gal_created_on = date("Y-m-d");
		
			$insert_MerGalArray = '';
			$insert_MerGalArray .= ' merchant_id = "' . $merchant_id . '"';
			$insert_MerGalArray .= ', event_id = "' . $event_id . '"';
			$insert_MerGalArray .= ', date = "' . $merchant_gal_created_on . '"';
		
		
		
			$checkMerGal = "SELECT * FROM merchant_wise_event_gallery WHERE event_id = '".$event_id."'";
			$checkMerGalResult = mysqli_query($con, $checkMerGal);
			$countMerGal = mysqli_num_rows($checkMerGalResult);
			
			
			if ($countMerGal >= 1) {
				$err_count += 1;
			} else {
				$run_insert_MerGalArray = "INSERT INTO merchant_wise_event_gallery SET ".$insert_MerGalArray;
		
				$resultMerGalInsert = mysqli_query($con, $run_insert_MerGalArray);
				//echo var_dump($resultMerEvntInsert);
				//exit();
				if ($resultMerGalInsert) {
					$msg_count+= 1;
					
				} 
			}
	
			
		endforeach;	
	}
	
	if ($msg_count!=0) {
        $msg="Saved".$msg_count." Item Successfullly";
		$link = "add_merchant_wise_gallery.php?msg=" . base64_encode($msg)."&merchant_id=".$_POST['mer_id'];
		redirect($link);	
    } elseif ($countMerGal <= 1){
		$err="Already Exsists! Choose Again.";
		$link = "add_merchant_wise_gallery.php?msg=" . base64_encode($err)."&merchant_id=".$_POST['mer_id'];
		redirect($link);
	}
	else {
        $err="Failed to save";
		$link = "add_merchant_wise_gallery.php?msg=" . base64_encode($err)."&merchant_id=".$_POST['mer_id'];
		redirect($link);	
    }
	
	
    
    
}

?>

