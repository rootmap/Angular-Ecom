<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $Eventsql = "select event_id,movie_id from event_movie_list where event_id = '$event_id'";
    $run_sql = mysqli_query($con, $Eventsql);
    if ($run_sql) {
        while ($row = mysqli_fetch_array($run_sql)) {
            $movie_id = $row['movie_id'];
        }
    } else {
        if (DEBUG) {
            $err = "Eventsql error: " . mysqli_error($con);
        } else {
            $err = "Eventsql query failed.";
        }
    }
}

//echo $movie_id;

if(!empty($movie_id))
{
    include '../event/blockbuster_api_class/GenerateSecretKey.php';
    $secure = new GenerateKeySecret();
    $xmljson = new XmlToJson();
    $obj = new configtoapi();
    //echo "<pre>";
    $current_index = 0;
    $st = 0;
    $request_date=date('Y-m-d');
    //$movie_id='00127';
    @$newarray = $xmljson->getShowTime($movie_id,$request_date);
    //echo $newarray;
    for($i=1; $i<=5; $i++)
        if($newarray['Show_0'.$i]!='No-Show')
        {
            $dg="";
            $dg .="movie_id='".$movie_id."'";
            $dg .=" AND name='Show_0".$i."'";
            $dg .=" AND show_time='".$newarray['Show_0'.$i]."'";
            $chksh=$obj->FlyQuery("SELECT * FROM event_movie_show_time WHERE ".$dg,"2");
            if($chksh==0)
            {
                $dgs="";
                $dgs .="movie_id='".$movie_id."'";
                $dgs .=",DTMID='".$newarray['DTMID']."'";
                $dgs .=",name='Show_0".$i."'";
                $dgs .=",show_time='".$newarray['Show_0'.$i]."'";
                $dgs .=",date='".date('Y-m-d')."'";
                $dgs .=",status='1'";
                $obj->FlyQuery("INSERT INTO event_movie_show_time SET ".$dgs,"3");
            }
            else
            {
                $dgs="";
                $dgs .="show_time='".$newarray['Show_0'.$i]."'";
                $dgs .=",DTMID='".$newarray['DTMID']."'";
                $dgs .=",date='".date('Y-m-d')."'";
                $dgs .=",status='1'";
                $obj->FlyQuery("UPDATE event_movie_show_time SET ".$dgs." WHERE movie_id='".$movie_id."' AND name='Show_0".$i."'","3");
            }
        }

    $msg = "Show Time Successfully Updated.";
    $link = "show_time_list.php?msg=" . base64_encode($msg) . "&" . $_SERVER['QUERY_STRING'];
    redirect($link);
    
}
else
{
    $msg = "Invalid Movie ID Info.";
    $link = "show_time_list.php?err=" . base64_encode($msg) . "&" . $_SERVER['QUERY_STRING'];
    redirect($link);
}


exit();
