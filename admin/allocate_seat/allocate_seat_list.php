
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
    <body>
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
            <h3 class="bg-white content-heading border-bottom strong">Event Seat List</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <?php if (checkPermission('banner', 'create', getSession('admin_type'))): ?>
                    <div class="k-toolbar k-grid-toolbar">
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/allocate_seat/allocate_seat.php'); ?>">
                            <span class="k-icon k-add"></span>
                            Add Seat Template
                        </a>
                    </div>
                <?php endif; ?>
            </div>



            <!-- Content Start Here -->
            <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <script id="editSeatPlan" type="text/x-kendo-template">
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/allocate_seat/allocate_seat_edit.php'); ?>?ESP_id=#= ESP_id#"><span class="k-icon k-edit"></span>Edit</a>
                <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= ESP_id #);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>
            <script type="text/javascript">
                function deleteClick(ESP_id) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/allocate_seat/allocate_seat_list.php",
                            data: {ESP_id: ESP_id},
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
                        pageSize: 10,
                        transport: {
                            read: {
                                url: "../controller/allocate_seat/allocate_seat_list.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/allocate_seat/allocate_seat_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "ESP_id",
                                fields: {
                                    ESP_id: {nullable: true},
                                    event_title: {type: "string"},
                                    venue_title: {type: "string"},
                                    SP_title: {type: "string"},
                                    SPC_title: {type: "string"},
                                    ESP_ticket_price: {type: "string"}
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
                            pageSizes: [10, 20, 50, 100, 200],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [
                            {field: "event_title", title: "Event Title", width: "150px"},
                            {field: "venue_title", title: "Venue Title", width: "150px"},
                            {field: "SP_title", title: "Place Title", width: "150px"},
                            {field: "SPC_title", title: "Place Plan Title", width: "150px"},
                            {field: "ESP_ticket_price", title: "Price", width: "100px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#editSeatPlan").html())
                            }
                        ],
                    });
                });

            </script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.k-grid-delete').click(function () {
                        $.ajax({
                            type: 'POST',
                            url: "../controller/banner/banner_list.php",
                            data: "",
                            success: function () {

                            }
                        });
                    });
                });
            </script>
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
        <script type="text/javascript">
            $("#allocateseatList").addClass("active");
            $("#allocateseatList").parent().parent().addClass("active");
            $("#allocateseatList").parent().addClass("in");
        </script>
        <?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>