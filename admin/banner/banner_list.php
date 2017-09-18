
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
            <h3 class="bg-white content-heading border-bottom strong">Banner List</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <?php if (checkPermission('banner', 'create', getSession('admin_type'))): ?>
                    <div class="k-toolbar k-grid-toolbar">
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/banner/index.php'); ?>">
                            <span class="k-icon k-add"></span>
                            Add Banner
                        </a>
                    </div>
                <?php endif; ?>
            </div>



            <!-- Content Start Here -->
            <?php if (checkPermission('banner', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_banner" type="text/x-kendo-template">
<?php if (checkPermission('banner', 'update', getSession('admin_type'))): ?>
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/banner/edit_banner.php'); ?>?banner_id=#= banner_id#"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
                
<?php if (checkPermission('banner', 'delete', getSession('admin_type'))): ?>
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= banner_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(bannerID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/banner/banner_list.php",
                            data: {banner_id: bannerID},
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
                                url: "../controller/banner/banner_list.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/banner/banner_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "banner_id",
                                fields: {
                                    banner_id: {nullable: true},
                                    banner_title: {type: "string"},
                                    banner_priority: {type: "string"},
                                    banner_link: {type: "string"},
                                    banner_buy_ticket: {type: "string"},
                                    banner_image: {type: "string"},
                                    banner_link_type: {type: "string"}
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
                            {field: "banner_title", title: "Banner Title", width: "150px"},
                            {field: "banner_priority", title: "Banner Priority", width: "150px"},
                            {field: "banner_link", title: "Banner Link", width: "150px"},
                            {field: "banner_buy_ticket", title: "Buy Ticket Link", width: "150px"},
                            {field: "banner_image",
                                title: "Image",
                                width: "90px",
                                template: "<img src='<?php echo baseUrl("upload/banner_image/") ?>#=banner_image#' height='50' width='110'/>"
                            },
                            {field: "banner_link_type", title: "Link Type", width: "150px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_banner").html())
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

    </div>
    <script type="text/javascript">
        $("#banlist").addClass("active");
        $("#banlist").parent().parent().addClass("active");
        $("#banlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
