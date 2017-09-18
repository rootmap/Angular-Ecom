<?php 
include'../DBconnection/database_connections.php';
$query = "SELECT * FROM wishlists";
$result = mysqli_query($con,$query);
$arry = array();

while($row = mysqli_fetch_assoc($result)){
    $arry[] = $row;
}
print(json_encode($arry));
?>