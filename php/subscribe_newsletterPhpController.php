<?php 
include'../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));
@$user_email=$data->email;
$rowcount=0;

if ($user_email !='') {
        
        $chkquery="SELECT * FROM subscribe_customer_list WHERE email='".$user_email."'";
        $rowcount=  mysqli_num_rows(mysqli_query($con, $chkquery));
        if($rowcount==0)
        {
            $sqlquery = "INSERT INTO subscribe_customer_list SET email='" . $user_email . "',date='" . date('Y-m-d') . "',status='1',gender='0'";
            if (mysqli_query($con, $sqlquery)) 
            {
                //echo php_uname('n');
//                echo "customar successfull suscribed !!";
                echo "1";
            } else {
//                echo "subscribe_customer_list query  !!";
                echo "2";
            }
        }
        else 
        {
//            echo "customar already exists  !!";
            echo "3";
        }
      
        
    }
?>