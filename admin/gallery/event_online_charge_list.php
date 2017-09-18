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
            <h3 class="bg-white content-heading border-bottom strong">Event Online Charge List</h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('gallery', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/gallery/event_online_charge.php') ?>">
                            <span class="k-icon k-add"></span>
                            Add New Online Charge
                        </a>
                    <?php endif; ?>
                    <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/event_list.php'); ?>">
                            <span class="k-icon k-i-arrowhead-w"></span>
                            Go Back Event List
                        </a>
                    <?php endif; ?>
                </div>
            </div>



            <!-- Content Start Here -->
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_gallery" type="text/x-kendo-template">
<?php if (checkPermission('gallery', 'update', getSession('admin_type'))): ?>
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/gallery/event_extra_dynamic_cost.php'); ?>?id=#= id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
<?php if (checkPermission('gallery', 'delete', getSession('admin_type'))): ?>   
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(imageID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/gallery/event_online_charge.php",
                            data: {IG_id: imageID},
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
                                url: "../controller/gallery/event_online_charge.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/gallery/event_online_charge.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    id: {nullable: true},
                                    event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    cost_title: {type: "string"},
                                    cost: {type: "number"}
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
                            {field: "event_id", title: "Event ID", width: "150px"},
                            {field: "event_title", title: "Event Title", width: "150px"},
                            {field: "cost_title", title: " Cost Title", width: "150px"},
                            {field: "cost", title: "Cost", width: "150px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_gallery").html())
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
                            url: "../controller/gallery/event_online_charge.php",
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
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#event_online_charge_list").addClass("active");
        $("#event_online_charge_list").parent().parent().addClass("active");
        $("#event_online_charge_list").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>


