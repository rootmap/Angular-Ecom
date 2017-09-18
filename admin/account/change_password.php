<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$adminID = getSession('admin_id');
$inputPasswordOld = "";
$inputPasswordNew = "";
$oldPassword = "";
$password = "";
$passwordNew = "";


if (isset($_POST['inputPasswordOld'])) {
    extract($_POST);
//    debug($_POST);exit();

    $inputPasswordOld = mysqli_real_escape_string($con, $inputPasswordOld);
    $password = securedPass($inputPasswordOld);
    $inputPasswordNew = mysqli_real_escape_string($con, $inputPasswordNew);
    $passwordNew = securedPass($inputPasswordNew);

    // check old password matched or not
    $sqlGetOldPassword = "SELECT admin_password FROM admins WHERE admin_id = $adminID";
    $resultGetOldPassword = mysqli_query($con, $sqlGetOldPassword);
    if ($resultGetOldPassword) {
        while ($objOldPass = mysqli_fetch_object($resultGetOldPassword)) {
            $oldPassword = $objOldPass->admin_password;
        }
    } else {
        if (DEBUG) {
            $err = "resultGetOldPassword error: " . mysqli_error($con);
        } else {
            $err = "resultGetOldPassword query failed.";
        }
    }

    if ($password !== $oldPassword) {
        $err = "Old password not matched in the record";
    } else {
        $updatePasswordArray = '';
        $updatePasswordArray .= ' admin_password = "' . $passwordNew . '"';

        $sqlUpdatePassword = "UPDATE admins SET $updatePasswordArray WHERE admin_id = $adminID";
        $resultUpdatePassword = mysqli_query($con, $sqlUpdatePassword);
        if ($resultUpdatePassword) {
            setSession("admin_password", $passwordNew);
            $msg = "Password changed successfully";
        } else {
            if (DEBUG) {
                $err = "resultUpdatePassword error: " . mysqli_error($con);
            } else {
                $err = "resultUpdatePassword query failed.";
            }
        }
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
        <script type="text/javascript">
            $(document).ready(function () {
                $('#inputPasswordRetype').keypress(function (e) {
                    var key = e.which;
                    if (key == 13) // the enter key code
                    {
                        $("#btnChangePassword").click();
                    }
                });
            });
        </script>
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

        <div id="content"><h1 class="bg-white content-heading border-bottom">Change Password</h1>

            <div class="innerAll spacing-x2">

                <?php include basePath('admin/message.php'); ?>
                <div class="widget widget-tabs widget-tabs-gray border-bottom-none">

                    <div class="widget-body">
                        <div class="col-md-6" style="margin-left: 154px;width: 521px;" id="passError"></div>
                        <form class="form-horizontal" method="post" id="changePass">
                            <div class="tab-content">
                                <div class="tab-pane active" id="account-details">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Old Password</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input type="password" id="inputPasswordOld" name="inputPasswordOld" class="form-control" value=""  />
                                                        <span class="input-group-addon" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Old password is mandatory"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">New Password</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input type="password" id="inputPasswordNew" name="inputPasswordNew" class="form-control" value=""  />
                                                        <span class="input-group-addon" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="New password is mandatory"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Retype Password</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input type="password" id="inputPasswordRetype" name="inputPasswordRetype" class="form-control" value=""  />
                                                        <span class="input-group-addon" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Retype password is mandatory"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator top">
                                        <button style="margin-left: 170px;" type="button" return="false" id="btnChangePassword" name="btnChangePassword" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnChangePassword").click(function () {
                var inputPasswordOld = $("#inputPasswordOld").val();
                var inputPasswordNew = $("#inputPasswordNew").val();
                var inputPasswordRetype = $("#inputPasswordRetype").val();
                if (inputPasswordOld === "") {
                    $("#passError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Old password required</strong></div>');
                } else if (inputPasswordNew === "") {
                    $("#passError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>New password required</strong></div>');
                } else if (inputPasswordRetype === "") {
                    $("#passError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Retype your password</strong></div>');
                } else if (inputPasswordNew !== inputPasswordRetype) {
                    $("#passError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Password not matched</strong></div>');
                } else {
                    $("#changePass").submit();
                }

            });
        });
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>