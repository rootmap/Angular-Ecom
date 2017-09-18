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
            <h3 class="bg-white content-heading border-bottom strong">Eventwise Facebook Link List</h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('gallery', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/charity_facebook_link.php') ?>">
                            <span class="k-icon k-add"></span>
                            Add New Facebook Link 
                        </a>
                    <?php endif; ?>
                    <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/charity_facebook_link_list.php'); ?>">
                            <span class="k-icon k-i-arrowhead-w"></span>
                            Go Back Facebook List
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
                                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event/charity_facebook_link.php'); ?>?id=#= id #"><span class="k-icon k-edit"></span>Edit</a>
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
                            url: "../controller/event/charity_facebook_link.php",
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
                                url: "../controller/event/charity_facebook_link.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/event/charity_facebook_link.php",
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
                                    page_name: {type: "string"},
                                    page_link: {type: "string"},
                                    date: {type: "string"},
                                    status: {type: "string"}
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
                            {field: "id", title: "ID", width: "150px"},
                            {field: "event_id", title: "Event ID", width: "150px"},
                            {field: "page_name", title: "Page Name", width: "150px"},
                            {field: "page_link", title: "Page Link", width: "150px"},
                            {field: "date", title: "Record Added", width: "150px"},
                            {field: "status", title: "Status", width: "150px"},
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
                            url: "../controller/event/charity_facebook_link.php",
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
        $("#charity_facebook_link").addClass("active");
        $("#charity_facebook_link").parent().parent().addClass("active");
        $("#charity_facebook_link").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>


