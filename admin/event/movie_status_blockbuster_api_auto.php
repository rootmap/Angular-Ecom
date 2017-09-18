<?php
include '../../config/config.php';

include './blockbuster_api_class/GenerateSecretKey.php';
$secure = new GenerateKeySecret();
$xmljson = new XmlToJson();

//echo var_dump($movies);
echo $xmljson->UpdateMovieStatus(1);
//movie_status_blockbuster_api_auto.php