<?php 
session_start();
//include'../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
@$data = json_decode(file_get_contents("php://input"));

@$id = $data->id;
@$type = $data->type;

@$userId =$_SESSION['USER_DASHBOARD_USER_ID'];


if($id != ''){
 $insertIntoWishlish = "INSERT into `wishlists`(WL_product_id,WL_product_type,WL_user_id) VALUES ('$id','$type','$userId')";
$insertResult = mysqli_query($con,$insertIntoWishlish);

if($insertResult == TRUE){
    $msg= "insert successfully";
}else{
    $msg= 'Query error:'.mysqli_error($con);
}   
}


//Wishlist start
$arrayWishlist = array();
$wlistUserID = 0;

 if (isset($userId)) {
     $wlistUserID =$_SESSION['USER_DASHBOARD_USER_ID'];
     $sqlGetFavorite = "SELECT
      wishlists.WL_id,
      wishlists.WL_created,
      events.event_id,
      events.event_title,
      events.event_web_logo,
      events.event_status                                   
      From `wishlists`                   
      LEFT JOIN events 
      ON events.event_id = wishlists.WL_product_id 
                                        
      WHERE wishlists.WL_user_id ='$wlistUserID' ";
     $resultGetFavorite = mysqli_query($con, $sqlGetFavorite);

     if ($resultGetFavorite) {
         while ($resultGetFavoriteObj = mysqli_fetch_object($resultGetFavorite)) {
             $arrayWishlist[] = $resultGetFavoriteObj;
         }
     } else {
         if (DEBUG) {
             echo "resultGetFavorite error: " . mysqli_error($con);
         } else {
             echo "resultGetFavorite query failed.";
         }
     }
}
     
 echo json_encode($arrayWishlist);
    
//Wishlist end
    
// delete from wishlist
 
@$del_id=$data->del_id;
if ($del_id !=0) {
  $query = "DELETE FROM wishlists WHERE WL_id=$del_id";
  $result = mysqli_query($con, $query);
   
  if($result == 1){
       echo 1;
  }else{
      echo 0;
  }
         

  
}
    


?>

