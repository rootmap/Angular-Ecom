<?php

include '../../config/config.php';

$term = $_GET["term"];

$query = mysqli_query($con,"SELECT * FROM cities where city_name like '%" . $term . "%' order by city_name ");
$json = array();

while ($student = mysqli_fetch_array($query)) {
    $json[] = array(
        'value' => $student["city_name"]."-".$student["city_id"],
        'label' => $student["city_name"]
    );
}
echo json_encode($json);
?>