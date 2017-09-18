<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayAdminAccess = array();
    $sqlAdminAccess = "SELECT  admin_login_history.*,admins.admin_full_name as admin_name"
            . " FROM admin_login_history "
            . " LEFT JOIN admins ON admin_login_history.ALH_admin_id = admins.admin_id "
            . " ORDER BY ALH_id DESC";
    $resultAdminAccess = mysqli_query($con, $sqlAdminAccess);

    if ($resultAdminAccess) {
        while ($obj = mysqli_fetch_object($resultAdminAccess)) {
            $arrayAdminAccess[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultAdminAccess error: " . mysqli_error($con);
        } else {
            $err = "resultAdminAccess query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayAdminAccess) . "}";
}
?>
