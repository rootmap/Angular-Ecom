<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "select event_title from events where event_id = '$event_id'";
    $run_sql = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_object($run_sql)) {
        $event_title = $row->event_title;
    }
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
            <h3 class="bg-white content-heading border-bottom strong">Guest List of <?php echo $event_title; ?></h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('event_guest', 'create', getSession('admin_type'))): ?>  
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event_guest/add_guest.php?event_id=' . $event_id); ?>">
                            <span class="k-icon k-add"></span>
                            Add New Guest
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
            <?php if (checkPermission('event_guest', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_guest" type="text/x-kendo-template">
<?php if (checkPermission('event_guest', 'update', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event_guest/edit_guest.php'); ?>?event_id=#= event_id #&guest_id=#= EP_id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
<?php if (checkPermission('event_guest', 'delete', getSession('admin_type'))): ?>    
                        <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= EP_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(guestID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/event_guest/created_guest_list.php",
                            data: {EP_id: guestID},
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
                                url: "../controller/event_guest/created_guest_list.php?event_id=<?php echo $event_id; ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/event_guest/created_guest_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "EP_id",
                                fields: {
                                    EP_id: {nullable: true},
                                    EP_event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    EP_participant_name: {type: "string"},
                                    EP_current_position: {type: "string"},
                                    EP_image: {type: "string"}
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
                            {field: "EP_participant_name", title: "Name", width: "150px"},
                            {field: "EP_current_position", title: "Designation", width: "150px"},
                            {field: "EP_image",
                                title: "Photo",
                                width: "90px",
                                template: "<img src='<?php echo baseUrl("upload/guest/") ?>#=EP_image#' height='50' width='110'/>"
                            },
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_guest").html())
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
                            url: "../controller/event_guest/created_guest_list.php",
                            data: "",
                            success: function () {

                            }
                        });
                    });
                });
            </script>

            <div style="height: 15px;"></div>

            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#guestlist").addClass("active");
        $("#guestlist").parent().parent().addClass("active");
        $("#guestlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
