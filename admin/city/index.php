<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$admin_id = getSession("admin_id");
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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">City</h3>

            <!-- Content Start Here -->
            <div id="grid" style="margin-left: 10px;"></div>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/city/index.php",
                                type: "GET"
                            },
                            update: {
                                url: "../controller/city/index.php",
                                type: "POST",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            },
                            destroy: {
                                url: "../controller/city/index.php",
                                type: "DELETE"
                            },
                            create: {
                                url: "../controller/city/index.php",
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
                                id: "city_id",
                                fields: {
                                    city_id: {editable: false, nullable: true},
                                    country_id: {type: "number"},
                                    country_name: {type: "string", validation: {required: true}},
                                    city_name: {type: "string", validation: {required: true}},
                                    city_delivery_charge: {type: "number", validation: {required: true, min: 1}},
                                    city_status: {type: "string", validation: {required: true}}
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
                            {name: "create", text: "Add City"}
                        ],
                        columns: [
                            {field: "country_id",
                                title: "Country Name", width: "120px",
                                editor: CountryDropDownEditor,
                                template: "#=country_name#",
                                filterable: {
                                    ui: CountryFilter,
                                    extra: false,
                                    operators: {
                                        string: {
                                            eq: "Is equal to",
                                            neq: "Is not equal to"
                                        }
                                    }
                                }
                            },
                            {field: "city_name", title: "City Name", width: "100px;"},
                            {field: "city_delivery_charge", title: "Delivery Charge", width: "120px;"},
                            {field: "city_status",
                                width: "120px",
                                title: "City Status",
                                editor: citystatusDropDownEditor,
                                template: "#=city_status#"

                            },
                            {command: ["edit", "destroy"], title: "Action", width: "180px"},
                        ],
                        editable: "inline"
                    });
                });

                function citystatusDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="city_status" data-value-field="status_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/city/status_controller.php",
                                        }
                                    },
                                    schema: {
                                        data: "data"
                                    }
                                },
                                optionLabel: "Select Status"
                            });
                }

                function CountryFilter(element) {
                    element.kendoDropDownList({
                        autoBind: false,
                        dataTextField: "country_name",
                        dataValueField: "country_id",
                        dataSource: {
                            transport: {
                                read: {
                                    url: "../controller/country/index.php",
                                    type: "GET"
                                }
                            },
                            schema: {
                                data: "data"
                            }
                        },
                        optionLabel: "Select Country"
                    });
                }
                function CountryDropDownEditor(container, options) {
                    jQuery('<input required data-text-field="country_name" data-value-field="country_id" data-bind="value:' + options.field + '"/>')
                            .appendTo(container)
                            .kendoDropDownList({
                                autoBind: false,
                                dataTextField: "country_name",
                                dataValueField: "country_id",
                                dataSource: {
                                    transport: {
                                        read: {
                                            url: "../controller/country/index.php",
                                            type: "GET"
                                        }
                                    },
                                    schema: {
                                        data: "data"
                                    }
                                },
                                optionLabel: "Select Country"
                            });
                }
            </script>

            <?php //if ($admin_id == 1): ?>
                <!--<style type="text/css">
                    .k-grid-delete{
                        display: none;
                    }
                </style>-->
            <?php // endif; ?>
            <!-- Content End Here -->
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#citylist").addClass("active");
        $("#citylist").parent().parent().addClass("active");
        $("#citylist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
