<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

extract($_POST);
if ($st == 1) {
    $mgid = '';
    //Banner Start
    $arrayBanner = array();
    $sqlBanner = "SELECT alldata.*,IFNULL((SELECT id FROM merchant_wise_event_gallery  WHERE merchant_id='" . $merchant_id . "' AND event_id=alldata.event_id LIMIT 1),0) as status FROM 
				(SELECT 
				 event_id, 
				 event_title,
				 event_web_banner AS banner
				
				 FROM events) as alldata 
				WHERE alldata.event_id IN (SELECT event_id FROM merchant_wise_event_data WHERE merchant_id='" . $merchant_id . "')";
    $resultBanner = mysqli_query($con, $sqlBanner);
    if ($resultBanner) {
        while ($resultBannerObj = mysqli_fetch_object($resultBanner)) {
            $arrayBanner[] = $resultBannerObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultBanner error: " . mysqli_error($con);
        } else {
            $err = "resultBanner query failed.";
        }
    }
//debug($arrayBanner);
// Banner End

    if (count($arrayBanner) > 0): 
	$mgid .='<input id="mer_id" name="mer_id" type="hidden" value="'. $merchant_id . '" />';
    foreach ($arrayBanner AS $Banner): 
        $mgid .='<tr class="gradeA"><td width="400">'.$Banner->event_title.'</td>
					<td><img src="../../upload/event_web_banner/'.$Banner->banner.'" alt="photo" class="img-responsive img-thumbnail" style="height:120px; width:150px;"/></td>
					<td><label class="checkbox"><input id="evnt_id" name="event_id[]"';  
					 if($Banner->status!=0)
					 {
						$mgid .=' checked="checked" ';
					 }
					 $mgid .='type="checkbox" class="checkbox" value="'.$Banner->event_id.'" />Select</label><br></td></tr>';
    endforeach;
    endif;
	
	//$makearray = array("datas" => $mgid);
	echo $mgid;
}
//elseif ($st == 2) {
//    $mgids = '';
//    //Banner Start
//    $arrayBanner = array();
//    $sqlBanner = "SELECT 
//					mweg.id,
//					mweg.merchant_id,
//					mweg.event_id,
//					ev.event_title,
//					ev.event_web_banner AS banner,
//					ev.event_status
//					FROM merchant_wise_event_gallery AS mweg
//					LEFT JOIN events AS ev ON ev.event_id = mweg.event_id
//					WHERE merchant_id='".$merchant_id."' ORDER BY mweg.id DESC";
//    $resultBanner = mysqli_query($con, $sqlBanner);
//    if ($resultBanner) {
//        while ($resultBannerObj = mysqli_fetch_object($resultBanner)) {
//            $arrayBanner[] = $resultBannerObj;
//        }
//    } else {
//        if (DEBUG) {
//            $err = "resultBanner error: " . mysqli_error($con);
//        } else {
//            $err = "resultBanner query failed.";
//        }
//    }
////debug($arrayBanner);
//// Banner End
//
//    if (count($arrayBanner) > 0): 
//	$mgids .='<input id="mer_id" name="mer_id" type="hidden" value="'. $merchant_id . '" />';
//    foreach ($arrayBanner AS $Banner): 
//        $mgids .='<tr class="gradeA">
//					<td width="400">'.$Banner->event_title.'</td><td><img src="../../upload/event_web_banner/'.$Banner->banner.'" alt="photo" class="img-responsive img-thumbnail" style="height:120px; width:150px;"/></td>
//					<td><label class="checkbox"><input id="id" name="id[]" type="checkbox" class="checkbox" value="'.$Banner->id.'" />Remove</label></td></tr>';
//    endforeach;
//    endif;
//	echo $mgids;
//}



?>

