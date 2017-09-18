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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Country</h3>

            <!-- Content Start Here -->
            <div id="grid" style="margin-left: 10px;"></div>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/country/index.php",
                                type: "GET"
                            },
                            update: {
                                url: "../controller/country/index.php",
                                type: "POST",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            },
                            destroy: {
                                url: "../controller/country/index.php",
                                type: "DELETE"
                            },
                            create: {
                                url: "../controller/country/index.php",
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
                                id: "country_id",
                                fields: {
                                    country_id: {editable: false, nullable: true},
                                    country_name: {type: "string", validation: {required: true}},
                                    country_status: {type: "string"}
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
                            {name: "create", text: "Add Country"}
                        ],
                        columns: [
                            {field: "country_name", title: "Country Name", width: "150px"},
                            {field: "country_status",
                                width: "130px",
                                title: "Country Status",
                                editor: countrystatusDropDownEditor,
                                template: "#=country_status#"

                            },
                            {command: ["edit", "destroy"], title: "Action", width: "180px"}],
                        editable: "inline"
                    });
                });
                function countrystatusDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="country_status" data-value-field="status_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/country/status_controller.php",
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
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#countrylist").addClass("active");
        $("#countrylist").parent().parent().addClass("active");
        $("#countrylist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
