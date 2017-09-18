<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}



if (isset($_POST['btnUpdate'])) {

    extract($_POST);

    $queryString = "UPDATE `config_settings` SET `CS_value` = CASE `CS_option`";

    foreach ($_POST AS $key => $val) {
        if ($key != "" AND $val != "") {
            $queryString .=" WHEN '$key' THEN '" . validateInput($val) . "'";
        }
    }

    $queryString .= "ELSE `CS_value` END";

    $resultUpdateWeb = mysqli_query($con, $queryString);

    if ($resultUpdateWeb) {
        $msg = "Settings updated successfully.";
    } else {
        if (DEBUG) {
            $err = "resultUpdateWeb error: " . mysqli_error($con);
        } else {
            $err = "resultUpdateWeb query failed.";
        }
    }
}



$arrWebSettings = array();
$sqlGetWeb = "SELECT * FROM config_settings WHERE CS_type='email'";
$resultGetWeb = mysqli_query($con, $sqlGetWeb);
if ($resultGetWeb) {
    while ($resultGetWebObj = mysqli_fetch_object($resultGetWeb)) {
        $arrWebSettings[] = $resultGetWebObj;
    }
} else {
    if (DEBUG) {
        $err = "resultGetWeb error: " . mysqli_error($con);
    } else {
        $err = "resultGetWeb query failed.";
    }
}

//get_option('SITE_DEFAULT_META_TITLE');
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Email Settings</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-8">

                                    <?php if (count($arrWebSettings) > 0) : ?>
                                        <?php foreach ($arrWebSettings AS $settingsElm): ?>
                                            <?php $settingTitle = str_replace('_', ' ', $settingsElm->CS_option); ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="<?php echo $settingsElm->CS_option; ?>"><?php echo $settingTitle; ?></label>
                                                <div class="col-md-8">
                                                    <input style="color: #1d1d1b !important;" class="form-control" id="category_title" name="<?php echo $settingsElm->CS_option; ?>" value="<?php echo $settingsElm->CS_value; ?>" type="text"/>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <h3>No settings value found.</h3>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <hr class="separator" />
                            <?php if (count($arrWebSettings) > 0) : ?>
                                <?php if (checkPermission('settings', 'update', getSession('admin_type'))): ?>
                                    <div class="form-actions">
                                        <button type="submit" name="btnUpdate" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#mailsettings").addClass("active");
        $("#mailsettings").parent().parent().addClass("active");
        $("#mailsettings").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>