<?php
include '../../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$event_id = $_GET['event_id'];
$venue_id = $_GET['venue_id'];
//debug($event_id);
//debug($venue_id);
//exit();
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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Event Includes List</h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('event_includes', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event_includes/add_event_includes.php?event_id=' . $event_id . "&venue_id=" . $venue_id); ?>">
                            <span class="k-icon k-add"></span>
                            Add Event Includes
                        </a>
                    <?php endif; ?>
                    <?php if (checkPermission('venue', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/venue/event_venue_list.php?event_id=' . $event_id); ?>">
                            <span class="k-icon k-i-arrowhead-w"></span>
                            Go Back Venue
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Content Start Here -->
            <?php if (checkPermission('event_includes', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You don't have permission to view the content</h5></div>
            <?php endif; ?>


            <script id="edit_event_includes" type="text/x-kendo-template">
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event_includes/edit_event_includes.php'); ?>?EI_id=#= EI_id #"><span class="k-icon k-edit"></span>Edit</a>
                <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= EI_id #);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>
            <script type="text/javascript">
                function deleteClick(includesID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/event_includes/event_includes_list.php",
                            data: {EI_id: includesID},
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
                                url: "../controller/event_includes/event_includes_list.php?event_id=<?php echo $event_id; ?>&venue_id=<?php echo $venue_id; ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/event_includes/event_includes_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "EI_id",
                                fields: {
                                    EI_id: {nullable: true},
                                    EI_name: {type: "string"},
                                    EI_event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    EI_venue_id: {type: "number"},
                                    venue_title: {type: "string"},
                                    EI_price: {type: "string"},
                                    EI_total_quantity: {type: "number"},
                                    EI_limit: {type: "number"},
                                    EI_status: {type: "string"}
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
                            {field: "EI_name", title: "Includes Name", width: "140px"},
                            {field: "event_title", title: "Event Title", width: "160px"},
                            {field: "venue_title", title: "Venue Name", width: "140px"},
                            {field: "EI_price", title: "Price", width: "80px"},
                            {field: "EI_total_quantity", title: "Quantity", width: "80px"},
                            {field: "EI_limit", title: "Limit", width: "80px"},
                            {field: "EI_status", title: "Status", width: "80px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_event_includes").html())
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
                            url: "../controller/event_includes/event_includes_list.php?event_id=<?php echo $event_id; ?>",
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
    </div>
      <script type="text/javascript">
        $("#inclist").addClass("active");
        $("#inclist").parent().parent().addClass("active");
        $("#inclist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>