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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Event List</h3>
            <div  style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>   
                    <div class="k-toolbar k-grid-toolbar">
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/pick_point.php'); ?>">
                            <span class="k-icon k-add"></span>
                            Add New Event Pick Point
                        </a>
                        <label class="pull-right">
                            Browse Event-wise Pick Point    
                            <select name="event_id" style="width: 400px;">
                                <option value="0">Please Select Event</option>
                                <?php
                                $sqleventlistquery = mysqli_query($con, "SELECT event_id,event_title FROM events");
                                if (!empty($sqleventlistquery))
                                    while ($listv = mysqli_fetch_array($sqleventlistquery)):
                                        ?>
                                        <option <?php if (isset($_GET['event_id'])) {
                                if ($listv['event_id'] == $_GET['event_id']) { ?> selected="selected" <?php }
                    } ?> value="<?php echo $listv['event_id']; ?>"><?php echo $listv['event_title']; ?></option>
                    <?php endwhile; ?>
                            </select>
                        </label>
                    </div>
            <?php endif; ?>
            </div>
            <!-- Content Start Here -->
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
<?php endif; ?>



            <script id="edit_category" type="text/x-kendo-template">
<?php if (checkPermission('gallery', 'update', getSession('admin_type'))): ?>
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event/pick_point.php'); ?>?id=#= id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>

<?php if (checkPermission('event', 'delete', getSession('admin_type'))): ?>   
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>   
 
            </script>
            <script type="text/javascript">
                function deleteClick(eventID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/event/event_pick_point_list.php",
                            data: {id: eventID},
                            success: function (result) {

                                if (result == 1) {
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
                                url: "../controller/event/event_pick_point_list.php<?php if (isset($_GET['event_id'])) {
                                       echo "?event_id=" . $_GET['event_id'];
                                     } ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/event/event_pick_point_list.php",
                                type: "POST"
                            },
                            create: {
                                url: "../controller/event/event_pick_point_list.php",
                                type: "PUT",
                                complete: function (e) {
                                    jQuery("#grid").data("kendoGrid").dataSource.read();
                                }
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    event_id: {nullable: true},
                                    event_title: {type: "string", validation: {required: true}},
                                    name: {type: "string", validation: {required: true}},
                                    created_on: {type: "string"}

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
                            {field: "event_id", title: "Event ID", width: "140px"},
                            {field: "event_title", title: "Event Title", width: "140px"},
                            {field: "name", title: "Pick Point Name", width: "150px"},
                            {field: "created_on", title: "Created ON", width: "150px"},
                            {
                                title: "Action", width: "120px",
                                template: kendo.template($("#edit_category").html())
                            }
                        ],
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
        $("#eventpickpointlist").addClass("active");
        $("#eventpickpointlist").parent().parent().addClass("active");
        $("#eventpickpointlist").parent().addClass("in");

        $(document).ready(function () {
            $('select[name=event_id]').change(function () {
                var getval = $(this).val();
                window.location.replace("./event_pick_point_list.php?event_id=" + getval);
                //console.log(getval);
            });
        });

    </script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
