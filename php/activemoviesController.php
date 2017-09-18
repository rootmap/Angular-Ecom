<?php

include'../DBconnection/database_connections.php';


// Movie Event Start

if(isset($_GET['active']))
{
    $arrayMovie = array();
    $sqlMovie = "SELECT a.name as mov_name,a.movie_id
    FROM event_movie_list as a 
    LEFT JOIN `events` as b
    on b.event_id=a.event_id 
    WHERE a.status='1'
    GROUP BY a.movie_id  DESC";

    $resultMovie = mysqli_query($con, $sqlMovie);
    $chkresultMovie = mysqli_num_rows($resultMovie);
//$arrayMovie
    if ($chkresultMovie > 0) {
        if ($resultMovie) {
            while ($resultMoviedObj = mysqli_fetch_object($resultMovie)) {
                $arrayMovie[] = $resultMoviedObj;
            }
        } else {
            if (true) {
                $err = "resultMovie error: " . mysqli_error($con);
            } else {
                $err = "resultMovie query failed.";
            }
        }
    }


// echo "<pre>";
// echo var_dump($arrayFeatured);
//echo json_encode(utf8_encode_all($arrayMovie));
    if(!empty($arrayMovie))
    {
       echo json_encode($arrayMovie); 
   }
   else
   {
    echo json_encode(array(""));
}
}
elseif(isset($_GET['mid']))
{
    $availableDate=[];
    $todayCleanDate=date('Y/m/d');
    for($i=0; $i<=6; $i++){
        $dateLoop=date('Y-m-d',strtotime($todayCleanDate . "+".$i." days"));
        $dateHtmlLoop=date('D jS F Y',strtotime($todayCleanDate . "+".$i." days"));
        $availableDate[]=array("valop"=>$dateLoop,"valht"=>$dateHtmlLoop);
    }

    echo json_encode($availableDate);

}
elseif(isset($_GET['vid']) && isset($_GET['vd']))
{
    extract($_GET);
    if(!empty($vid) && !empty($vd))
    {

        include "../admin/event/blockbuster_api_class/GenerateSecretKey.php";
        $obj = new configtoapi();
        $api = new XmlToJson();

        @$theatrequery = $api->getShowTime($vid, $vd);
        //echo "<pre>";
        //echo print_r($theatrequery);
        //exit();

        /*function CheckShowTimeExists($sunrise) {
            $current_time = date('h:i a');
            $date1 = DateTime::createFromFormat('H:i a', $current_time);
            $date2 = DateTime::createFromFormat('H:i a', $sunrise);
            if ($date1 < $date2) {
                return 1;
            }
        }
*/
        $availableSlot=[];
        
        

        if(!empty($theatrequery->MovieSchedule))
        {
            //print_r($theatrequery->MovieSchedule);
            if(isset($theatrequery->MovieSchedule->TotalShow) && !empty($theatrequery->MovieSchedule->TotalShow))
            {
                $totalshow=$theatrequery->MovieSchedule->TotalShow;
                for($i=1; $i<=9; $i++):
                    $dd='Show_0'.$i;
                    if(isset($theatrequery->MovieSchedule->$dd))
                    {
                        if($theatrequery->MovieSchedule->$dd!="No-Show")
                        {
                            $availableSlot[]=array(
                                "slotval"=>$theatrequery->MovieSchedule->DTMID.",".$theatrequery->MovieSchedule->$dd.",".$dd.",".$theatrequery->MovieSchedule->TheatreName,
                                "slot"=>"Hall - ".$theatrequery->MovieSchedule->TheatreName." - ".$theatrequery->MovieSchedule->$dd
                                );
                        }
                    }
                    
                    //echo $theatrequery->MovieSchedule->$dd;

                    //$availableSlot[]=array("slotval"=>"Invalid","slot"=>"No Schedule Found");
                    //$showArray[]=array("");
                    //print_r($availableSlot);
                endfor;    
                //=array("TheatreName"=>$mov->TheatreName,"Show");  
            }
            /*else
            {
                foreach ($theatrequery->MovieSchedule as $mov) {
                    
                    $availableSlot[]=array("TheatreName"=>$mov->TheatreName);  
                }
            }*/
            
        }
        else
        {
            $availableSlot[]=array("slotval"=>"Invalid","slot"=>"No Schedule Found");
        }



        //echo "Fly with Code - Debug";
        echo json_encode($availableSlot);
    }
}
elseif(isset($_GET['MovieDetail']))
{
    $dd='';
    if(!empty($_GET['MovieDetail']))
    {
        $sqlgetMovie=mysqli_query($con,"SELECT 
        eml.id,
        eml.event_id,
        eml.movie_id,
        eml.name,
        DATE_FORMAT(eml.releasedate,'%D %M %Y') as startdate,
        eml.movietype,
        e.event_web_banner,
        e.event_web_logo
        FROM `event_movie_list` as eml
        LEFT JOIN events as e on eml.event_id=e.event_id
        WHERE eml.movie_id='".$_GET['MovieDetail']."'");

        if(mysqli_num_rows($sqlgetMovie)!=0)
        {
            $dd=mysqli_fetch_array($sqlgetMovie);

            //echo $dd['movie_id'];
        }
    }
    echo json_encode($dd);
}
else
{


    echo "Stuck on Your Hand";
}

//echo json_encode(utf8_encode_all($arrayUpcoming));
?>