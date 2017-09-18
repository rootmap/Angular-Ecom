<?php

include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

//@$id1 = $data->cID;
@$location = $data->location;
//echo $id1;
//@$id2 = $data->catId;
@$category = $data->category;


// This query work for event page banner and other image and for featured events. 
$dataStore1 = array();


if ($location != null && $category == null) {
   
    if($location == 'allCit'){
       
//        [ For all location query start ]
        
        $sql1 = "SELECT 
        ebl.button_id,
        IFNULL(eb.name, 'BUY TICKET') AS btn_name,

        e.`event_id`,
        e.`event_web_banner`,
        e.`event_category_id`,
        e.`event_title`,
        e.`event_created_on`,

        CASE e.event_web_logo 
            WHEN '' THEN 'event_default_web_logo.jpg'
            ELSE e.event_web_logo
        END AS event_web_logo,
        e.`event_is_featured`,
        e.`event_status`,

        CASE ev.`city`
        WHEN '' THEN 'City not found'
        ELSE ev.`city`
        END AS city_from,
        ev.`city`,

        ev.`venue_id`,
        ev.`venue_event_id`,
        ev.`venue_title`,
        ev.`venue_valid_from`,
        ev.`venue_valid_till`,


        DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
        TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
        DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
        TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

        ev.`venue_status`,

        ett.`TT_id`,
        ett.`TT_venue_id`,
        ett.`TT_type_title`

        FROM events AS e 

        LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
        LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
        LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
        LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

        WHERE (e.event_status = 'active' OR e.event_status = 'upcoming') 
              AND   (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
              GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
//        AND ev.`venue_status` = 'active'
        
       //        [ For all location query end ]
    }else{
    
//        [ For selected location query start ]
        
    $sql1 = "SELECT 
        ebl.button_id,
        IFNULL(eb.name, 'BUY TICKET') AS btn_name,

        e.`event_id`,
        e.`event_web_banner`,
        e.`event_category_id`,
        e.`event_title`,
        e.`event_created_on`,

        CASE e.event_web_logo 
            WHEN '' THEN 'event_default_web_logo.jpg'
            ELSE e.event_web_logo
        END AS event_web_logo,
        e.`event_is_featured`,
        e.`event_status`,

        CASE ev.`city`
        WHEN '' THEN 'City not found'
        ELSE ev.`city`
        END AS city_from,
        ev.`city`,

        ev.`venue_id`,
        ev.`venue_event_id`,
        ev.`venue_title`,
        ev.`venue_valid_from`,
        ev.`venue_valid_till`,


        DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
        TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
        DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
        TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

        ev.`venue_status`,

        ett.`TT_id`,
        ett.`TT_venue_id`,
        ett.`TT_type_title`

        FROM events AS e 

        LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
        LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
        LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
        LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

        WHERE  (e.`city_from` = '$location' OR ev.`city` = '$location')
        AND (e.event_status = 'active' OR e.event_status = 'upcoming') 
        AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes') 
        
        GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
//       AND ev.`venue_status` = 'active'
      
 //        [ For selected location query end ]
    
    }
    
//    echo "<br/>$location<br/>";
    
} else if ($location == null && $category != null) {
    
    if($category == 'allCat'){
        
        //        [ For all category query start ]
        
        $sql1 = "SELECT 
            ebl.button_id,
            IFNULL(eb.name, 'BUY TICKET') AS btn_name,

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

            WHERE  (e.event_status = 'active' OR e.event_status = 'upcoming') 
               AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
         //        [ For all category query end ]
    } else{
        
        //        [ For selected category query start ]
        
    $sql1 = "SELECT 
            ebl.button_id,
            IFNULL(eb.name, 'BUY TICKET') AS btn_name, 

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 
  
            WHERE (e.`event_category_id` = '$category' OR e.`event_category_id` like '%,$category,%' OR e.`event_category_id` like '$category,%' OR e.`event_category_id` like '%,$category')  
            (e.event_status = 'active' OR e.event_status = 'upcoming') 
        AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes') 
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
    
            //        [ For selected category query end ]

    }
//    echo "<br/>$category<br/>";
} else if($location != null && $category != null) {
    
    if($location == 'allCit' && $category == 'allCat') {
      //        [ For all location and category query start ]

        $sql1 = "SELECT 
            ebl.button_id,
            IFNULL(eb.name, 'BUY TICKET') AS btn_name, 

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 

            WHERE   (e.event_status = 'active' OR e.event_status = 'upcoming') 
                    AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
                    
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
        
//            AND ev.`venue_status` = 'active' 
        
              //        [ For all location and category query end ]

    }else if($location == 'allCit' && $category != null ){
        //        [ For all location and selected category query start ]

    $sql1 = "SELECT 
            ebl.button_id,
            IFNULL(eb.name, 'BUY TICKET') AS btn_name, 

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 
  
            WHERE (e.`event_category_id` = '$category' OR e.`event_category_id` like '%,$category,%' OR e.`event_category_id` like '$category,%' OR e.`event_category_id` like '%,$category')  
                  AND (e.event_status = 'active' OR e.event_status = 'upcoming') 
                  AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
                    
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
    
    
              //        [ For all location and selected category query end ]

    } else if($location != null  && $category == 'allCat'){
        
         //        [ For selected location and all category query start ]

    $sql1 = "SELECT 
            ebl.button_id,
            IFNULL(eb.name, 'BUY TICKET') AS btn_name, 

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 
  
            WHERE   (e.`city_from` = '$location' OR ev.`city` = '$location') 
                    AND (e.event_status = 'active' OR e.event_status = 'upcoming') 
                    AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
                    
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
    
    
               //        [ For selected location and all category query end ]
        
    }else{
          //        [ For selected location and category query start ]

    $sql1 = "SELECT 
            ebl.button_id,
            ISNULL(eb.name,'BUY TICKET')AS btn_name,

            e.`event_id`,
            e.`event_web_banner`,
            e.`event_category_id`,
            e.`event_title`,
            e.`event_created_on`,
            

            CASE e.event_web_logo 
                WHEN '' THEN 'event_default_web_logo.jpg'
                ELSE e.event_web_logo
            END AS event_web_logo,
            e.`event_is_featured`,
            e.`event_status`,

            CASE ev.`city`
            WHEN '' THEN 'City not found'
            ELSE ev.`city`
            END AS city_from,
            ev.`city`,

            ev.`venue_id`,
            ev.`venue_event_id`,
            ev.`venue_title`,
            ev.`venue_valid_from`,
            ev.`venue_valid_till`,


            DATE_FORMAT(ev.`venue_start_date`,'%d %b %y') AS venue_start_date, 
            TIME_FORMAT(ev.`venue_start_time`, '%h:%i%p') AS venue_start_time,
            DATE_FORMAT(ev.`venue_end_date`,'%d %b %y') AS venue_end_date, 
            TIME_FORMAT(ev.`venue_end_time`, '%h:%i%p') AS venue_end_time,

            ev.`venue_status`,

            ett.`TT_id`,
            ett.`TT_venue_id`,
            ett.`TT_type_title`

            FROM events AS e 

            LEFT JOIN `event_button_list` AS ebl ON  ebl.`event_id`=e.`event_id`
            LEFT JOIN `event_button` AS eb ON ebl.`button_id`=eb.id
            LEFT JOIN event_venues AS ev ON e.`event_id` = ev.`venue_event_id` 
            LEFT JOIN event_ticket_types AS ett ON ev.`venue_id` = ett.`TT_venue_id` 
  
            WHERE (e.`event_category_id` = '$category' OR e.`event_category_id` like '%,$category,%' OR e.`event_category_id` like '$category,%' OR e.`event_category_id` like '%,$category')  
            AND (e.`city_from` = '$location' OR ev.`city` = '$location') 
                    AND (e.event_status = 'active' OR e.event_status = 'upcoming') 
                    AND (e.event_is_featured = 'yes' OR e.event_is_coming = 'yes' OR e.event_is_free = 'yes')
                    
            GROUP BY e.`event_id` ORDER BY  e.`event_created_on` DESC";
    
//    AND ev.`venue_status` = 'active' 
    
              //        [ For selected location and category query end ]
    }
    

} else{
    
}



$result1 = mysqli_query($con, $sql1);
$checkresult1 = mysqli_num_rows($result1);

if ($checkresult1 > 0) {
    while ($resultobj = mysqli_fetch_object($result1)) {
        $dataStore1[] = $resultobj;
    }
} else {
    if (true) {
        $err = "resultFeatured error: " . mysqli_error($con);
    } else {
        $err = "resultFeatured query failed.";
    }
}



echo json_encode($dataStore1);
?>