<?php

$err = "";
if (isset($_POST['btnLogin'])) {
    extract($_POST);

    $totalLoginAttempt = getConfig('ADMIN_MAX_LOGIN_ATTEMPT');
    $countRow = 0;
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $password = securedPass($password);
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    if (empty($username)) {
        $err = "Please enter username";
    } elseif (empty($password)) {
        $err = "Please enter password";
    } else {
        $sqlQuery = "SELECT * FROM admins WHERE admin_email='$username'";
        $result = mysqli_query($con, $sqlQuery);

        if ($result) {

            $countRow = mysqli_num_rows($result);

            if ($countRow > 0) {
                $resultRow = mysqli_fetch_object($result);

                if ($resultRow->admin_password == $password) {

                    $adminTypeID = $resultRow->admin_type;
                    $getAdminTypeSql = "SELECT * FROM admin_types WHERE AT_id = $adminTypeID";
                    $resultAdminType = mysqli_query($con, $getAdminTypeSql);

                    if ($resultAdminType) {
                        $typesData = mysqli_fetch_object($resultAdminType);
                        $AT_event_permission = $typesData->AT_event_permission;
                        $AT_sales_report = $typesData->AT_sales_report;
                        $AT_profit_report = $typesData->AT_profit_report;
                        $AT_event_report = $typesData->AT_event_report;
                        $AT_user_report = $typesData->AT_user_report;
                    }

                    unsetSession('LOGIN_ATTMPT');

                    setSession("admin_id", $resultRow->admin_id);
                    setSession("admin_email", $username);
                    setSession("admin_password", $resultRow->admin_password);
                    setSession("admin_name", $resultRow->admin_full_name);
                    setSession("admin_type", $adminTypeID);
                    setSession("admin_hash", $resultRow->admin_hash);
                    setSession("admin_event_id", $resultRow->admin_event_id);
                    setSession("admin_event_permission", $AT_event_permission);
                    setSession("admin_sales_report", $AT_sales_report);
                    setSession("admin_profit_report", $AT_profit_report);
                    setSession("admin_event_report", $AT_event_report);
                    setSession("admin_user_report", $AT_user_report);

                    $recordAdmin = '';
                    $recordAdmin .= ' ALH_admin_id = "' . validateInput($resultRow->admin_id) . '"';
                    $recordAdmin .= ', ALH_ip_address = "' . validateInput($ipAddress) . '"';

                    $updateAdminEntry = "INSERT INTO admin_login_history SET $recordAdmin";
                    $resultAdminEntry = mysqli_query($con, $updateAdminEntry);

                    if (!$resultAdminEntry) {
                        if (DEBUG) {
                            $err = "resultAdminEntry error: " . mysqli_error($con);
                        }
                    }

                    $msg = "Logged in successfully";
                    $link = "dashboard.php?msg=" . base64_encode($msg);
                    redirect($link);
                } else {
                    if (getSession('LOGIN_ATTMPT')) {
                        setSession('LOGIN_ATTMPT', getSession('LOGIN_ATTMPT') + 1);
                    } else {
                        setSession('LOGIN_ATTMPT', 1);
                    }
                    $remainAttempt = $totalLoginAttempt - getSession('LOGIN_ATTMPT');

                    //checking misused admin and blocking his/her ip address
                    if ($remainAttempt == 0) {
                        $getBlock = '';
                        $getBlock .= ' ABI_ip = "' . validateInput($ipAddress) . '"';

                        $updateAdminBlock = "INSERT INTO admin_blocked_ip SET $getBlock";
                        $resultAdminBlock = mysqli_query($con, $updateAdminBlock);

                        if (!$resultAdminBlock) {
                            if (DEBUG) {
                                $err = "resultAdminEntry error: " . mysqli_error($con);
                            }
                        } else {
                            $link = baseUrl();
                            redirect($link);
                        }
                    }
                    $err = 'Incorrect password. ' . $remainAttempt . ' attempts remains.';
                }
            } else {
                if (getSession('LOGIN_ATTMPT')) {
                    setSession('LOGIN_ATTMPT', getSession('LOGIN_ATTMPT') + 1);
                } else {
                    setSession('LOGIN_ATTMPT', 1);
                }
                $remainAttempt = $totalLoginAttempt - getSession('LOGIN_ATTMPT');

                //checking misused admin and blocking his/her ip address
                if ($remainAttempt == 0) {
                    $getBlock = '';
                    $getBlock .= ' ABI_ip = "' . validateInput($ipAddress) . '"';

                    $updateAdminBlock = "INSERT INTO admin_blocked_ip SET $getBlock";
                    $resultAdminBlock = mysqli_query($con, $updateAdminBlock);

                    if (!$resultAdminBlock) {
                        if (DEBUG) {
                            $err = "resultAdminEntry error: " . mysqli_error($con);
                        }
                    } else {
                        $link = baseUrl();
                        redirect($link);
                    }
                }

                $err = 'Incorrect username. ' . $remainAttempt . ' attempts remains.';
            }
        } else {
            if (DEBUG) {
                $err = "result error: " . mysqli_error($con);
            } else {
                $err = "result query failed.";
            }
        }
    }
}
?>