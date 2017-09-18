<?php
include '../../config/config.php';
if (isset($_GET['event_id'])) {
    $eventID = $_GET['event_id'];
    // echo $eventID;
//    $userList = array();
//    $getFormUserSql = "SELECT * FROM event_form_values WHERE EFV_event_id = $eventID";
//    $resultFormUser = mysqli_query($con, $getFormUserSql);
//    if ($resultFormUser) {
//        while ($row = mysqli_fetch_object($resultFormUser)) {
//            $userList[] = $row;
//        }
//    }
//    debug($userList);
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
            <h3 class="bg-white content-heading border-bottom strong">Register User List</h3>
            <div>
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/register_user/index.php')?>">
                        <span class="k-icon k-i-arrowhead-w"></span>
                        Go Back
                    </a>
                </div>
            </div>

            <!-- Content Start Here -->

            <div id="grid" style="margin-left: 10px;"></div>
            <script id="listUser" type="text/x-kendo-template">
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/register_user/view_user_details.php'); ?>?user_id=#= user_id #&event_id=#= EFV_event_id #"><span class="k-icon k-edit"></span>View Details</a>
            </script>

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/register_user/user_list.php?event_id=<?php echo $eventID; ?>",
                                type: "GET"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "user_id",
                                fields: {
                                    user_id: {nullable: true},
                                    EFV_event_id: {type: "number"},
                                    EFV_field_value: {type: "string"},
                                    user_email: {type: "string"},
                                    user_phone: {type: "string"}
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
                            {field: "user_name", title: "Register Name", width: "150px"},
                            {field: "user_email", title: "Email Address", width: "150px"},
                            {field: "user_phone", title: "Phone No", width: "150px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#listUser").html())
                            }
                        ],
                    });
                });

            </script>

        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#faqlist").addClass("active");
        $("#faqlist").parent().parent().addClass("active");
        $("#faqlist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>