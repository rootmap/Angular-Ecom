<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $Eventsql = "select event_title from events where event_id = '$event_id'";
    $run_sql = mysqli_query($con, $Eventsql);
    if ($run_sql) {
        while ($row = mysqli_fetch_object($run_sql)) {
            $event_title = $row->event_title;
        }
    } else {
        if (DEBUG) {
            $err = "Eventsql error: " . mysqli_error($con);
        } else {
            $err = "Eventsql query failed.";
        }
    }
}

include '../event/blockbuster_api_class/GenerateSecretKey.php';
$secure = new GenerateKeySecret();
$xmljson = new XmlToJson();

//echo "<pre>";
$current_index = 0;
$st = 0;
$newarray = $xmljson->getTheatreName($current_index, 1);
//echo $newarray;

$msg = "Theatre Info successfully Updated ( '$newarray' )";
$link = "event_venue_list_blockbuster_api.php?msg=" . base64_encode($msg) . "&" . $_SERVER['QUERY_STRING'];
redirect($link);

exit();
