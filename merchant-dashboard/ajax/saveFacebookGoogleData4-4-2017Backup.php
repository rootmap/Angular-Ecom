<?php
//session_start();
header("Access-Control-Allow-Origin: *");
//include '../DBconnection/auth.php';
include'../DBconnection/database_connections.php';
//require_once '../../cms/merchantPlugin.php';
//$cms=new plugin();
//require_once('phpmailer/class.phpmailer.php');
include '../lib/helper_functions.php';

/* Data convert by jeson start here */
$data = json_decode(file_get_contents("php://input"));
/*./Data convert by jeson end here*/

$type=$data->admin_social_type;

$sub = 'Merchant Account Details';

$admin_hash = session_id();
$admin_email = "";
$admin_first_name = "";
$admin_last_name = "";
//$admin_social_id = "";
$admin_social_type = $type;
//$admin_verification = "";
//$admin_gender = "";
//$admin_social_type = '';
$countUserInfo = 0;
$countGetUser = 0;



if(isset($_SESSION['REF']) && trim($_SESSION['REF'])!=''){
    $link_dir = "./create_event_journey.php";
}else{
    
    $link_dir = "./events.php";
}


$return_array = array();
$sessionID = session_id();
extract($_POST);


if ($admin_email != "" && $admin_social_type != "" && $admin_social_id != "") {
    //$checkSocialUserSql = "SELECT * FROM admins WHERE admin_email = '$admin_email' AND"
            //. " admin_social_id = '$admin_social_id' AND admin_social_type = '$admin_social_type'";
     $checkSocialUserSql = "SELECT * FROM admins WHERE admin_email = '$admin_email' ";

    $checkSocialUserResult = mysqli_query($con, $checkSocialUserSql);
    $countSocialUser = mysqli_num_rows($checkSocialUserResult);

    if ($countSocialUser == 0) {
        $admin_first_name = validateInput($admin_first_name);
        $admin_last_name = validateInput($admin_last_name);
        $admin_email = validateInput($admin_email);
        //$admin_social_id = validateInput($admin_social_id);
        //$admin_social_type = validateInput($admin_social_type);
        //$admin_hash = validateInput($admin_hash);

        $insertSocialUserArray = '';
        //$insertSocialUserArray .=' admin_first_name = "' . $admin_first_name . '"';
        $insertSocialUserArray .='admin_full_name = "' . $admin_first_name .' '. $admin_last_name. '"';
        $insertSocialUserArray .=',admin_email = "' . $admin_email . '"';
        //$insertSocialUserArray .=',admin_social_id = "' . $admin_social_id . '"';
       // $insertSocialUserArray .=',admin_social_type = "' . $admin_social_type . '"';
        //$insertSocialUserArray .=',admin_gender = "' . $admin_gender . '"';
        $insertSocialUserArray .=',admin_hash = "' . $admin_hash . '"';
        //$insertSocialUserArray .=',admin_verification = "' . $admin_verification . '"';
        //$insertSocialUserArray .=',admin_agree_tc = "' . "I AGREE" . '"';

        $runInsertSocialUserSql = "INSERT INTO admins SET $insertSocialUserArray";
        $resultSocialArray = mysqli_query($con, $runInsertSocialUserSql);


        if ($resultSocialArray) {
            //$adminInfoSql = "SELECT * FROM admins WHERE admin_email = '$admin_email' AND admin_social_type='$admin_social_type'";
            $adminInfoSql = "SELECT * FROM admins WHERE admin_email = '$admin_email' ";
            $resultUserInfo = mysqli_query($con, $adminInfoSql);
            $countUserInfo = mysqli_num_rows($resultUserInfo);
            if ($countUserInfo >= 1) {
                while ($row = mysqli_fetch_object($resultUserInfo)) {
                    $adminID = $row->admin_id;
                    $admin_email = $row->admin_email;
                    $admin_first_name = $row->admin_full_name;
                    //$admin_verification = $row->admin_verification;
                    //$admin_hash = $row->admin_hash;


//                    setSession('admin_email', $admin_email);
//                    setSession('admin_id', $adminID);
//                    setSession('admin_first_name', $admin_first_name);
//                    setSession('admin_verification', $admin_verification);
//                    setSession('admin_hash', $admin_hash);
                    
                    session_regenerate_id();
                    $_SESSION['SESS_MERCHANT_USER_ID'] = $adminID;
                    $_SESSION['SESS_MERCHANT_USER_FULLNAME'] = $admin_first_name;
                    session_write_close();
                    
                    $return_array = array("output" => "success", "admin_first_name" => $admin_first_name, "msg" => "Customer saved successfully", "link" => $link_dir);
                    echo json_encode($return_array);
                    
                      /*$EmailSubject = "Thank you for registering with TicketChai";
                      $EmailBody = file_get_contents(baseUrl('email/body/signup.php?admin_id=' . $adminID));
                      $sendMailStatus = sendEmailFunction($admin_email, $admin_first_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);


                      if ($sendMailStatus) {
                      $return_array = array("output" => "success", "admin_first_name" => $admin_first_name, "msg" => "Customer saved successfully", "link" => $link_dir);
                      echo json_encode($return_array);
                      exit();
                      } else {
                      $return_array = array("output" => "error", "admin_first_name" => $admin_first_name, "msg" => "Login was successful but email sending failed.", "link" => $link_dir);
                      echo json_encode($return_array);
                      exit();
                      }*/
                      exit();
                    
                    //end temporarily added
                    
                    //updating temp cart if exist with admin id
                    //$sqlUpdateTmpCart = "UPDATE event_temp_cart SET ETC_admin_id=$adminID WHERE ETC_session_id='$sessionID'";
                    //$resulltUpdateTmpCart = mysqli_query($con, $sqlUpdateTmpCart);
                    //updating dynamic form values if exist
                    //$sqlUpdateDynamicFormValue = "UPDATE event_form_values SET EFV_admin_id=$adminID WHERE EFV_session_id='$sessionID'";
                    //$resultUpdateDynamicFormValue = mysqli_query($con, $sqlUpdateDynamicFormValue);
                    
                    //check session free event
                    /* $sqlcheckfree=  mysqli_query($con,"SELECT * FROM admins_info_free_event WHERE session_id='$sessionID'");
                      $cqlcountfree=  mysqli_num_rows($sqlcheckfree);
                      if($cqlcountfree==0)
                      {
                      $link_dir="checkout";
                      }
                      else
                      {
                      $link_dir="myorderlist";
                      } */
                    //check session free event

                    /* if ($resulltUpdateTmpCart && $resultUpdateDynamicFormValue) {

                      $EmailSubject = "Thank you for registering with TicketChai";
                      $EmailBody = file_get_contents(baseUrl('email/body/signup.php?admin_id=' . $adminID));
                      $sendMailStatus = sendEmailFunction($admin_email, $admin_first_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);


                      if ($sendMailStatus) {
                      $return_array = array("output" => "success", "admin_first_name" => $admin_first_name, "msg" => "Customer saved successfully", "link" => $link_dir);
                      echo json_encode($return_array);
                      exit();
                      } else {
                      $return_array = array("output" => "error", "admin_first_name" => $admin_first_name, "msg" => "Login was successful but email sending failed.", "link" => $link_dir);
                      echo json_encode($return_array);
                      exit();
                      }
                      } else {
                      $return_array = array("output" => "error", "admin_first_name" => $admin_first_name, "msg" => "Login was successful but update process failed.", "link" => $link_dir);
                      echo json_encode($return_array);
                      exit();
                      } */
                }
            }
        } else {
            $return_array = array("output" => "error", "msg" => "User registration failed.");
            echo json_encode($return_array);
            exit();
        }
    } else {

        //$getUserSql = "SELECT * FROM admins WHERE admin_email = '$admin_email' AND admin_social_type = '$admin_social_type' AND admin_social_id = '$admin_social_id'";
        $getUserSql = "SELECT * FROM admins WHERE admin_email = '$admin_email'";
        $resultGetUser = mysqli_query($con, $getUserSql);
        $countGetUser = mysqli_num_rows($resultGetUser);
        if ($countGetUser >= 1) {
            while ($getUser = mysqli_fetch_object($resultGetUser)) {
                $adminID = $getUser->admin_id;
                $admin_email = $getUser->admin_email;
                $admin_first_name = $getUser->admin_full_name;
                //$admin_verification = $getUser->admin_verification;
                $admin_hash = $getUser->admin_hash;

//                setSession('admin_email', $admin_email);
//                setSession('admin_id', $adminID);
//                setSession('admin_first_name', $admin_first_name);
//                setSession('admin_verification', $admin_verification);
//                setSession('admin_hash', $admin_hash);

                session_regenerate_id();
                $_SESSION['SESS_MERCHANT_USER_ID'] = $adminID;
                $_SESSION['SESS_MERCHANT_USER_FULLNAME'] = $admin_first_name;
                session_write_close();

                //temporary code starts
                $return_array = array("output" => "success", "admin_first_name" => $admin_first_name, "msg" => "Successfully logged in ", "link" => $link_dir);
                echo json_encode($return_array);
                exit();
                //temporary code ends
                //updating temp cart if exist with admin id
                //$sqlUpdateTmpCart = "UPDATE event_temp_cart SET ETC_admin_id=$adminID WHERE ETC_session_id='$sessionID'";
                //$resulltUpdateTmpCart = mysqli_query($con, $sqlUpdateTmpCart);
                //updating dynamic form values if exist
                //$sqlUpdateDynamicFormValue = "UPDATE event_form_values SET EFV_admin_id=$adminID WHERE EFV_session_id='$sessionID'";
                //$resultUpdateDynamicFormValue = mysqli_query($con, $sqlUpdateDynamicFormValue);
                //check session free event
                /* $sqlcheckfree = mysqli_query($con, "SELECT * FROM admins_info_free_event WHERE session_id='$sessionID'");
                  $cqlcountfree = mysqli_num_rows($sqlcheckfree);
                  if ($cqlcountfree == 0) {
                  $link_dir = "checkout";
                  } else {
                  $link_dir = "myorderlist";
                  mysqli_query($con, "UPDATE orders SET order_admin_id='" . $adminID . "' WHERE order_session_id='" . $sessionID . "'");
                  mysqli_query($con, "UPDATE order_events SET OE_admin_id='" . $adminID . "' WHERE OE_session_id='" . $sessionID . "'");
                  } */
                //check session free event

                /* if ($resulltUpdateTmpCart && $resultUpdateDynamicFormValue) {

                  $return_array = array("output" => "success", "admin_first_name" => $admin_first_name, "msg" => "Successfully logged in", "link" => $link_dir);
                  echo json_encode($return_array);
                  exit();
                  } else {
                  $return_array = array("output" => "error", "admin_first_name" => $admin_first_name, "msg" => "Login was successful but update process failed.", "link" => $link_dir);
                  echo json_encode($return_array);
                  exit();
                  } */
            }
        } else {
            $return_array = array("output" => "error", "msg" => "Login failed.");
            echo json_encode($return_array);
            exit();
        }
    }
} else {
    $return_array = array("output" => "error", "msg" => "Registration failed.");
    echo json_encode($return_array);
    exit();
}
?>
