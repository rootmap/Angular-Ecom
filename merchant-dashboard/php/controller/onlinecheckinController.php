<?php

require_once '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here

/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/* ./Data convert by jeson end here */

$tocken_oid = $data->tid;
$status = $data->status;
if(!empty($tocken_oid))
{
    $makesplited=  split("LL",$tocken_oid);
    //print_r($makesplited);
    $tockencre=$makesplited[0];
    //echo $tocken;
    $cleanNum = str_replace("SP", "-", str_replace("TL", "[", str_replace("TR", "]", $tockencre)));
    //echo $cleanNum;
    $oid=$cleanNum;

}
//echo $cleanNum;
//exit();
if ($status == "NONE") {
    $checktid = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `orders` WHERE `order_number`='" . $oid . "'"));
    if ($checktid == 0) {
        $chkmanualticket = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `manual_ticket` WHERE `ticket_id`='" . $tocken_oid . "'"));
        if ($chkmanualticket == 0) {
            echo 0;
        } else {

            $sqlgetpattern = mysqli_query($con, "SELECT pattern FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'");
            $rowpat = mysqli_fetch_array($sqlgetpattern);
            $pattern = $rowpat['pattern'];

            $chk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'"));
            if ($chk == 0) {
                echo 1;
                mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
            } else {
                $datasql = mysqli_query($con, "SELECT status FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "' ORDER BY id DESC LIMIT 1");
                $row = mysqli_fetch_array($datasql);
                $ex_status = $row['status'];

                if ($ex_status == "IN") {
                    echo 2;
                    mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='OUT'");
                } else {
                    echo 1;
                    mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
                }
            }

            
        }
    } else {
        $chk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'"));
        if ($chk == 0) {
            echo 1;
            mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
        } else {
            $datasql = mysqli_query($con, "SELECT status FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "' ORDER BY id DESC LIMIT 1");
            $row = mysqli_fetch_array($datasql);
            $ex_status = $row['status'];

            if ($ex_status == "IN") {
                echo 2;
                mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='OUT'");
            } else {
                echo 1;
                mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
            }
        }
        
    }
} else {
    //in or out
    $checktid = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `orders` WHERE `order_number`='" . $oid . "'"));
    if ($checktid == 0) {
        $chkmanualticket = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `manual_ticket` WHERE `ticket_id`='" . $tocken_oid . "'"));
        if ($chkmanualticket == 0) {
            echo 0;
        } else {

            $sqlgetpattern = mysqli_query($con, "SELECT pattern FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'");
            $rowpat = mysqli_fetch_array($sqlgetpattern);
            $oid = $rowpat['pattern'];

            $chk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'"));
            if ($chk == 0) {
                if ($status == "IN") {
                    mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
                    echo 1;
                } else {
                    echo 4; //Not Checkin In System 
                }
            } else {
                $datasql = mysqli_query($con, "SELECT status FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "' ORDER BY id DESC LIMIT 1");
                $row = mysqli_fetch_array($datasql);
                $ex_status = $row['status'];
                if ($status == "OUT") {
                    if ($ex_status == "IN") {
                        mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='OUT'");

                        echo 2;
                    } else {
                        echo 3; // Not CheckIN in System
                    }
                } elseif ($status == "IN") {
                    if ($ex_status == "OUT") {
                        mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");

                        echo 1;
                    } else {
                        echo 4; // Invalid Ticket
                    }
                } else {
                    if ($ex_status == "IN") {
                        mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='OUT'");
                        echo 2;
                    } else {
                        echo 1;
                        mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
                    }
                }
            }
        }
    } else {
        $chk = mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "'"));
        if ($chk == 0) {
            if ($status == "IN") {
                mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
            
                echo 1;
            }
            else
            {
                echo 3;//not checkin
            }
        } else {
            $datasql = mysqli_query($con, "SELECT status FROM checkininout WHERE `ticket_id`='" . $tocken_oid . "' ORDER BY id DESC LIMIT 1");
            $row = mysqli_fetch_array($datasql);
            $ex_status = $row['status'];


            if ($ex_status == "IN") {
                if ($status == "OUT") {
                    mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='OUT'");

                    echo 2;
                } else {
                    echo 3; //not checkin system
                }
            } else {
                if ($status == "IN") {
                    mysqli_query($con, "INSERT INTO checkininout SET `ticket_id`='" . $tocken_oid . "',`pattern`='" . $oid . "',`datetime`='" . date('Y-m-d') . "',status='IN'");
                    echo 1;
                } else {
                    echo 4; //NO Checkin
                }
            }
        }

    }
    //in or out
}