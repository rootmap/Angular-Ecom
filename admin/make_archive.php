<?php

include '../config/config.php';
$eventID = 0;
if (isset($_GET['id'])) {
    $eventID = $_GET['id'];
}

$sqlArchived = "UPDATE events SET event_status = 'archived' WHERE event_id = $eventID";
$resultArchived = mysqli_query($con, $sqlArchived);
if ($resultArchived) {
    $msg = "Event archived successfully";
    $link = "dashboard.php?msg=" . base64_encode($msg);
    redirect($link);
} else {
    if (DEBUG) {
        echo "resultArchived error: " . mysqli_error($con);
    } else {
        echo "resultArchived query failed ";
    }
}
?>