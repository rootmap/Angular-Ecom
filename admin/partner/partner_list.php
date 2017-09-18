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
            <h3 class="bg-white content-heading border-bottom strong">Partner List</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <?php if (checkPermission('partner', 'create', getSession('admin_type'))): ?>
                <div class="k-toolbar k-grid-toolbar">
                    <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/partner/add_partner.php'); ?>">
                        <span class="k-icon k-add"></span>
                        Add Partner
                    </a>
                </div>
                <?php endif; ?>
            </div>



            <!-- Content Start Here -->
            <?php if (checkPermission('partner', 'read', getSession('admin_type'))): ?>
            <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
            <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>

            <script id="edit_partner" type="text/x-kendo-template">
<?php if (checkPermission('partner', 'update', getSession('admin_type'))):   ?>
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/partner/edit_partner.php'); ?>?partner_id=#= partner_id#"><span class="k-icon k-edit"></span>Edit</a>
<?php endif;   ?>
                
<?php if (checkPermission('partner', 'delete', getSession('admin_type'))):   ?>
                <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= partner_id #);" ><span class="k-icon k-delete"></span>Delete</a>
<?php endif;   ?>
            </script>
            <script type="text/javascript">
                function deleteClick(partnerID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/partner/partner_list.php",
                            data: {partner_id: partnerID},
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
                                url: "../controller/partner/partner_list.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/partner/partner_list.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "partner_id",
                                fields: {
                                    partner_id: {nullable: true},
                                    partner_name: {type: "string"},
                                    partner_link: {type: "string"},
                                    partner_image: {type: "string"}
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
                            {field: "partner_name", title: "Partner Name", width: "150px"},
                            {field: "partner_link", title: "Partner Link", width: "150px"},
                            {field: "partner_image",
                                title: "Partner Logo",
                                width: "90px",
                                template: "<img src='<?php echo baseUrl("upload/partner_image/") ?>#=partner_image#' height='50' width='110'/>"
                            },
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_partner").html())
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
                            url: "../controller/partner/partner_list.php",
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
        $("#partnermenu").addClass("active");
        $("#partnermenu").parent().parent().addClass("active");
        $("#partnermenu").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
