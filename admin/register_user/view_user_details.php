<?php
include '../../config/config.php';
$countUserData = 0;
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
}

if (isset($_GET['event_id'])) {
    $eventID = $_GET['event_id'];
}
//echo $userID;
//echo $eventID;

$dataArray = array();
$registerUserDetailsSql = "SELECT event_form_values.EFV_field_id, event_form_values.EFV_field_value, event_dynamic_forms.form_field_type,"
        . " event_dynamic_forms.form_field_title FROM event_form_values "
        . " LEFT JOIN event_dynamic_forms ON event_form_values.EFV_field_id = event_dynamic_forms.form_id "
        . " WHERE event_form_values.EFV_event_id = $eventID AND event_form_values.EFV_user_id = $userID";

$registerUserData = mysqli_query($con, $registerUserDetailsSql);
if ($registerUserData) {
    while ($dataObj = mysqli_fetch_object($registerUserData)) {
        $dataArray[] = $dataObj;
    }
} else {
    if (DEBUG) {
        $err = "registerUserData error: " . mysqli_error($con);
    } else {
        $err = "registerUserData query failed.";
    }
}

//debug($dataArray);
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

        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Register User Details</h3>
            <div>
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid">
                <div class="k-toolbar k-grid-toolbar">
                    <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/register_user/view_details.php') ?>?event_id=<?php echo $eventID; ?>">
                        <span class="k-icon k-i-arrowhead-w"></span>
                        Go Back
                    </a>
                </div>
            </div>

            <!-- Content Start Here -->
            <div class="innerAll spacing-x2">
                <div class="widget widget-inverse">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (count($dataArray) > 0): ?>
                                    <?php foreach ($dataArray as $userformData): ?>
                                        <?php if ($userformData->form_field_type == 'upload'): ?>
                                            <div class="col-md-6">
                                                <p><strong><?php echo $userformData->form_field_title; ?></strong></p>
                                                <a href="<?php echo baseUrl(); ?>upload/dynamic_form_upload/<?php echo $userformData->EFV_field_value; ?>" download>Click to Download</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-md-6">
                                                <p><strong><?php echo $userformData->form_field_title; ?></strong></p>
                                                <h4><?php echo $userformData->EFV_field_value; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#faqlist").addClass("active");
        $("#faqlist").parent().parent().addClass("active");
        $("#faqlist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
