<?php

include '../../DBconnection/auth.php';
//START HERE 
//session_start();
$sessionId = session_id();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here



$data = json_decode(file_get_contents("php://input"));

$delEventButton=$data->e_id;
$event = $data->event_id;
$button = $data->buttonValue;

if (!empty($event) && !empty($button)) {
    $sqlchk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM event_button_list WHERE event_id='$event'"));
    if ($sqlchk == 0) {
        $sql = "INSERT INTO event_button_list SET event_id='$event',button_id='$button'";
        $result = mysqli_query($con, $sql);

        if ($result == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    else
    {
        $sql = "UPDATE event_button_list SET button_id='$button' WHERE event_id='$event'";
        $result = mysqli_query($con, $sql);

        if ($result == 1) {
            echo 2;
        } else {
            echo 0;
        }
    }
} else {
    echo 3;
}

if (!empty($delEventButton)) {
    $sqDel = "DELETE FROM `event_button_list` WHERE `event_id`='$delEventButton'";
        $result = mysqli_query($con, $sqDel);
}