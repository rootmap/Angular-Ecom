
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$adminID = getSession('admin_id');
$adminID;
$admin_full_name = "";
$admin_email = "";
$admin_type = "";

if (isset($_POST['btnChangeAccount'])) {
    extract($_POST);
    $admin_full_name = validateInput($admin_full_name);
    $admin_email = validateInput($admin_email);
    if (empty($admin_full_name)) {
        $err = "Enter your name";
    } elseif (empty($admin_email)) {
        $err = "Enter email address";
    } else {
        $updateInfoArray = '';
        $updateInfoArray .= ' admin_full_name = "' . $admin_full_name . '"';
        $updateInfoArray .= ', admin_email = "' . $admin_email . '"';

        $sqlUpdateInfo = "UPDATE admins SET $updateInfoArray WHERE admin_id=$adminID";
        $resultUpdateInfo = mysqli_query($con, $sqlUpdateInfo);
        if ($resultUpdateInfo) {
            setSession("admin_name", $admin_full_name);
            setSession("admin_id", $adminID);
            setSession("admin_email", $admin_email);
            $msg = "Account information changed successfully";
        } else {
            if (DEBUG) {
                $err = "resultUpdateInfo error: " . mysqli_error($con);
            } else {
                $err = "resultUpdateInfo query failed.";
            }
        }
    }
}


// Get admin data
$sqlAdminData = "SELECT admins.*,admin_types.AT_type FROM admins"
        . " LEFT JOIN admin_types ON admins.admin_type = admin_types.AT_id"
        . " WHERE admins.admin_id=$adminID";

$resultAdminData = mysqli_query($con, $sqlAdminData);
if ($resultAdminData) {
    while ($objAdminData = mysqli_fetch_object($resultAdminData)) {
        $admin_full_name = $objAdminData->admin_full_name;
        $admin_email = $objAdminData->admin_email;
        $admin_type = $objAdminData->AT_type;
    }
} else {
    if (DEBUG) {
        $err = "resultAdminData error: " . mysqli_error($con);
    } else {
        $err = "resultAdminData query failed.";
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head>
        <title>Ticket Chai | Admin Panel</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <?php include basePath('admin/header_script.php'); ?>	
    </head>
    <body class="">
        <?php include basePath('admin/header.php'); ?>
        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="content"><h1 class="bg-white content-heading border-bottom">My Account</h1>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <div class="widget widget-tabs widget-tabs-gray border-bottom-none">

                    <div class="widget-body">
                        <form class="form-horizontal" method="post" id="changePass">
                            <div class="tab-content">
                                <div class="tab-pane active" id="account-details">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Your name</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input type="text" value="<?php echo $admin_full_name; ?>" class="form-control" id="admin_full_name" name="admin_full_name" />
                                                        <span class="input-group-addon" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Your name is mandatory"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email Address</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input type="text" value="<?php echo $admin_email; ?>" class="form-control" id="admin_email" name="admin_email" />
                                                        <span class="input-group-addon" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Email address is mandatory"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Role Type</label>
                                                <div class="col-md-9">
                                                    <input type="text" value="<?php echo $admin_type; ?>" id="admin_type" name="admin_type" class="form-control" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="separator top">
                                        <button type="submit" id="btnChangeAccount" name="btnChangeAccount" style="margin-left: 125px;" class="btn btn-primary"><i class="fa fa-fw fa-check"></i> Save changes</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>