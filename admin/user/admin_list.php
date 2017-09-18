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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Admin List</h3>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;">
                <?php 
                $admin_type = getSession('admin_type');
                $admin_ID = getSession('admin_id');
                if($admin_type==1)
                {
                if (checkPermission('user', 'create', getSession('admin_type'))): ?>
                    <div class="k-toolbar k-grid-toolbar">
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/user/add_admin.php'); ?>">
                            <span class="k-icon k-add"></span>
                            Add Admin
                        </a>
                    </div>
                <?php endif; 
                }
                ?>
            </div>
            <!-- Content Start Here -->
            <?php if (checkPermission('user', 'read', getSession('admin_type'))): ?>
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
                                url: "../controller/user/admin_list.php",
                                type: "GET"
                            },
                            update: {
                                url: "../controller/user/admin_list.php",
                                type: "POST",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            },
                            destroy: {
                                url: "../controller/user/admin_list.php",
                                type: "DELETE"
                            },
                            create: {
                                url: "../controller/user/admin_list.php",
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
                                id: "admin_id",
                                fields: {
                                    admin_id: {editable: false, nullable: true},
                                    admin_full_name: {type: "string", validation: {required: true}},
                                    admin_email: {type: "string"},
                                    AT_id: {type: "number"},
                                    AT_type: {type: "string"},
                                    status_id: {type: "number"},
                                    admin_status: {type: "string"}
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
                        columns: [
                            {field: "admin_full_name", title: "Admin Name", width: "150px"},
                            {field: "admin_email", title: "Email", width: "150px"},
                            {field: "AT_id",
                                width: "150px",
                                title: "Admin Type",
                                editor: typeDropDownEditor,
                                template: "#=AT_type#",
                                filterable: {
                                    ui: typeFilter,
                                    extra: false,
                                    operators: {
                                        string: {
                                            eq: "Is equal to",
                                            neq: "Is not equal to"
                                        }
                                    }
                                }
                            },
                            {field: "admin_status",
                                width: "130px",
                                title: "Admin Status",
                                editor: statusDropDownEditor,
                                template: "#=admin_status#"

                            },
                            <?php 
                            if($admin_type==1)
                            {
                            ?>
                            {command: ["edit", "destroy"], title: "Action", width: "180px"}],
                            <?php 
                            }
                            else
                            {
                            ?>
                            {command: ["edit"], title: "Action", width: "140px"}],
                            <?php    
                            }
                            ?>
                        editable: "inline"
                    });
                });
                function typeFilter(element) {
                    element.kendoDropDownList({
                        autoBind: false,
                        dataTextField: "AT_type",
                        dataValueField: "AT_id",
                        dataSource: {
                            transport: {
                                read: {
                                    url: "../controller/admin_types/index.php",
                                }
                            },
                            schema: {
                                data: "data"
                            }
                        },
                        optionLabel: "Select Type"
                    });
                }


                function typeDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="AT_type" data-value-field="AT_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/admin_types/index.php",
                                        }
                                    },
                                    schema: {
                                        data: "data"
                                    }
                                },
                                optionLabel: "Select Type"
                            });
                }
                function statusDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="admin_status" data-value-field="status_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/user/status_controller.php",
                                        }
                                    },
                                    schema: {
                                        data: "data"
                                    }
                                },
                                optionLabel: "Select Status"
                            });
                }

            </script>
            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#admin_list").addClass("active");
        $("#admin_list").parent().parent().addClass("active");
        $("#admin_list").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
