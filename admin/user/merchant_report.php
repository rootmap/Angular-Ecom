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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Merchant Report</h3>

            <!-- Content Start Here -->
            <div id="grid" style="margin-left: 10px;">
                <div class="k-toolbar k-grid-toolbar">
<!--                    <a class="k-button k-button-icontext k-grid-add" href="<?php //echo baseUrl('admin/user/refund_add.php'); ?>">
                        <span class="k-icon k-add"></span>
                        Add Admin
                    </a>-->
                </div>
            </div>


            <script id="list_action" type="text/x-kendo-template">

                <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id#);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>
            
            
            <script type="text/javascript">
                function deleteClick(refundID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/user/refund_delete.php",
                            data: {id: refundID},
                            success: function (result) {

                                if (result === true) {
                                    $(".k-i-refresh").click();
                                }
                            }
                        });
                    }
                }

            </script>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/user/merchant_report.php",
                                type: "GET"
                            },
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    id: {editable: false, nullable: true},
                                    admin_full_name: {type: "string", validation: {required: true}},
                                    total_amount: {type: "string"},
                                    requested_amount: {type: "number"},
                                    available_amount: {type: "number"}

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
                            {field: "admin_id", title: "Merchant ID", width: "150px"},
                            {field: "admin_full_name", title: "Merchant Name", width: "150px"},
                            {field: "total_amount", title: "Total Amount", width: "150px"},
                            {field: "requested_amount", title: "Refund Amount", width: "150px"},
                            {field: "available_amount", title: "Available Amount", width: "150px"},
                       
                            ]
                    });

                });


            </script>
            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#merchant_report").addClass("active");
        $("#merchant_report").parent().parent().addClass("active");
        $("#merchant_report").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
