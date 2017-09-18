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


        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Date Wise - Order Report</h3>
            <div  style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>   
                    <div class="k-toolbar k-grid-toolbar">
                        <form action="" method="get">
                            <label class="pull-right">
                                Browse Event-wise Customer List    
                                <select name="event_id" class="k-textbox" style="width: 200px;">
                                    <option value="">Select Event/All Event</option>
                                    <option <?php if(isset($_GET['event_id'])){ if($_GET['event_id']==0){ ?> selected="selected" <?php } } ?> value="0">All Event</option>

                                    <?php
                                    $sqleventlistquery = mysqli_query($con, "SELECT event_id,event_title FROM events");
                                    if (!empty($sqleventlistquery))
                                        while ($listv = mysqli_fetch_array($sqleventlistquery)):
                                            ?>
                                            <option <?php
                                            if (isset($_GET['event_id'])) {
                                                if ($listv['event_id'] == $_GET['event_id']) {
                                                    ?> selected="selected" <?php
                                                    }
                                                }
                                                ?> value="<?php echo $listv['event_id']; ?>"><?php echo $listv['event_title']; ?></option>
        <?php endwhile; ?>
                                </select>

                                From Date  <input id="datepicker1" name="from" class="k-textbox" style="width: 100px !important;" <?php if (isset($_GET['st'])) { ?>  value="<?php echo $_GET['from']; ?>"  <?php } else { ?> value="<?php echo date('Y-m-d'); ?>" <?php } ?> placeholder="Please Select From Date" type="text" />
                                To Date  <input id="datepicker11"  name="to" class="k-textbox" style="width: 100px !important;" <?php if (isset($_GET['st'])) { ?>  value="<?php echo $_GET['to']; ?>" <?php } else { ?> value="<?php echo date('Y-m-d'); ?>" <?php } ?> placeholder="Please Select To Date" type="text" />
                                <button style="display: inline;" name="generate"  id="generate" class="k-button k-button-icontext k-grid-calendar" type="button">
                                    <span class="k-icon k-calendar"></span>
                                    Generate Report
                                </button>
                            </label>
                        </form>
                    </div>
            <?php endif; ?>
            </div>
            <!-- Content Start Here -->
            <?php if (checkPermission('order', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
            <?php else : ?>
                <div style="margin-left: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
<?php endif; ?>
            <button  id="export-grid" style="margin: 10px 10px;" class="k-button">Export Report To CSV</button>
            <script id="edit_category" type="text/x-kendo-template">
                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/orders/order_details.php'); ?>?order_id=#= order_id #"><span class="fa fa-search-plus"></span>&nbsp;Details</a>
            </script>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 10,
                        transport: {
                            read: {
                                url: "../controller/order/date_wise_order_list.php<?php
if (isset($_GET['st'])) {
    echo "?st=1&event_id=" . $_GET['event_id'] . "&from=" . $_GET['from'] . "&to=" . $_GET['to'];
} elseif (isset($_GET['event_id'])) {
    echo "?event_id=" . $_GET['event_id'];
}
?>",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/order/date_wise_order_list.php",
                                type: "POST"
                            },
                            create: {
                                url: "../controller/order/date_wise_order_list.php",
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
                                id: "event_id",
                                fields: {
                                    order_number: {type: "string"},
                                    order_created: {type: "string"},
                                    name: {type: "string"},
                                    order_billing_phone: {type: "string"},
                                    order_payment_type: {type: "string"},
                                    order_status: {type: "string"},
                                    total: {type: "number"},
                                    order_read: {type: "string"},
                                    admin_full_name: {type: "string"},
                                    order_updated_on: {type: "string"}
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
                            pageSizes: [10, 20, 50, 100, 200],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [
                            {field: "order_number", title: "Order No.", width: "100px"},
                            {field: "name", title: "Customer Name", width: "130px"},
                            {field: "order_billing_phone", title: "Phone No", width: "130px"},
                            {field: "order_created", title: "Placed On", width: "100px"},
                            {field: "order_payment_type", title: "Payment<br/> Method", width: "100px", template: '# if(order_payment_type == "COD"){ # Cash # } else { # Online # } #'},
                            {field: "order_status", title: "Status", width: "100px"},
                            {field: "total", title: "Total Amount", width: "110px"},
                            {field: "order_read", title: "Order Read", width: "100px"},
                            {field: "admin_full_name", title: "Viewed By", width: "100px"},
                            {field: "order_updated_on", title: "Viewed <br/>Date & Time", width: "110px"},
                            {
                                title: "Action", width: "100px",
                                template: kendo.template($("#edit_category").html())
                            }
                        ],
                    });


<?php
if (isset($_GET['event_id'])) {
    if($_GET['event_id']!=0 || $_GET['event_id']!="")
    {
        $sqlgetevna = mysqli_query($con, "SELECT event_title FROM events WHERE event_id='" . $_GET['event_id'] . "'");
        $fetna = mysqli_fetch_array($sqlgetevna);
        if(isset($_GET['st']))
        {
            $evt = "Event : " . $fetna['event_title']." & Date Between : ".clean($_GET['from'])." - ".clean($_GET['to']);
        }
        else 
        {
            $evt = "Event : " . $fetna['event_title'];
        }
    }
    else 
    {
        if(isset($_GET['st']))
        {
            $evt = "Event : All Event & Date Between : ".$_GET['from']." - ".$_GET['to'];
        }
        else 
        {
            $evt = "Event : All Event";
        }
    }
} else {
    $evt = "";
}
?>

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
                        JSONToCSVConvertor(json_data, "Order List Report - <?php echo $evt; ?>", true);

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
                        var fileName = "orderlist_ticketchai_Report_";
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



        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#orderDatewiselist").addClass("active");
        $("#orderDatewiselist").parent().parent().addClass("active");
        $("#orderDatewiselist").parent().addClass("in");

        $(document).ready(function () {
            $('select[name=event_id]').change(function () {
                var getval = $(this).val();
                window.location.replace("./order_date_wise.php?event_id=" + getval);
                //console.log(getval);
            });

            $("#datepicker11").bdatepicker({
                format: 'yyyy-mm-dd',
                startDate: "2013-02-14"
            });

            $('#generate').click(function () {
                var event_id = $('select[name=event_id]').val();
                var from = $('input[name=from]').val();
                var to = $('input[name=to]').val();
                if(event_id=='' || event_id==0)
                {
                  var  nevent_id=0;
                }
                else
                {
                    var  nevent_id=event_id;
                }
                //console.log(event_id+","+from+","+to);
                if (nevent_id !== '' && from !== '' && to !== '')
                {
                    $(this).hide();
                    window.location.replace("./order_date_wise.php?st=2&event_id=" + nevent_id + "&from=" + from + "&to=" + to);
                }
                else if (nevent_id == 0 && from !== '' && to !== '')
                {
                    $(this).hide();
                    window.location.replace("./order_date_wise.php?st=2&event_id=" + nevent_id + "&from=" + from + "&to=" + to);
                }
                else
                {
                    alert('Please Check Your Form.');
                }
            });

        });
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
