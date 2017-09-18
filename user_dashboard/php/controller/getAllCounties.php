<?php


//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode

$countryArray = array();

$countrySql = "SELECT * FROM countries WHERE country_status = 'allow' ";


$resultcountry = mysqli_query($con, $countrySql);

if($resultcountry ){
   
    
    while($rowcountry = mysqli_fetch_object($resultcountry)){
        $cityArray[] = $rowcountry;
    }
    
}else{
    if(true){
        $err = "resultCountry error: ". mysqli_error($con);
    }else{
         $err = "result query faield";       
    }
}

echo json_encode($cityArray);


?>