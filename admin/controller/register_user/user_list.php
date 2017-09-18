<?php

include '../../../config/config.php';
$eventId = 0;
header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $eventId = $_GET['event_id'];
    $arrUserList = array();
    $userListSql = "SELECT event_form_values.*, users.* FROM event_form_values "
            . "INNER JOIN users ON event_form_values.EFV_user_id = users.user_id "
            . "WHERE event_form_values.EFV_event_id = $eventId";
    $resultuserList = mysqli_query($con, $userListSql);

    if ($resultuserList) {
        while ($objCount = mysqli_fetch_object($resultuserList)) {
            $arrUserList[] = $objCount;
        }
    } else {
        if (DEBUG) {
            $err = "resultuserList error: " . mysqli_error($con);
        } else {
            $err = "resultuserList query failed";
        }
    }


    echo "{\"data\":" . json_encode($arrUserList) . "}";
}
?>