<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayCountry = array();
    $get_sql = "SELECT * FROM countries ORDER BY country_id DESC";
    $resultCountry = mysqli_query($con, $get_sql);
    if ($resultCountry) {
        while ($obj = mysqli_fetch_object($resultCountry)) {
            $arrayCountry[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultCountry error: " . mysqli_error($con);
        } else {
            $err = "resultCountry query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayCountry) . "}";
}

if ($verb == "POST") {

    $country_id = mysqli_real_escape_string($con, $_POST["country_id"]);
    $country_name = mysqli_real_escape_string($con, $_POST["country_name"]);
    $country_status = mysqli_real_escape_string($con, $_POST["country_status"]);
    $country_updated_by = getSession("admin_id");


    $update_query = '';
    $update_query .=' country_name = "' . $country_name . '"';
    $update_query .=', country_status ="' . $country_status . '"';
    $update_query .=', country_updated_by ="' . $country_updated_by . '"';

    $run_update_query = "UPDATE countries SET $update_query WHERE country_id = $country_id";

    $resultUpdateCountry = mysqli_query($con, $run_update_query);

    if ($resultUpdateCountry) {
        echo json_encode($resultUpdateCountry);
    } else {
        if (DEBUG) {
            $err = "resultUpdateCountry error: " . mysqli_error($con);
        } else {
            $err = "resultUpdateCountry query failed for Country ID ".$country_id;
        }
    }
}

if ($verb == "PUT") {
    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $country_name = mysqli_real_escape_string($con, $request_vars["country_name"]);
    $country_status = mysqli_real_escape_string($con, $request_vars["country_status"]);

    $insert_query = '';
    $insert_query .=' country_name = "' . $country_name . '"';
    $insert_query .=', country_status ="' . $country_status . '"';


    $run_insert_query = "INSERT INTO countries SET $insert_query";
    $resultInsertCountry = mysqli_query($con, $run_insert_query);

    if ($resultInsertCountry) {
        $country_id = mysqli_insert_id($con);
        echo "" . $country_id . "";
    } else {
        if (DEBUG) {
            $err = "resultInsertCountry error: " . mysqli_error($con);
        } else {
            $err = "resultInsertCountry query failed";
        }
    }
}

if ($verb == "DELETE") {

    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $country_id = mysqli_real_escape_string($con, $request_vars["country_id"]);

    $delete_sql = "DELETE FROM countries WHERE country_id = '" . $country_id . "'";

    $resultDeleteCountry = mysqli_query($con, $delete_sql);

    if ($resultDeleteCountry) {
        echo json_encode($resultDeleteCountry);
    } else {
        if (DEBUG) {
            $err = "resultDeleteCountry error: " . mysqli_error($con);
        } else {
            $err = "resultDeleteCountry query failed";
        }
    }
}
?>