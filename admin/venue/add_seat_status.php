<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
extract($_GET);

include '../event/blockbuster_api_class/GenerateSecretKey.php';
$secure = new GenerateKeySecret();
$xmljson = new XmlToJson();
$obj = new configtoapi();
//echo "<pre>";
$current_index = 0;
$st = 0;
$newslot = substr($slot, 5, 7);
@$newarray = $xmljson->getShowTimeSeatStatus($dtmid, $newslot);
//echo "<pre>";
//echo var_dump($newarray);
//echo "</pre>";
//exit(); 


$chk = $obj->FlyQuery("SELECT * FROM event_movie_seat_status WHERE SLOT='" . $newarray['SLOT'] . "' AND TheatreID='" . $newarray['TheatreID'] . "' AND MovieID='" . $newarray['MovieID'] . "'", "2");
if ($chk == 0) {
    $ins = "";
    $ins .="DTMSID='" . $newarray['DTMSID'] . "'";
    $ins .=",DTMID='" . $newarray['DTMID'] . "'";
    $ins .=",SLOT='" . $newarray['SLOT'] . "'";
    $ins .=",TheatreID='" . $newarray['TheatreID'] . "'";
    $ins .=",MovieID='" . $newarray['MovieID'] . "'";
    $ins .=",RequestDate='" . $newarray['RequestDate'] . "'";
    $ins .=",ShowTime='" . $newarray['ShowTime'] . "'";
    $ins .=",SeatClass='" . $newarray['SeatClass'] . "'";
    $ins .=",SeatClassTicketPrice='" . $newarray['SeatClassTicketPrice'] . "'";
    $ins .=",Total_E_FRONT_Seat='" . $newarray['Total_E_FRONT_Seat'] . "'";
    $ins .=",Total_E_REAR_Seat='" . $newarray['Total_E_REAR_Seat'] . "'";
    $ins .=",date='" . date('Y-m-d') . "'";
    $ins .=",status='1'";

    $obj->FlyQuery("INSERT INTO event_movie_seat_status SET " . $ins, "3");
} else {
    $ins = "";
    $ins .="DTMSID='" . $newarray['DTMSID'] . "'";
    $ins .=",DTMID='" . $newarray['DTMID'] . "'";
    $ins .=",RequestDate='" . $newarray['RequestDate'] . "'";
    $ins .=",ShowTime='" . $newarray['ShowTime'] . "'";
    $ins .=",SeatClass='" . $newarray['SeatClass'] . "'";
    $ins .=",SeatClassTicketPrice='" . $newarray['SeatClassTicketPrice'] . "'";
    $ins .=",Total_E_FRONT_Seat='" . $newarray['Total_E_FRONT_Seat'] . "'";
    $ins .=",Total_E_REAR_Seat='" . $newarray['Total_E_REAR_Seat'] . "'";
    $ins .=",date='" . date('Y-m-d') . "'";
    $ins .=",status='1'";

    $obj->FlyQuery("UPDATE event_movie_seat_status SET " . $ins." WHERE SLOT='" . $newarray['SLOT'] . "' AND TheatreID='" . $newarray['TheatreID'] . "' AND MovieID='" . $newarray['MovieID'] . "'", "3");
}
$msg = "Seat Status Successfully Updated.";
$link = "show_time_list.php?msg=" . base64_encode($msg) . "&" . $_SERVER['QUERY_STRING'];
redirect($link);




exit();
