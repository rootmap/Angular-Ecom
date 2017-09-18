
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$event_id = $_GET['event_id'];
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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Venue List</h3>
             <div  style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('venue', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/venue/add_venue.php?event_id=' . $event_id); ?>">
                            <span class="k-icon k-add"></span>
                            Add New Venue
                        </a>
                    <?php endif; ?>
                    <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/created_event_list.php?event_id=' . $event_id); ?>">
                            <span class="k-icon k-i-arrowhead-w"></span>
                            Go Back Event
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Content Start Here -->
            <?php if (checkPermission('venue', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You don't have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="options" type="text/x-kendo-template">
<?php if (checkPermission('ticket_type', 'create', getSession('admin_type'))): ?> 
                    <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/ticket_type/venue_ticket_list.php'); ?>?venue_id=#= venue_id #&event_id=#= venue_event_id #"><span class="k-icon k-add"></span>Ticket</a>
<?php endif; ?>
<?php if (checkPermission('event_includes', 'create', getSession('admin_type'))): ?>  
                    <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event_includes/event_includes_list.php'); ?>?venue_id=#= venue_id #&event_id=#= venue_event_id #"><span class="k-icon k-add"></span>Includes</a>
<?php endif; ?>
            </script>
            <script id="edit_venue" type="text/x-kendo-template">
<?php if (checkPermission('venue', 'update', getSession('admin_type'))): ?>  
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/venue/edit_venue.php'); ?>?venue_id=#= venue_id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
<?php if (checkPermission('venue', 'delete', getSession('admin_type'))): ?>  
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= venue_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(venueID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/venue/event_venue_list.php?event_id=<?php echo $event_id; ?>",
                            data: {venue_id: venueID},
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
                                url: "../controller/venue/event_venue_list.php?event_id=<?php echo $event_id; ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/venue/event_venue_list.php?event_id=<?php echo $event_id; ?>",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "venue_id",
                                fields: {
                                    venue_id: {nullable: true},
                                    venue_title: {type: "string"},
                                    venue_event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    venue_valid_from: {type: "string"},
                                    venue_valid_till: {type: "string"},
                                    venue_start_date: {type: "string"},
                                    venue_status: {type: "string"}
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
                            {field: "venue_title", title: "Venue Name", width: "140px"},
                            {field: "event_title", title: "Event Title", width: "140px"},
                            {field: "venue_valid_from", title: "Booking From", width: "115px"},
                            {field: "venue_valid_till", title: "Booking Till", width: "110px"},
                            {field: "venue_start_date", title: "Start Date", width: "110px"},
                            {field: "venue_status", title: "Status", width: "80px"},
                            {
                                title: "Options", width: "190px",
                                template: kendo.template($("#options").html())
                            },
                            {
                                title: "Action", width: "190px",
                                template: kendo.template($("#edit_venue").html())
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
                            url: "../controller/venue/event_venue_list.php?event_id=<?php echo $event_id; ?>",
                            data: "",
                            success: function () {

                            }
                        });
                    });
                });
            </script>
            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

        <script type="text/javascript">
            $("#venlist").addClass("active");
            $("#venlist").parent().parent().addClass("active");
            $("#venlist").parent().addClass("in");
        </script>
    </div>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>


