<?php
include '../../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}
$category_id = 0;
$EventID = 0;
$totalUnitPrice = 0;
$totalQuantity = 0;
$totalDiscount = 0;

// getting category list
$categoryArray = array();
$sqlCategory = "SELECT category_id,category_title FROM categories WHERE category_parent_id=0";
$resultCategory = mysqli_query($con, $sqlCategory);
if ($resultCategory) {
    while ($resultCategoryObj = mysqli_fetch_object($resultCategory)) {
        $categoryArray[] = $resultCategoryObj;
    }
} else {
    if (DEBUG) {
        echo "resultCategory error: " . mysqli_error($con);
    } else {
        echo "resultCategory query failed ";
    }
}

// getting event list
$eventArray = array();
$sqlEvent = "SELECT event_id,event_title FROM events";
if ($adminEventPermission == "created") {
    $sqlEvent .= " WHERE event_created_by=$adminID ";
} elseif ($adminEventPermission == "selected") {
    $sqlEvent .= " WHERE event_id IN ($adminEventID) ";
}
$resultEvent = mysqli_query($con, $sqlEvent);
if ($resultEvent) {
    while ($resultEventObj = mysqli_fetch_object($resultEvent)) {
        $eventArray[] = $resultEventObj;
    }
} else {
    if (DEBUG) {
        echo "resultEvent error: " . mysqli_error($con);
    } else {
        echo "resultEvent query failed ";
    }
}

if (isset($_POST['btnShowReport'])) {
    extract($_POST);

    $EventID = validateInput($EventID);
    $category_id = validateInput($category_id);
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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Event Wise Order List</h3>
            <br/>
            <div class="col-md-12">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <select class="form-control" id="category_id" name="category_id" onchange="javascript:generateEvent(this.value);"> 
                                        <option value="">Select Category</option>
                                        <?php if (count($categoryArray) >= 1): ?>
                                            <?php foreach ($categoryArray as $category): ?>
                                                <option value="<?php echo $category->category_id; ?>"  
                                                <?php
                                                if ($category->category_id == $category_id) {
                                                    echo ' selected="selected"';
                                                }
                                                ?>>
                                                    <?php echo $category->category_title; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-5" id="eventSelectBox">
                                    <select class="form-control" id="EventID" name="EventID">
                                        <option value="">Select Event</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit"  id="btnShowReport" name="btnShowReport" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br/><br/>

                <?php if ($resultSummary != ""): ?>
                    <?php if (checkPermission('order', 'eventreport', getSession('admin_type'))): ?>
                        <div id="grid" style="margin-left: 10px;"></div>
                    <?php else : ?>
                        <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
                    <?php endif; ?>
                <?php endif; ?>
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
                                                    {field: "total", title: "Total", width: "90px"},
                                                    {field: "order_status", title: "Order <br/>Status", width: "90px"}
                                                ],
                                                editable: "inline"
                                            });
                                            // CSV file export code
                                            jQuery("#export-grid").click(function (e) {
                                                e.preventDefault();
                                                var dataSource = jQuery("#grid").data("kendoGrid").dataSource;
                                                var filters = dataSource.filter();
                                                var allData = dataSource.data();
                                                var query = new kendo.data.Query(allData);
                                                var data = query.filter(filters).data;

                                                var json_data = JSON.stringify(data);
                                                console.log(json_data);
                                                JSONToCSVConvertor(json_data, "Event Wise Report", true);

                                            });


                                            function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
                                                //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
                                                var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

                                                var CSV = '';
                                                //Set Report title in first row or line

                                                CSV += ReportTitle + '\r\n\n';

                                                //This condition will generate the Label/Header
                                                if (ShowLabel) {
                                                    var row = "";

                                                    //This loop will extract the label from 1st index of on array
                                                    for (var index in arrData[0]) {

                                                        //Now convert each value to string and comma-seprated
                                                        var regexUnderscore = new RegExp("_", "g");
                                                        row += index.replace(regexUnderscore, " ").toUpperCase() + ',';
                                                        //  row += index + ',';
                                                    }

                                                    row = row.slice(0, -1);

                                                    //append Label row with line break
                                                    CSV += row + '\r\n';
                                                }
                                                //1st loop is to extract each row
                                                for (var i = 0; i < arrData.length; i++) {
                                                    var row = "";

                                                    //2nd loop will extract each column and convert it in string comma-seprated
                                                    for (var index in arrData[i]) {
                                                        row += '"' + arrData[i][index] + '",';
                                                    }

                                                    row.slice(0, row.length - 1);

                                                    //add a line break after each row
                                                    CSV += row + '\r\n';
                                                }

                                                if (CSV == '') {
                                                    alert("Invalid data");
                                                    return;
                                                }

                                                //Generate a file name
                                                var fileName = "EventWiseReport_";
                                                //this will remove the blank-spaces from the title and replace it with an underscore
                                                fileName += ReportTitle.replace(/ /g, "_");

                                                //Initialize file format you want csv or xls
                                                var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

                                                // Now the little tricky part.
                                                // you can use either>> window.open(uri);
                                                // but this will not work in some browsers
                                                // or you will not get the correct file extension    

                                                // this trick will generate a temp <a /> tag
                                                var link = document.createElement("a");
                                                link.href = uri;

                                                //set the visibility hidden so it will not effect on your web-layout
                                                link.style = "visibility:hidden";
                                                link.download = fileName + ".csv";

                                                //this part will append the anchor tag and remove it after automatic click
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            }
                                        });


                </script>

                <!-- Content End Here -->
                <?php if (checkPermission('order', 'eventreport', getSession('admin_type'))): ?>
                    <?php if ($resultSummary != ""): ?>

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
                            <button style="margin-left: 15px;" id="export-grid" class="k-button">Export Report To CSV</button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


            </div>
            <div class="clearfix"></div>
        </div>


        <?php include basePath('admin/footer.php'); ?>


        <?php include basePath('admin/footer_script.php'); ?>
        <script type="text/javascript">
            $("#eventorder").addClass("active");
            $("#eventorder").parent().parent().addClass("active");
            $("#eventorder").parent().addClass("in");
        </script>

        <script>
            function generateEvent(category_id) {
                if (category_id > 0) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo baseUrl(); ?>" + "admin/controller/event/getEvent.php",
                        data: {
                            category_id: category_id
                        },
                        success: function (response) {
                            var obj = $.parseJSON(response);
                            if (obj.output === "success") {
                                var VenueHtml = '';
                                if (obj.object.length > 0) {
                                    VenueHtml += '<select class="form-control" id="EventID" name="EventID">';
                                    VenueHtml += '<option value="">Select Event</option>';
                                    for (var i = 0; i < obj.object.length; i++) {
                                        VenueHtml += '<option value="' + obj.object[i].event_id + '">' + obj.object[i].event_title + '</option>';
                                    }
                                    VenueHtml += '</select>';
                                } else {
                                    VenueHtml += '<select class="form-control" id="EventID" name="EventID">';
                                    VenueHtml += '<option value="">Select Event</option>';
                                    VenueHtml += '</select>';
                                }
                                $('#eventSelectBox').html(VenueHtml);
                            } else {
                                alert("Ajax response failed.")
                            }
                        }
                    });
                }
            }
        </script>
    </body>
</html>