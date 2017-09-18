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
        $get_sql = "SELECT admins.*, admin_types.* FROM admins LEFT JOIN admin_types ON admins.admin_type = admin_types.AT_id WHERE admin_id='".$admin_ID."' ORDER BY admin_id DESC";
    }
    else 
    {
        $get_sql = "SELECT admins.*, admin_types.* FROM admins LEFT JOIN admin_types ON admins.admin_type = admin_types.AT_id ORDER BY admin_id DESC";
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






if ($verb == "DELETE") {

    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $admin_id = mysqli_real_escape_string($con, $request_vars["admin_id"]);

    $delete_sql = "DELETE FROM admins WHERE admin_id = '" . $admin_id . "'";

    $resultDelAdmin = mysqli_query($con, $delete_sql);

    if ($resultDelAdmin) {
        echo json_encode($resultDelAdmin);
    } else {
        if (DEBUG) {
            $err = "resultDelAdmin error: " . mysqli_error($con);
        } else {
            $err = "resultDelAdmin query failed";
        }
    }
}
?>