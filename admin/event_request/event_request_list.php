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
            <div id="content" style="padding-left: 0px;">
                <h3 class="bg-white content-heading border-bottom strong">Requested Event List</h3>
                <div class="innerAll spacing-x2">
                    <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                        <?php include basePath('admin/message.php'); ?>
                    </div>
                    <?php if (checkPermission('event_request', 'read', getSession('admin_type'))): ?>
                        <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
                    <?php else : ?>
                        <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
                    <?php endif; ?>

                    <script id="EventRequestTemplate" type="text/x-kendo-template">
                        <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event_request/event_request_details.php'); ?>?MI_id=#= MI_id#"><span class="k-icon k-edit"></span>Details</a>
<?php if (checkPermission('event_request', 'delete', getSession('admin_type'))): ?>
                            <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= MI_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
                    </script>
                    <script type="text/javascript">
                        function deleteClick(MI_ID) {
                            var c = confirm("Do you want to delete?");
                            if (c === true) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "../controller/event_request/event_request_list.php",
                                    data: {MI_id: MI_ID},
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
                                        url: "../controller/event_request/event_request_list.php",
                                        type: "GET"
                                    },
                                    destroy: {
                                        url: "../controller/event_request/event_request_list.php",
                                        type: "POST"
                                    }
                                },
                                autoSync: false,
                                schema: {
                                    data: "data",
                                    total: "data.length",
                                    model: {
                                        id: "MI_id",
                                        fields: {
                                            MI_id: {nullable: true},
                                            name: {type: "string"},
                                            MI_email_address: {type: "string"},
                                            MI_number: {type: "string"},
                                            MI_event_title: {type: "string"},
                                            MI_event_date_time: {type: "string"},
                                            MI_venue_name: {type: "string"}
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
                                    {field: "name", title: "Merchant Name", width: "150px"},
                                    {field: "MI_email_address", title: "Merchant Email", width: "150px"},
                                    {field: "MI_number", title: "Mobile Number", width: "120px"},
                                    {field: "MI_event_title", title: "Event Title", width: "150px"},
                                    {field: "MI_event_date_time", title: "Event Date", width: "120px"},
                                    {field: "MI_venue_name", title: "Venue Name", width: "150px"},
                                    {
                                        title: "Action", width: "180px",
                                        template: kendo.template($("#EventRequestTemplate").html())
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
                                    url: "../controller/event_request/event_request_list.php",
                                    data: "",
                                    success: function () {

                                    }
                                });
                            });
                        });
                    </script>

                </div>
            </div>
            <div class="clearfix"></div>
            <?php include basePath('admin/footer.php'); ?>
        </div>
    </body>
    <script type="text/javascript">
        $("#requesteventlist").addClass("active");
        $("#requesteventlist").parent().parent().addClass("active");
        $("#requesteventlist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</html>
