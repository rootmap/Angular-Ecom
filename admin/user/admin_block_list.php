<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Admin Block List</h3>
            <?php if (checkPermission('user', 'showip', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You don't have permission to view the content</h5></div>
            <?php endif; ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 10,
                        transport: {
                            read: {
                                url: "../controller/user/admin_blocked_list.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/user/admin_blocked_list.php",
                                type: "DELETE"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "ABI_id",
                                fields: {
                                    ABI_id: {editable: false, nullable: true},
                                    ABI_ip: {type: "string", validation: {required: true}},
                                    ABI_created_on: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#grid").kendoGrid({
                        dataSource: dataSource,
                        filterable: true,
                        pageable: {
                            refresh: true,
                            input: true,
                            numeric: false,
                            pageSizes: true,
                            pageSizes: [10, 20, 50],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [
                            {field: "ABI_ip", title: "Blocked IP", width: "150px"},
                            {field: "ABI_created_on", title: "Blocked Date Time", width: "150px"},
                            {command: ["destroy"], title: "Action", width: "100px"}
                        ],
                        editable: "inline"
                    });
                });
            </script>
            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#admin_blocklist").addClass("active");
        $("#admin_blocklist").parent().parent().addClass("active");
        $("#admin_blocklist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
