<?php

//database connection
require_once '../../DBconnection/database_connections.php';
//database connection

//authority page connection
require_once '../../../DBconnection/auth.php';
//authority page connection

//json data decode
$data = json_decode(file_get_contents("php://input"));
//json data decode



@$userId = $login_user_id;

@$uaId = $data->uaId;
@$type = $data->requestType;

@$delId = $data->delId;


$sql = "SElECT 
       ua.*,
       co.country_name,
       ci.city_name,
       u.user_default_shipping,
       u.user_default_billing
       
       FROM user_addresses AS ua
       LEFT JOIN countries AS co ON ua.UA_country_id = co.country_id
       LEFT JOIN cities AS ci ON ua. UA_city_id = ci.city_id
       INNER JOIN users AS u ON u.user_id = ua.UA_user_id
       WHERE ua.UA_user_id = '$userId' OR u.user_id = '$userId' ORDER BY ua.UA_id DESC 
       ";

$result = mysqli_query($con, $sql);
$userAddresses = array();

    while($row = mysqli_fetch_object($result)){
        $userAddresses[] = $row;
    }

    
    
if($uaId > 0 AND !empty($type)){
    if($type == 'shipping'){
        $shippingSql = "UPDATE users 
                        SET user_default_shipping = $uaId;
                       ";
        $resultShippingSql = mysqli_query($con, $shippingSql);
        
        if($resultShippingSql){
            $returnArray = array("output"=>"success", "msg"=>"Success!!");
        }else{
            $returnArray = array("output"=>"faild", "msg"=>"$err");
        }
        
    }
    
    if($type == 'billing'){
        $billingSql = "UPDATE users 
                        SET user_default_billing = $uaId
                       ";
        $resultBillingSql = mysqli_query($con, $billingSql);
        
        if($resultBillingSql){
            $resultArray = array("output"=>"success", "msg"=>"Success!!");
        }else{
            $resultArray = array("output"=>"faild", "msg"=>"$err");
        }
    }
    
}


if(!empty($delId)){
    $delSql = "DELETE FROM user_addresses WHERE UA_id = $delId";
    $delResult = mysqli_query($con, $delSql);
    
    if($delResult == 1){
        echo 'ok';
    }else{
        echo 'nope';
    }
}
    

echo json_encode($userAddresses);


?>