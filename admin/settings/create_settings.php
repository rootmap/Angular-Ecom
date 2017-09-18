<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$title = "";
$value = "";
$type = "";



if (isset($_POST['btnAdd'])) {

    extract($_POST);

    if ($title == "") {
        $err = "Settings Title is required.";
    } elseif ($value == "") {
        $err = "Settings Value is required.";
    } elseif ($type == "") {
        $err = "Settings Type is required.";
    } else {

        $insertSettings = '';
        $insertSettings .= ' CS_option = "' . mysqli_real_escape_string($con, $title) . '"';
        $insertSettings .= ', CS_value = "' . mysqli_real_escape_string($con, $value) . '"';
        $insertSettings .= ', CS_type = "' . mysqli_real_escape_string($con, $type) . '"';

        $sqlInsertSettings = "INSERT INTO config_settings SET $insertSettings";
        $resultInsertSettings = mysqli_query($con, $sqlInsertSettings);
        if ($resultInsertSettings) {
            $msg = "Settings added successfully.";
            $title = "";
            $value = "";
            $type = "";
        } else {
            if (DEBUG) {
                $err = "resultInsertSettings error: " . mysqli_error($con);
            } else {
                $err = "resultInsertSettings query failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Create Settings</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="metatitle">Settings Title</label>
                                        <div class="col-md-8"><input class="form-control" id="category_title" name="title" value="<?php echo $title; ?>" type="text"/> Use under score (_) instead of space (e.g. <strong>SAMPLE_SETTINGS_TITLE</strong>)</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="metadesc">Settings Value</label>
                                        <div class="col-md-8">
                                            <textarea name="value" id="category_description" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $value; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="metadesc">Settings Type</label>
                                        <div class="col-md-8">
                                            <select name="type" class="form-control rounded-none margin-bottom">
                                                <option value="">Select Type</option>
                                                <option value="web" <?php
                                                if ($type == "web") {
                                                    echo "selected";
                                                }
                                                ?>>Web Settings</option>
                                                <option value="image" <?php
                                                if ($type == "image") {
                                                    echo "selected";
                                                }
                                                ?>>Image Settings</option>
                                                <option value="email" <?php
                                                if ($type == "email") {
                                                    echo "selected";
                                                }
                                                ?>>Email Settings</option>
                                                <option value="social" <?php
                                                if ($type == "social") {
                                                    echo "selected";
                                                }
                                                ?>>Social Settings</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnAdd" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add Settings</button>
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
        $("#createsettings").addClass("active");
        $("#createsettings").parent().parent().addClass("active");
        $("#createsettings").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>