<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$promotion_id = 0;
if (isset($_GET['promotion_id'])) {
    $promotion_id = $_GET['promotion_id'];
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


        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Promotion List</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>

            <!-- Content Start Here -->
            <?php if (checkPermission('promotion', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>


            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/promotion/promotion_code_list.php?promotion_id=<?php echo $promotion_id; ?>",
                                type: "GET"
                            },
                            update: {
                                url: "../controller/promotion/promotion_code_list.php",
                                type: "POST",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            }
                        },
                        autoSync: false,
                        schema: {
                            errors: function (e) {
                                if (e.error === "yes")
                                {
                                    var message = "";
                                    message += e.message;
                                    var window = jQuery("#kWindow");
                                    if (!window.data("kendoWindow")) {
                                        window.kendoWindow({
                                            actions: ["Close"],
                                            title: "Promotion Code Entry Error",
                                            modal: true,
                                            height: 50,
                                            width: 280,
                                            position: {
                                                top: 100,
                                                left: 100
                                            },
                                            visible: false,
                                            draggable: false,
                                            resizable: false
                                        });
                                    }

                                    window.data("kendoWindow").center().open();
                                    window.html('<div style="margin-top:10px;text-align:center;"><span style="color:red;font-size:14px;">' + message + '</span></div>');
                                    this.cancelChanges();
                                }
                            },
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "PC_id",
                                fields: {
                                    PC_id: {nullable: true},
                                    PC_code: {type: "string", editable: false},
                                    PC_code_use_type: {type: "string", editable: false},
                                    PC_code_used_email: {type: "string"},
                                    PC_code_status: {type: "string"}
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
                        edit: function (e) {
                            if (e.model.PC_code_status === "used") {
                                jQuery(".k-pager-refresh").click();
                                KendoWindowFunction("Code already used", "error");
                            }
                        },
                        sortable: true,
                        groupable: true,
                        columns: [
                            {field: "PC_code", title: "Promotion Code", width: "140px"},
                            {field: "PC_code_use_type", title: "Code Use Type", width: "120px"},
                            {field: "PC_code_used_email", title: "Email Address", width: "130px"},
                            {field: "PC_code_status",
                                width: "120px",
                                title: "Code Status",
                                editor: codestatusDropDownEditor,
                                template: "#=PC_code_status#"

                            },
                            {command: ["edit"], title: "Action", width: "130px"},
                        ],
                        editable: "inline"
                    });
                });
                function codestatusDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="PC_code_status" data-value-field="status_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/promotion/status_controller.php",
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
            <script type="text/javascript">
                function KendoWindowFunction(msg, status) {

                    var window = jQuery("#kWindow");
                    if (!window.data("kendoWindow")) {
                        window.kendoWindow({
                            actions: ["Close"],
                            title: "Promotion Code Entry Error",
                            modal: true,
                            height: 50,
                            width: 280,
                            position: {
                                top: 100,
                                left: 100
                            },
                            visible: false,
                            draggable: false,
                            resizable: false
                        });
                    }
                    window.data("kendoWindow").center().open();

                    var okHtml = '';
                    if (status === "error") {
                        okHtml = '<div style="margin-top:10px;text-align:center;"><span style="color:red;font-size:14px;">' + msg + '</span></div>';

                    }
                    window.html(okHtml);
                    return false;
                }
            </script>

        </div>
        <div id="kWindow"></div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

    </div>
    <script type="text/javascript">
        $("#promotionlist").addClass("active");
        $("#promotionlist").parent().parent().addClass("active");
        $("#promotionlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
