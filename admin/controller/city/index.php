<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayCity = array();
    $sqlCity = "SELECT cities.*, countries.* FROM cities LEFT JOIN countries ON cities.country_id = countries.country_id ORDER BY city_id DESC";
    $resultCity = mysqli_query($con, $sqlCity);
    if ($resultCity) {
        while ($objCity = mysqli_fetch_object($resultCity)) {
            $arrayCity[] = $objCity;
        }
    } else {
        if (DEBUG) {
            $err = "resultCity error: " . mysqli_error($con);
        } else {
            $err = "resultCity query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayCity) . "}";
}


if ($verb == "POST") {

    $city_id = mysqli_real_escape_string($con, $_POST["city_id"]);
    $country_id = mysqli_real_escape_string($con, $_POST["country_id"]);
    $city_name = mysqli_real_escape_string($con, $_POST["city_name"]);
    $city_delivery_charge = mysqli_real_escape_string($con, $_POST["city_delivery_charge"]);
    $city_status = mysqli_real_escape_string($con, $_POST["city_status"]);
    $city_updated_by = getSession("admin_id");


    $update_query = '';
    $update_query .=' country_id = "' . $country_id . '"';
    $update_query .=', city_name ="' . $city_name . '"';
    $update_query .=', city_delivery_charge ="' . $city_delivery_charge . '"';
    $update_query .=', city_status ="' . $city_status . '"';
    $update_query .=', city_updated_by ="' . $city_updated_by . '"';

    $run_update_query = "UPDATE cities SET $update_query WHERE city_id = $city_id";

    $resultUpdateCity = mysqli_query($con, $run_update_query);

    if ($resultUpdateCity) {
        echo json_encode($resultUpdateCity);
    } else {
        if (DEBUG) {
            $err = "resultUpdateCity error: " . mysqli_error($con);
        } else {
            $err = "resultUpdateCity query failed for City ID: " . $city_id;
        }
    }
}

if ($verb == "PUT") {
    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $country_id = mysqli_real_escape_string($con, $request_vars["country_id"]);
    $city_name = mysqli_real_escape_string($con, $request_vars["city_name"]);
    $city_delivery_charge = mysqli_real_escape_string($con, $request_vars["city_delivery_charge"]);
    $city_status = mysqli_real_escape_string($con, $request_vars["city_status"]);

    $insert_query = '';
    $insert_query .=' country_id = "' . $country_id . '"';
    $insert_query .=', city_name = "' . $city_name . '"';
    $insert_query .=', city_delivery_charge = "' . $city_delivery_charge . '"';
    $insert_query .=', city_status ="' . $city_status . '"';


    $run_insert_query = "INSERT INTO cities SET $insert_query";

    $resultInsertCity = mysqli_query($con, $run_insert_query);

    if ($resultInsertCity) {
        $city_id = mysqli_insert_id($con);
        echo "" . $city_id . "";
    } else {
        if (DEBUG) {
            $err = "resultInsertCity error: " . mysqli_error($con);
        } else {
            $err = "resultInsertCity query failed.";
        }
    }
}


if ($verb == "DELETE") {

    $request_vars = Array();
    parse_str(file_get_contents('php://input'), $request_vars);

    $city_id = mysqli_real_escape_string($con, $request_vars["city_id"]);

    $delete_sql = "DELETE FROM cities WHERE city_id = '" . $city_id . "'";

    $resultDeleteCity = mysqli_query($con, $delete_sql);

    if ($resultDeleteCity) {
        echo json_encode($resultDeleteCity);
    } else {
        if (DEBUG) {
            $err = "resultDeleteCity error: " . mysqli_error($con);
        } else {
            $err = "resultDeleteCity query failed.";
        }
    }
}
?>