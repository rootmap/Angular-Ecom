

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//static date formate show start here.
//$date=date_create("2017-01-17");
//echo date_format($date,"Y/m/d"); 
//static date formate show end here.
//
//$now=new DateTime();
//echo $now->format('Y-m-d  H:i:s');//mysql dateTime fromat.
//echo $now->getTimestamp(); //unix timeStamp

//Today Date show start here
//$today= date('Y-m-d');
//echo $today ."<br/>" ."<br/>";
//Today Date show end here


// Yesteday start  day
//$previous=strtotime("-1 day");
//echo date("Y-m-d", $previous) . "<br>"."<br>";
//Yesteday  end day

//last previous start  day
//$previous=strtotime("-7 day");
//echo date("Y-m-d", $previous) . "<br>";
//last previous end day



//$today="SELECT a.*,e.event_title FROM `event_visit_page` as a
//INNER JOIN `events` as e ON a.event_id=e.event_id 
//WHERE DATE_FORMAT(date,'%Y-%m-%d')='2016-12-06' AND e.event_created_by='86'";
//$today=date('Y-m-d');
//$previousDay=strttotime("-30day");
//
//if($today=0; $today<=-7; $today--){
// echo $previousDay;
//}




//$today = strtotime(date('Y-m-d'));
//////Total previous Date show Start here
//for ($i =5; $i>=0; $i--) {
//   
//    $month = date("M", strtotime("-".$i." month ", $today));
//    $year = date("Y", strtotime("-".$i." month ", $today));
//   
//   $formatmonth=date("Y-m-d", strtotime("-".$i." month ", $today));
//   $month_last_date = date("Y-m-t", strtotime($formatmonth));
//    $d = new DateTime($formatmonth); 
//    $month_last_date=$d->format('Y-m-t');
//    $month_first_date=$d->format('Y-m-01');
//    echo $month."-".$year."-:-".$month_first_date.":-:".$month_last_date."<br>";
//}
//$sql="SELECT 
//e.event_id,
//e.event_title,
//count(e.event_id) as `pageviewes`
//
//FROM `event_visit_page` as evp
//INNER JOIN `events` as e ON e.event_id=evp.event_id
//
//WHERE e.event_created_by='83' AND DATE_FORMAT(date,'%Y-%m-%d')='$final'
//GROUP BY DATE_FORMAT(date,'%Y-%m-%d')";
    
    
//}

//page viewed by source

for ($i = 6; $i >=0; $i--) {
 $today = strtotime(date('Y-m-d'));
 $final = date("Y-m-d", strtotime("-".$i." day", $today))."<br>";
  
$sql="SELECT 
e.event_id,
e.event_title,
count(e.event_id) as `pageviewes`

FROM `event_visit_page` as evp
INNER JOIN `events` as e ON e.event_id=evp.event_id

WHERE e.event_created_by='83' AND DATE_FORMAT(date,'%Y-%m-%d')='$final'
GROUP BY e.event_id";
    
    
}

//Total previous Date show End here





//SELECT 
//
//e.`event_id`,
//e.`event_title`,
//DATE_FORMAT(o.order_created,'%Y-%m-%d') AS order_created,
//e.event_created_by,
//sum(`order_total_amount`) as `total_sales`
//FROM  `events` as e 
//INNER JOIN `orders` as o ON o.order_id=e.event_id
//WHERE (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2015-08-29' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='2017-01-20') AND e.event_created_by='83'

//SELECT 
//                        e.`event_id`,
//                        e.`event_title`,
//                        DATE_FORMAT(o.order_created,'%Y-%m-%d') AS order_created,
//                        e.event_created_by,
//                        sum(`order_total_amount`) as `total_sales`
//                        FROM  `events` as e 
//                        INNER JOIN `orders` as o ON o.order_id=e.event_id
//                        WHERE (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2016-06-01' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='2016-06-30') AND e.event_created_by='83'                 
//   






                                    
                                    
                                 
                                
                                