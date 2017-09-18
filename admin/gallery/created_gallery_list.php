<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
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
            <h3 class="bg-white content-heading border-bottom strong">Image List</h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('gallery', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/gallery/add_event_gallery.php?event_id=' . $event_id); ?>">
                            <span class="k-icon k-add"></span>
                            Add Gallery
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
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_gallery" type="text/x-kendo-template">
<?php if (checkPermission('gallery', 'update', getSession('admin_type'))): ?>
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/gallery/edit_gallery.php'); ?>?event_id=#= event_id #&image_id=#= IG_id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
<?php if (checkPermission('gallery', 'delete', getSession('admin_type'))): ?>   
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= IG_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(imageID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/gallery/created_gallery_list.php",
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
                                url: "../controller/gallery/created_gallery_list.php?event_id=<?php echo $event_id; ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/gallery/created_gallery_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "IG_id",
                                fields: {
                                    IG_id: {nullable: true},
                                    IG_event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    IG_title: {type: "string"},
                                    IG_image_name: {type: "string"}
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
                            {field: "IG_title", title: "Image Title", width: "150px"},
                            {field: "IG_image_name",
                                title: "Image Name",
                                width: "90px",
                                template: "<img src='<?php echo baseUrl("upload/image_file/original/") ?>#=IG_image_name#' height='50' width='110'/>"
                            },
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
                            url: "../controller/gallery/created_gallery_list.php",
                            data: "",
                            success: function () {

                            }
                        });
                    });
                });
            </script>

            <div style="height: 15px;"></div>
            <h3 class="bg-white content-heading border-bottom strong">Video List</h3>
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <div id="videolist" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_video" type="text/x-kendo-template">
<?php if (checkPermission('gallery', 'update', getSession('admin_type'))): ?> 
                    <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/gallery/edit_video_gallery.php'); ?>?event_id=#= event_id #&video_id=#= VG_id #"><span class="k-icon k-edit"></span>Edit</a>
<?php endif; ?>
<?php if (checkPermission('gallery', 'delete', getSession('admin_type'))): ?> 
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteVideoClick(#= VG_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteVideoClick(videoID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/gallery/created_video_gallery_list.php",
                            data: {VG_id: videoID},
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
                                url: "../controller/gallery/created_video_gallery_list.php?event_id=<?php echo $event_id; ?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/gallery/created_video_gallery_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "VG_id",
                                fields: {
                                    VG_id: {nullable: true},
                                    VG_event_id: {type: "number"},
                                    VG_event_title: {type: "string"},
                                    VG_title: {type: "string"},
                                    VG_video_link: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#videolist").kendoGrid({
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
                            {field: "VG_event_title", title: "Event Title", width: "150px"},
                            {field: "VG_title", title: "Video Title", width: "150px"},
                            {field: "VG_video_link", title: "Video Link", width: "90px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_video").html())
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
                            url: "../controller/gallery/created_video_gallery_list.php",
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
        $("#gallerylist").addClass("active");
        $("#gallerylist").parent().parent().addClass("active");
        $("#gallerylist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
