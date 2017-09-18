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

        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Dynamic Event Form List</h3>
            <div>
                <?php include basePath('admin/message.php'); ?>
            </div>

            <!-- Content Start Here -->

            <div id="grid" style="margin-left: 10px;"></div>
            <script id="listCount" type="text/x-kendo-template">
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/register_user/view_details.php'); ?>?event_id=#= event_id #"><span class="k-icon k-edit"></span>View</a>
            </script>

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/register_user/user_event_list.php",
                                type: "GET"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "event_id",
                                fields: {
                                    event_id: {nullable: true},
                                    form_event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    total_count: {type: "number"}
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
                            {field: "event_title", title: "Event Title", width: "150px"},
                            {field: "total_count", title: "Total Field", width: "150px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#listCount").html())
                            }
                        ],
                    });
                });

            </script>

        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#reglist").addClass("active");
        $("#reglist").parent().parent().addClass("active");
        $("#reglist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
