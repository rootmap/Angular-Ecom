<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $event_id = $_GET["event_id"];
    $arr = array();
    $get_sql = "SELECT event_faqs.EF_id,event_faqs.EF_event_id, event_faqs.EF_question, event_faqs.EF_answer, events.event_title,events.event_id FROM event_faqs LEFT JOIN events ON event_faqs.EF_event_id = events.event_id WHERE event_faqs.EF_event_id = $event_id ORDER BY event_faqs.EF_id DESC";
    $resultFaq = mysqli_query($con, $get_sql);
    if ($resultFaq) {
        while ($obj = mysqli_fetch_object($resultFaq)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "resultFaq error: " . mysqli_error($con);
        } else {
            $err = "resultFaq query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    $EF_id = mysqli_real_escape_string($con, $EF_id);
    $delete_sql = "DELETE FROM event_faqs WHERE EF_id = '" . $EF_id . "'";

    $resultDeleteFaq = mysqli_query($con, $delete_sql);

    if ($resultDeleteFaq) {
        echo json_encode($rs);
    } else {
        if (DEBUG) {
            $err = "resultDeleteFaq error: " . mysqli_error($con);
        } else {
            $err = "resultDeleteFaq query failed";
        }
    }
}
?>