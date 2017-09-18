<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$arr = array();
$get_admin_types = "SELECT * FROM admin_types";
$rs = mysqli_query($con, $get_admin_types);

while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}

$admin_type = "";
$admin_full_name = "";
$admin_email = "";
$admin_password = "";
$admin_status = "";
$admin_confirm_password = "";
$admin_hash = "";
$strEventID = '';
$eventID = array();


if (isset($_POST["btnSave"])) {
    extract($_POST);
    if (empty($admin_full_name)) {
        $err = "Enter admin name";
    } elseif (empty($admin_email)) {
        $err = "Enter admin email address";
    } elseif (empty($admin_password)) {
        $err = "Enter password";
    } elseif (empty($admin_confirm_password)) {
        $err = "Enter confirm password";
    } elseif ($admin_password != $admin_confirm_password) {
        $err = "Password mismatch";
    } elseif (empty($admin_type)) {
        $err = "Select admin type";
    } elseif (empty($admin_status)) {
        $err = "Select admin status";
    } else {

        if (count($eventID) > 0) {
            foreach ($eventID AS $key => $val) {
                $strEventID .= $val . ',';
            }
            $strEventID = trim($strEventID, ',');
        }
        
        
        $admin_full_name = mysqli_real_escape_string($con, $admin_full_name);
        $admin_email = mysqli_real_escape_string($con, $admin_email);
        $admin_type = mysqli_real_escape_string($con, $admin_type);
        $admin_status = mysqli_real_escape_string($con, $admin_status);
        $admin_password = mysqli_real_escape_string($con, $admin_password);
        $admin_event_id = mysqli_real_escape_string($con, $strEventID);
        $password = securedPass($admin_password);
        $admin_hash = session_id();

        $sql = "SELECT * FROM admins WHERE admin_email= '$admin_email'";
        $checkAdmin = mysqli_query($con, $sql);
        $Admincount = mysqli_num_rows($checkAdmin);


        if ($Admincount >= 1) {
            $err = "Admin already exists";
        } else {

            $InsertQuery = "INSERT INTO admins SET ";
            $InsertQuery .= " admin_full_name='" . $admin_full_name . "',";
            $InsertQuery .= " admin_email='" . $admin_email . "',";
            $InsertQuery .= " admin_password='" . $password . "',";
            $InsertQuery .= " admin_type='" . $admin_type . "',";
            $InsertQuery .= " admin_event_id='" . $admin_event_id . "',";
            $InsertQuery .= " admin_status='" . $admin_status . "',";
            $InsertQuery .= " admin_hash='" . $admin_hash . "'";

            $result = mysqli_query($con, $InsertQuery);

            if (!$result) {
                $err = mysqli_error($con);
            } else {
                $msg = "Registration Successfull";
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

        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Add Admin</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="firstname">Admin name</label>
                                        <div class="col-md-8"><input class="form-control" id="admin_full_name" name="admin_full_name" value="<?php echo $admin_full_name; ?>" type="text" placeholder="first name"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="password">Password</label>
                                        <div class="col-md-8"><input class="form-control" id="admin_password" name="admin_password" type="password" placeholder="password" /></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="email">Admin Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="admin_type" name="admin_type" onchange="javascript:checkType(this.value);">
                                                <option value="0">Select Type</option>
                                                <?php if (count($arr) >= 1): ?>
                                                    <?php foreach ($arr as $at): ?>
                                                        <option value="<?php echo $at->AT_id; ?>"  
                                                        <?php
                                                        if ($at->AT_id == $admin_type) {
                                                            echo ' selected="selected"';
                                                        }
                                                        ?>>
                                                            <?php echo $at->AT_type; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="email">E-mail</label>
                                        <div class="col-md-8"><input class="form-control" id="admin_email" name="admin_email" value="<?php echo $admin_email; ?>" type="email" placeholder="email address"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="confirm_password">Confirm password</label>
                                        <div class="col-md-8"><input class="form-control" id="admin_confirm_password" name="admin_confirm_password" type="password" placeholder="confirm password" /></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="confirm_password">Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="admin_status" name="admin_status">
                                                <option value="0">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div id="tblEvent" class="col-md-8 col-md-offset-2" style="margin-top: 30px; display: none;">
                                    <h4>Select Events</h4>
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr style="border-bottom: 1px #000 solid;">
                                                <td style="width: 20%;">Action</td>
                                                <td style="width: 80%;">Event Name</td>
                                            </tr>
                                        </thead>
                                        <tbody id="setEventTbl">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnSave" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#admin_list").addClass("active");
        $("#admin_list").parent().parent().addClass("active");
        $("#admin_list").parent().addClass("in");


        function checkType(typeID) {
            var adminTypeID = typeID;

            if (adminTypeID > 0) {
                $.ajax({
                    type: "POST",
                    url: baseUrl + "admin/ajax/ajaxCheckAdminType.php",
                    dataType: "json",
                    data: {adminTypeID: adminTypeID},
                    success: function (response) {
                        var obj = response;
                        var newHtml = '';

                        if (obj.output === "success") {
                            if (obj.flag == 1) {
                                if (obj.arrEvent.length > 0) {
                                    $.each(obj.arrEvent, function (key, Event) {
                                        newHtml += '<tr>';
                                        newHtml += '<td><input type="checkbox" name="eventID[]" value="' + Event.event_id + '"></td>';
                                        newHtml += '<td>' + Event.event_title + '</td>';
                                        newHtml += '</tr>';
                                    });
                                } else {
                                    newHtml += '<tr>';
                                    newHtml += '<td colspan="2" >No active event found in record.</td>';
                                    newHtml += '</tr>';
                                }
                                $("#setEventTbl").html(newHtml);
                                $("#tblEvent").show("slow");
                            } else {
                                $("#tblEvent").hide("slow");
                            }
                        } else {
                            error(obj.msg);
                        }
                    }
                });
            }
        }

    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
