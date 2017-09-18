<?php
include '../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$EventID = 0;
$totalUnitPrice = 0;
$totalQuantity = 0;
$totalDiscount = 0;
if (isset($_GET['id'])) {
    $EventID = $_GET['id'];
}
$sqlSummary = "SELECT SUM(order_items.OI_unit_price) AS totalUnitPrice,orders.order_status,"
        . "SUM(order_items.OI_quantity) AS totalQuantity,"
        . "SUM(order_items.OI_unit_discount) AS totalDiscount "
        . "FROM order_events "
        . "LEFT JOIN order_items ON order_events.OE_id = order_items.OI_OE_id "
        . "LEFT JOIN orders ON order_events.OE_order_id = orders.order_id "
        . "WHERE order_events.OE_event_id = $EventID AND orders.order_status='paid'";
$resultSummary = mysqli_query($con, $sqlSummary);
if ($resultSummary) {
    $resultSummaryObj = mysqli_fetch_object($resultSummary);
    $totalUnitPrice = $resultSummaryObj->totalUnitPrice;
    $totalQuantity = $resultSummaryObj->totalQuantity;
    $totalDiscount = $resultSummaryObj->totalDiscount;
} else {
    if (DEBUG) {
        echo "resultSummary error: " . mysqli_error($con);
    } else {
        echo "resultSummary query failed ";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>
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

        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Event Wise Order List</h3>

            <!-- Content Start Here -->
            <div id="grid" style="margin-left: 10px;"></div>

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 20,
                        transport: {
                            read: {
                                url: "<?php echo baseUrl(); ?>admin/controller/event/view_list.php?id=<?php echo $EventID; ?>",
                                                    type: "GET"
                                                }
                                            },
                                            autoSync: false,
                                            schema: {
                                                data: "data",
                                                total: "data.length",
                                                model: {
                                                    id: "OE_id",
                                                    fields: {
                                                        OE_id: {editable: false, nullable: true},
                                                        order_number: {type: "string"},
                                                        OE_created_on: {type: "string"},
                                                        event_title: {type: "string"},
                                                        name: {type: "string"},
                                                        order_billing_phone: {type: "string"},
                                                        OI_unit_price: {type: "decimal"},
                                                        OI_unit_discount: {type: "decimal"},
                                                        OI_quantity: {type: "number"},
                                                        order_shipment_charge: {type: "decimal"},
                                                        OI_item_type: {type: "string"},
                                                        tota: {type: "decimal"}
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
                                                pageSizes: [20, 50, 100, 200],
                                            },
                                            sortable: true,
                                            groupable: true,
                                            columns: [
                                                {field: "order_number", title: "Order No.", width: "100px"},
                                                {field: "OE_created_on", title: "Date &<br/> Time", width: "90px"},
                                                {field: "event_title", title: "Event <br/>Title", width: "120px"},
                                                {field: "name", title: "Customer <br/> Name", width: "120px"},
                                                {field: "order_billing_phone", title: "Phone <br/>Number", width: "110px"},
                                                {field: "OI_unit_price", title: "Unit <br/>Price", width: "90px"},
                                                {field: "OI_unit_discount", title: "Unit <br/>Discount", width: "90px"},
                                                {field: "OI_quantity", title: "Qnty.", width: "70px"},
                                                {field: "order_shipment_charge", title: "Delivery <br/>Cost", width: "90px"},
                                                {field: "total", title: "Total", width: "90px"},
                                                {field: "order_status", title: "Order <br/>Status", width: "90px"}
                                            ],
                                            editable: "inline"
                                        });
                                    });

            </script>
            <!-- Content End Here -->
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4" style="height: 80px;">
                        <a href="" class="widget widget-inverse innerAll text-center text-regular">
                            <?php if ($totalUnitPrice != ""): ?>
                                <span class="lead"><strong><?php echo $config['CURRENCY_SIGN']; ?><?php echo ($totalUnitPrice - $totalDiscount); ?></strong></span><br/>
                            <?php endif; ?>

                            <span class="lead">Total Amount</span>
                        </a>
                    </div>
                    <div class="col-md-4" style="height: 80px;">
                        <a href="" class="widget widget-inverse innerAll text-center text-regular">
                            <?php if ($totalDiscount != ""): ?>
                                <span class="lead"><strong><?php echo $config['CURRENCY_SIGN']; ?><?php echo $totalDiscount; ?></span><br/>
                            <?php endif; ?>
                            <span class="lead">Total Discount</span>
                        </a>
                    </div>
                    <div class="col-md-4" style="height: 80px;">
                        <a href="" class="widget widget-inverse innerAll text-center text-regular">
                            <?php if ($totalQuantity != ""): ?>
                                <span class="lead"><strong><?php echo $totalQuantity; ?></span><br/>
                            <?php endif; ?>
                            <span class="lead">Total Ticket Quantity</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

        <?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>