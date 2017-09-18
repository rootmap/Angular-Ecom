<?php

include'../DBconnection/database_connections.php';


@$data = json_decode(file_get_contents("php://input"));
@$e_id=$data->e_id;
//print_r($data);
$formData = array();
$sql = "SELECT * FROM event_dynamic_forms WHERE form_event_id='$e_id' AND form_field_status='active' ";
$resulSql = mysqli_query($con, $sql);
//print_r(mysqli_fetch_object($resulSql));
if ($resulSql) {
    while ($resulSqlObj = mysqli_fetch_object($resulSql)) {
        $formData[] = $resulSqlObj;
    }
} else {
    echo 0;
}


echo json_encode($formData);
?>