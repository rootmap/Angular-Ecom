<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayForm = array();
    $sqlForm = "SELECT COUNT(form_id) AS TotalElements,events.event_title,events.event_id,"
            . "CASE form_type WHEN 'subs' THEN 'Subscription'"
            . " ELSE CASE form_type WHEN 'info' THEN 'User Info Form'"
            . " END END AS form_type "
            . " FROM event_dynamic_forms"
            . " LEFT JOIN events ON event_dynamic_forms.form_event_id = events.event_id"
            . " GROUP BY event_dynamic_forms.form_event_id"
            . " ORDER BY form_id DESC ";
    $resultForm = mysqli_query($con, $sqlForm);
    if ($resultForm) {
        while ($resultFormObj = mysqli_fetch_object($resultForm)) {
            $arrayForm[] = $resultFormObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultForm error: " . mysqli_error($con);
        } else {
            $err = "resultForm query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayForm) . "}";
}


if ($verb == "POST") {
    extract($_POST);
    $form_id = mysqli_real_escape_string($con, $form_id);
    
    $sqlDelFormData = "DELETE FROM event_dynamic_forms WHERE form_id = '" . $form_id . "'";
    $resultDelFormData = mysqli_query($con, $sqlDelFormData);

    if ($resultDelFormData) {
        echo json_encode($resultDelFormData);
    } else {
        if (DEBUG) {
            $err = "resultDelFormData error: " . mysqli_error($con);
        } else {
            $err = "resultDelFormData query failed";
        }
    }
}
?>