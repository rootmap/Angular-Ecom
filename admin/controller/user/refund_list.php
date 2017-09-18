<?php
session_start();
include '../../../config/config.php';
$admin_type = getSession('admin_type');
$admin_ID = getSession('admin_id');

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    
    
    if($admin_type!=1)
    {
      $get_sql = "SELECT
rq.id,
ad.admin_full_name,
rq.available_amount,
rq.request_amount,
rq.refund_method,
(CASE rq.status WHEN 0 THEN 'pending' ELSE 'active' END) as `status`
FROM 
refund_request as rq 
INNER JOIN `admins` as ad ON rq.merchant_id=ad.admin_id
WHERE rq.merchant_id ='$admin_ID' ORDER BY rq.id DESC";
    }
    else 
    {
        $get_sql = "SELECT
rq.id,
ad.admin_full_name,
rq.available_amount,
rq.request_amount,
rq.refund_method,
(CASE rq.status WHEN 0 THEN 'pending' ELSE 'active' END) as `status`
FROM 
refund_request as rq 
INNER JOIN `admins` as ad ON rq.merchant_id=ad.admin_id
 ORDER BY rq.id DESC";
    }
    
    $resultAdmin = mysqli_query($con, $get_sql);

    if ($resultAdmin) {
        while ($obj = mysqli_fetch_object($resultAdmin)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultAdmin error: " . mysqli_error($con);
        } else {
            $err = "resultAdmin query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}


//if ($verb == "POST") {
//
//    $admin_id = mysqli_real_escape_string($con, $_POST["admin_id"]);
//    $admin_full_name = mysqli_real_escape_string($con, $_POST["admin_full_name"]);
//    $admin_email = mysqli_real_escape_string($con, $_POST["admin_email"]);
//    $admin_type = mysqli_real_escape_string($con, $_POST["AT_id"]);
//    $admin_status = mysqli_real_escape_string($con, $_POST["admin_status"]);
//
//    $admin_updated_by = getSession("admin_id");
//
//
//    $update_query = '';
//    $update_query .=' admin_full_name = "' . $admin_full_name . '"';
//    $update_query .=', admin_email ="' . $admin_email . '"';
//    $update_query .=', admin_type ="' . $admin_type . '"';
//    $update_query .=', admin_status ="' . $admin_status . '"';
//    $update_query .=', admin_updated_by ="' . $admin_updated_by . '"';
//
//    $run_update_query = "UPDATE admins SET $update_query WHERE admin_id = $admin_id";
//
//    $resultUpdateAdmin = mysqli_query($con, $run_update_query);
//
//    if ($resultUpdateAdmin) {
//        echo json_encode($resultUpdateAdmin);
//    } else {
//        if (DEBUG) {
//            $err = "resultUpdateAdmin error: " . mysqli_error($con);
//        } else {
//            $err = "resultUpdateAdmin query failed";
//        }
//    }
//}


//
//if ($verb == "DELETE") {
//
//    $request_vars = Array();
//    parse_str(file_get_contents('php://input'), $request_vars);
//
//    $rr_id = mysqli_real_escape_string($con, $request_vars["id"]);
//
//    $delete_sql = "DELETE FROM refund_request WHERE id = '" . $rr_id . "'";
//
//    $resultDelAdmin = mysqli_query($con, $delete_sql);
//
//    if ($resultDelAdmin) {
//        echo json_encode($resultDelAdmin);
//    } else {
//        if (DEBUG) {
//            $err = "resultDelAdmin error: " . mysqli_error($con);
//        } else {
//            $err = "resultDelAdmin query failed";
//        }
//    }
//}
?>