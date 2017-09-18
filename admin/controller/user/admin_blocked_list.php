<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayBlockedIP = array();
    $sqlBlockedIP = "SELECT  * FROM admin_blocked_ip ORDER BY ABI_id DESC";
    $resultBlockedIP = mysqli_query($con, $sqlBlockedIP);

    if ($resultBlockedIP) {
        while ($obj = mysqli_fetch_object($resultBlockedIP)) {
            $arrayBlockedIP[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultBlockedIP error: " . mysqli_error($con);
        } else {
            $err = "resultBlockedIP query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayBlockedIP) . "}";
}


if ($verb == "DELETE") {

    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $ABI_id = mysqli_real_escape_string($con, $request_vars["ABI_id"]);

    $delete_sql = "DELETE FROM admin_blocked_ip WHERE ABI_id = '" . $ABI_id . "'";

    $resultDelBlockIP = mysqli_query($con, $delete_sql);

    if ($resultDelBlockIP) {
        echo json_encode($resultDelBlockIP);
    } else {
        if (DEBUG) {
            $err = "resultDelBlockIP error: " . mysqli_error($con);
        } else {
            $err = "resultDelBlockIP query failed";
        }
    }
}
?>