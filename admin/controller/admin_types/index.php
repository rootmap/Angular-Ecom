<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayAdminType = array();
    $sqlAdminType = "SELECT * FROM admin_types ORDER BY AT_id DESC";
    $rerultAdminType = mysqli_query($con, $sqlAdminType);
    if ($rerultAdminType) {
        while ($objAdminType = mysqli_fetch_object($rerultAdminType)) {
            $arrayAdminType[] = $objAdminType;
        }
    } else {
        if (DEBUG) {
            $err = "rerultAdminType error: " . mysqli_error($con);
        } else {
            $err = "rerultAdminType query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayAdminType) . "}";
}

if ($verb == "POST") {

    $AT_id = mysqli_real_escape_string($con, $_POST["AT_id"]);
    $AT_type = mysqli_real_escape_string($con, $_POST["AT_type"]);
    $AT_details = mysqli_real_escape_string($con, $_POST["AT_details"]);
    $updated_by = getSession("admin_id");


    $update_query = '';
    $update_query .=' AT_type = "' . $AT_type . '"';
    $update_query .=', AT_details ="' . $AT_details . '"';
    $update_query .=', AT_updated_by ="' . $updated_by . '"';

    $run_update_query = "UPDATE admin_types SET $update_query WHERE AT_id = $AT_id";

    $resultUpdateQuery = mysqli_query($con, $run_update_query);

    if ($resultUpdateQuery) {
        echo json_encode($resultUpdateQuery);
    } else {
        if (DEBUG) {
            $err = "resultUpdateQuery error: " . mysqli_error($con);
        } else {
            $err = "resultUpdateQuery query failed for Admin Type ID: ". $AT_id;
        }
    }
}

if ($verb == "PUT") {
    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $AT_type = mysqli_real_escape_string($con, $request_vars["AT_type"]);
    $AT_details = mysqli_real_escape_string($con, $request_vars["AT_details"]);
    $created_date = date("Y-m-d H:i:s");
    $created_by = getSession("admin_id");

    $insert_query = '';
    $insert_query .=' AT_type = "' . $AT_type . '"';
    $insert_query .=', AT_details ="' . $AT_details . '"';
    $insert_query .=', AT_created_on ="' . $created_date . '"';
    $insert_query .=', AT_created_by ="' . $created_by . '"';

    $run_insert_query = "INSERT INTO admin_types SET $insert_query";
    $resultInsertQuery = mysqli_query($con, $run_insert_query);

    if ($resultInsertQuery) {
        $AT_id = mysqli_insert_id($con);
        echo "" . $AT_id . "";
    } else {
       if (DEBUG) {
            $err = "resultInsertQuery error: " . mysqli_error($con);
        } else {
            $err = "resultInsertQuery query failed";
        }
    }
}

if ($verb == "DELETE") {

    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $AT_id = mysqli_real_escape_string($con, $request_vars["AT_id"]);

    $delete_sql = "DELETE FROM admin_types WHERE AT_id = '" . $AT_id . "'";

    $resultDeleteQuery = mysqli_query($con, $delete_sql);

    if ($resultDeleteQuery) {
        echo json_encode($resultDeleteQuery);
    } else {
        if (DEBUG) {
            $err = "resultDeleteQuery error: " . mysqli_error($con);
        } else {
            $err = "resultDeleteQuery query failed";
        }
    }
}
?>