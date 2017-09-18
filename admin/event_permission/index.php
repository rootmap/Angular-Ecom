<?php 
include '../../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $admin_ID = getSession('admin_id');
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Similar Event</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body" >
                            <table class="table table-bordered table-striped table-white">
                                <thead>
                                    <tr>
                                        <th class="center">No.</th>
                                        <th>Event Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($arrayAllEvents) > 0) : ?>
                                        <?php foreach ($arrayAllEvents as $arrEvent): ?>
                                            <tr>
                                                <td class="center">
                                                    <input type="checkbox" name="ES_similar_event_id[]" value="<?php echo $arrEvent->event_id; ?>" <?php
                                                    if (in_array($arrEvent->event_id, $arrayCurrentSimilarEvent)) {
                                                        echo "checked";
                                                    }
                                                    ?> />
                                                </td>
                                                <td>
                                                    <?php echo $arrEvent->event_title; ?>
                                                </td>

                                            </tr>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3">
                                                No active event found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="form-actions">
                                <button type="submit" name="btnSaveSimilar" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save Similar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#add_sim").addClass("active");
        $("#add_sim").parent().parent().addClass("active");
        $("#add_sim").parent().addClass("in");
    </script>



    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>