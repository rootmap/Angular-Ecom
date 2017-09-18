<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") 
{
    if(isset($_GET['event_id']))
    {
        $arrayOrderList = array();
        $sql = "SELECT a.*,b.event_title FROM event_pick_point as a LEFT JOIN events as b on b.event_id=a.event_id WHERE a.event_id='".clean($_GET['event_id'])."'";
        $resultOrderList = mysqli_query($con, $sql);
        if ($resultOrderList) {
            while ($obj = mysqli_fetch_object($resultOrderList)) {
                $arrayOrderList[] = $obj;
            }
        } else {
            if (DEBUG) {
                $err = "Event Pick Point error: " . mysqli_error($con);
            } else {
                $err = "Event Pick Point query failed";
            }
        }
    }
    else 
    {
        $arrayOrderList = array();
        $sql = "SELECT a.*,b.event_title FROM event_pick_point as a LEFT JOIN events as b on b.event_id=a.event_id";
        $resultOrderList = mysqli_query($con, $sql);
        if ($resultOrderList) {
            while ($obj = mysqli_fetch_object($resultOrderList)) {
                $arrayOrderList[] = $obj;
            }
        } else {
            if (DEBUG) {
                $err = "Event Pick Point error: " . mysqli_error($con);
            } else {
                $err = "Event Pick Point query failed";
            }
        }
    }
    echo "{\"data\":" . json_encode($arrayOrderList) . "}";
    
}


if ($verb == "POST") {

    extract($_POST);
    $id = mysqli_real_escape_string($con, $id);
    $delete_sql = "DELETE FROM event_pick_point WHERE id = '".$id."'";
    $resultDelete = mysqli_query($con, $delete_sql);
    
    if ($resultDelete) {
        echo 1;
    } else {
        if (DEBUG) {
            $err = "resultDelete error: " . mysqli_error($con);
        } else {
            $err = "resultDelete query failed";
        }
    }
}
?>