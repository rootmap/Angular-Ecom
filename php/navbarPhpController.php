<?php include'../DBconnection/database_connections.php';$data=json_decode(file_get_contents("php://input"));$navbarData=array();$query="
SELECT 
         c.`category_color`,
         c.`category_id`,
         c.`category_title`,
         c.`category_parent_id`,
         c.`category_priority`,
         CASE c.category_icon
           WHEN '' THEN 'icon-pitch'
           ELSE c.category_icon
           END AS
           category_icon
         FROM `categories` AS c 
         WHERE c.`category_parent_id`='99' OR c.`category_parent_id`='0' ORDER BY c.`category_id` ASC";$result1=mysqli_query($con,$query);$check=mysqli_num_rows($result1);if($check>0){while($resultobj=mysqli_fetch_object($result1)){$navbarData[]=$resultobj;}}else{if(true){$err="resultFeatured error: ".mysqli_error($con);}else{$err="resultFeatured query failed.";}}echo json_encode($navbarData);?>