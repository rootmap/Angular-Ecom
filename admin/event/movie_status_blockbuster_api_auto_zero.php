<?php
include '../../config/config.php';

//include './blockbuster_api_class/GenerateSecretKey.php';
//echo var_dump($movies);
//$obj->FlyQuery("UPDATE event_movie_list SET status='0'", "3");
mysqli_query($con,"UPDATE event_movie_list SET status='0'");
echo 1;
//movie_status_blockbuster_api_auto.php