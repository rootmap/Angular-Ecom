<?php

include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

@$unsuscribe_email = $data->email;

if ($unsuscribe_email != '') {

    $selSql = "SELECT * FROM subscribe_customer_list WHERE email = '$unsuscribe_email'";
    $selrun = mysqli_query($con, $selSql);
    $numrow = mysqli_num_rows($selrun);

    if ($numrow != 0) {
        $sqlquery = "DELETE FROM subscribe_customer_list where email='$unsuscribe_email'";
        $result = mysqli_query($con, $sqlquery);
        echo 1;
    } else {
        echo 0;
    }


}
?>