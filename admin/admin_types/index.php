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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Admin Types</h3>

            <!-- Content Start Here -->
            <?php if (checkPermission('admin_types', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You don't have permission to view the content</h5></div>
            <?php endif; ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/admin_types/index.php",
                                type: "GET"
                            },
                            update: {
                                url: "../controller/admin_types/index.php",
                                type: "POST",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            },
                            destroy: {
                                url: "../controller/admin_types/index.php",
                                type: "DELETE"
                            },
                            create: {
                                url: "../controller/admin_types/index.php",
                                type: "PUT",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            },
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "AT_id",
                                fields: {
                                    AT_id: {editable: false, nullable: true},
                                    AT_type: {type: "string", validation: {required: true}},
                                    AT_details: {type: "string", validation: {required: true}}
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
                            pageSizes: [5, 10, 20, 50],
                        },
                        sortable: true,
                        groupable: true,
                        toolbar: [
                            {name: "create", text: "Add Admin Types"}
                        ],
                        columns: [
                            {field: "AT_type", title: "Type Name", width: "150px"},
                            {field: "AT_details", title: "Type Details", width: "180px"},
                            {command: ["edit", "destroy"], title: "Action", width: "180px"},
                            {
                                title: "Permission", width: "150px",
                                template: kendo.template($("#permission").html())
                            }
                        ],
                        editable: "inline"
                    });
                });

            </script>
            <!-- Content End Here -->

            <?php if (checkPermission('admin_types', 'permission', getSession('admin_type'))): ?>
                <script id="permission" type="text/x-kendo-template">
                    <a class="k-button k-button-icontext k-grid-lock" href="<?php echo baseUrl('admin/admin_types/permission.php'); ?>?type=#= AT_id #"><span class="k-icon k-i-custom"></span>Set Permission</a>
                </script>
            <?php endif; ?>

        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#admin_type").addClass("active");
        $("#admin_type").parent().parent().addClass("active");
        $("#admin_type").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
