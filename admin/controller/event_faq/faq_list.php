<?php

include '../../../config/config.php';
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arr = array();
    $get_sql = "SELECT event_faqs.EF_id,event_faqs.EF_event_id, event_faqs.EF_question, event_faqs.EF_answer, events.event_title,events.event_id FROM event_faqs LEFT JOIN events ON event_faqs.EF_event_id = events.event_id ORDER BY event_faqs.EF_id DESC";
    $rsFaq = mysqli_query($con, $get_sql);

    if ($rsFaq) {
        while ($obj = mysqli_fetch_object($rsFaq)) {
            $arr[] = $obj;
        }
    } else {
        if (DEBUG) {
            $err = "rsFaq error: " . mysqli_error($con);
        } else {
            $err = "rsFaq query failed";
        }
    }
    echo "{\"data\":" . json_encode($arr) . "}";
}


if ($verb == "POST") {

    extract($_POST);
    $EF_id = mysqli_real_escape_string($con, $EF_id);
    $delete_sql = "DELETE FROM event_faqs WHERE EF_id = '" . $EF_id . "'";

    $rsDelFaq = mysqli_query($con, $delete_sql);

    if ($rsDelFaq) {
        echo json_encode($rsDelFaq);
    } else {
        if (DEBUG) {
            $err = "rsDelFaq error: " . mysqli_error($con);
        } else {
            $err = "rsDelFaq query failed";
        }
    }
}
?>