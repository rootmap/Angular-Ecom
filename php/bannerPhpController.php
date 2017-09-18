<?php 
include'.././DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

//if($con == true){
//    echo '1';
//}else{
//    echo '0';
//}

 $cid = $data->categoryId;

$f = str_replace(';','',$cid);

$dataStore1 = array();



if ($cid !='') {
//   echo $f . '<br/>';
//    exit();
// $sql1 = "SELECT 
//e.`event_id`,
//e.`event_web_banner`,
//e.`event_category_id`,
//e.`event_title`,
//e.`event_web_logo`,
//e.`event_is_featured`,
//e.`event_status`,
//
//ev.`venue_id`,
//ev.`venue_event_id`,
//ev.`venue_title`,
//ev.`venue_valid_from`,
//ev.`venue_valid_till`,
//ev.`venue_start_date`,
//ev.`venue_end_date`, 
//ev.`venue_start_time`, 
//ev.`venue_end_time`, 
//ev.`venue_status`,
//
//ett.`TT_id`,
//ett.`TT_venue_id`,
//ett.`TT_type_title`
//FROM events AS e 
//LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
//LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 
//
//WHERE e.`event_category_id` = '$cid' AND ((e.`event_is_featured` = 'yes ' 
//AND e.`event_status` = 'active') OR  e.`event_status` = 'info')
//AND ev.`venue_status` = 'active' GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
 
 
 
 $sql1 = "
SELECT 
e.`event_id`,

CASE e.`event_web_banner`
WHEN '' THEN 'defaultImg.jpg'
ELSE e.`event_web_banner`
END AS banner,

e.`event_category_id`,
e.`event_title`,
e.`event_is_featured`,
e.`event_status`,
e.`event_created_on`


FROM events AS e

WHERE (e.`event_category_id` = '$f' OR e.`event_category_id` like '%,$f,%' OR e.`event_category_id` like '$f,%' OR e.`event_category_id` like '%,$f') 
AND e.`event_is_featured` = 'yes ' 
AND (e.`event_status` = 'active' OR  e.`event_status` = 'info')
GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
//                        print_r($sql1);
//                        exit();
                        

//    $sql1 = "
//SELECT 
//e.`event_id`,
//e.`event_web_banner`,l
//e.`event_category_id`,
//e.`event_title`,
//e.`event_is_featured`,
//e.`event_status`,
//e.`event_created_on`
//
//
//FROM events AS e
//
//WHERE e.`event_category_id` = '$cid' AND e.`event_is_featured` = 'yes ' 
//AND (e.`event_status` = 'active' OR  e.`event_status` = 'info')
//GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
    
// SELECT 
//          e.`event_id`,
//          e.`event_web_banner`,
//          e.`event_category_id`,
//          e.`event_title`,
//          e.`event_web_logo`,
//          e.`event_is_featured`,
//          e.`event_status` 
//          FROM events AS e 
//          WHERE e.`event_category_id` = '$cid' AND 
//          e.`event_is_featured` = 'yes'  AND 
//          (e.`event_status` = 'active' OR e.`event_status` = 'info')
//          GROUP BY e.`event_id` ORDER BY e.`event_created_on` DESC
 

                        $result1=mysqli_query($con,$sql1);
//                        print_r($result1);
//                        exit();
                        
                        $checkresult1 = mysqli_num_rows($result1);
                        
//                        print_r($checkresult1);
//                        exit();
                        if($checkresult1 > 0){
//                            echo '0';
                            while($resultobj=mysqli_fetch_object($result1)){
                             $dataStore1[] = $resultobj;
                            }
                        }else {
//                            echo '1';
                            if (true) {
                                $err = "resultFeatured error: " . mysqli_error($con);
                            } else {
                                $err = "resultFeatured query failed.";
                            }
                        }
}


echo json_encode($dataStore1);


?>

